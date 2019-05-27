<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Estimate;

/**
 * EstimateSearch represents the model behind the search form of `backend\models\Estimate`.
 */
class EstimateSearch extends Estimate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id'], 'integer'],
            [['customer_id', 'customer_name', 'bill_number', 'particular_field', 'created_at', 'updated_at', 'user_id', 'updated_ipaddress'], 'safe'],
            [['amount'], 'number'],
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
        $query = Estimate::find();

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
            'auto_id' => $this->auto_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'particular_field', $this->particular_field])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
