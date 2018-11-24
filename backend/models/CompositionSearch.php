<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Composition;

/**
 * CompositionSearch represents the model behind the search form about `backend\models\Composition`.
 */
class CompositionSearch extends Composition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['composition_id','is_active'], 'integer'],
            [['composition_name', 'updated_by', 'updated_on', 'updated_ipaddress'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Composition::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
          //  'pagination' => [ 'pageSize' => 50],
        ]);
		

   

		

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'composition_id' => $this->composition_id,
            'agestart' => $this->agestart,
            'age_end' => $this->age_end,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'composition_name', $this->composition_name])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
