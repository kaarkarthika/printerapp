<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurchaseData;

/**
 * PurchaseDataSearch represents the model behind the search form about `backend\models\PurchaseData`.
 */
class PurchaseDataSearch extends PurchaseData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bill_no', 'vendor', 'vendor_branch_id', 'invoice_no', 'invoice_date', 'created_at', 'updated_by', 'updated_ipaddress'], 'safe'],
            [['sub_total', 'discount_amount', 'gst_amount', 'cgst_amount', 'sgst_amount', 'total_expenses', 'net_amount', 'round_off', 'total_amount'], 'number'],
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
        $query = PurchaseData::find();

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
            'invoice_date' => $this->invoice_date,
            'sub_total' => $this->sub_total,
            'discount_amount' => $this->discount_amount,
            'gst_amount' => $this->gst_amount,
            'cgst_amount' => $this->cgst_amount,
            'sgst_amount' => $this->sgst_amount,
            'total_expenses' => $this->total_expenses,
            'net_amount' => $this->net_amount,
            'round_off' => $this->round_off,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'bill_no', $this->bill_no])
            ->andFilterWhere(['like', 'vendor', $this->vendor])
            ->andFilterWhere(['like', 'vendor_branch_id', $this->vendor_branch_id])
            ->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
