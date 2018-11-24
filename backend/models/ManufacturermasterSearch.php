<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Manufacturermaster;

/**
 * ManufacturermasterSearch represents the model behind the search form about `backend\models\Manufacturermaster`.
 */
class ManufacturermasterSearch extends Manufacturermaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['manufacturer_name', 'manufacturer_description', 'updatedby', 'updatedon', 'updated_ipaddress'], 'safe'],
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
        $query = Manufacturermaster::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_active' => $this->is_active,
            'updatedon' => $this->updatedon,
        ]);

        $query->andFilterWhere(['like', 'manufacturer_name', $this->manufacturer_name])
            ->andFilterWhere(['like', 'manufacturer_description', $this->manufacturer_description])
            ->andFilterWhere(['like', 'updatedby', $this->updatedby])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
