<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Delivery;

/**
 * DeliverySearch represents the model behind the search form of `backend\models\Delivery`.
 */
class DeliverySearch extends Delivery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cust_id', 'cust_name', 'gstin_no', 'state', 'state_code', 'address', 'bill_no', 'bill_date', 'transport', 'vehicle_num', 'remarks', 'c_date', 'u_date', 'user_id', 'ipaddrss','company_name'], 'safe'],
            [['tot_qty', 'tot_amt'], 'number'],
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
        $query = Delivery::find()->orderBy(['id'=>SORT_DESC]);

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
            'bill_date' => $this->bill_date,
            'tot_qty' => $this->tot_qty,
            'tot_amt' => $this->tot_amt,
            'c_date' => $this->c_date,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'cust_id', $this->cust_id])
            ->andFilterWhere(['like', 'company_name', $this->cust_id])
            ->andFilterWhere(['like', 'cust_name', $this->cust_name])
            ->andFilterWhere(['like', 'gstin_no', $this->gstin_no])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'state_code', $this->state_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'bill_no', $this->bill_no])
            ->andFilterWhere(['like', 'transport', $this->transport])
            ->andFilterWhere(['like', 'vehicle_num', $this->vehicle_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'ipaddrss', $this->ipaddrss]);

        return $dataProvider;
    }
}
