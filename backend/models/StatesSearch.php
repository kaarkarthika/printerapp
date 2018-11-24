<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\States;

/**
 * StatesSearch represents the model behind the search form about `backend\models\States`.
 */
class StatesSearch extends States
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stateid', 'isactive'], 'integer'],
            [['state_name', 'updatedby', 'updatedon', 'updatedipaddress'], 'safe'],
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
        $query = States::find();

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
            'stateid' => $this->stateid,
            'isactive' => $this->isactive,
            'updatedon' => $this->updatedon,
        ]);

        $query->andFilterWhere(['like', 'state_name', $this->state_name])
            ->andFilterWhere(['like', 'updatedby', $this->updatedby])
            ->andFilterWhere(['like', 'updatedipaddress', $this->updatedipaddress]);

        return $dataProvider;
    }
}
