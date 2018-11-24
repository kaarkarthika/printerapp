<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabPaymentCancel;

/**
 * LabPaymentCancelSearch represents the model behind the search form of `backend\models\LabPaymentCancel`.
 */
class LabPaymentCancelSearch extends LabPaymentCancel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'can_lab_prime_id', 'lab_testgroup', 'lab_testing', 'user_id'], 'integer'],
            [['mr_number', 'paid_status', 'lab_common_id', 'lab_test_name', 'hsn_code', 'pay_mode', 'created_at', 'updated_at', 'ip_address'], 'safe'],
            [['price', 'gst_percentage', 'cgst_percentage', 'sgst_percentage', 'gst_amount', 'cgst_amount', 'sgst_amount', 'total_amount', 'discount_percent', 'discount_amount', 'net_amount', 'refund_amount'], 'number'],
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
        $query = LabPaymentCancel::find();

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
            'autoid' => $this->autoid,
            'can_lab_prime_id' => $this->can_lab_prime_id,
            'lab_testgroup' => $this->lab_testgroup,
            'lab_testing' => $this->lab_testing,
            'price' => $this->price,
            'gst_percentage' => $this->gst_percentage,
            'cgst_percentage' => $this->cgst_percentage,
            'sgst_percentage' => $this->sgst_percentage,
            'gst_amount' => $this->gst_amount,
            'cgst_amount' => $this->cgst_amount,
            'sgst_amount' => $this->sgst_amount,
            'total_amount' => $this->total_amount,
            'discount_percent' => $this->discount_percent,
            'discount_amount' => $this->discount_amount,
            'net_amount' => $this->net_amount,
            'refund_amount' => $this->refund_amount,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'paid_status', $this->paid_status])
            ->andFilterWhere(['like', 'lab_common_id', $this->lab_common_id])
            ->andFilterWhere(['like', 'lab_test_name', $this->lab_test_name])
            ->andFilterWhere(['like', 'hsn_code', $this->hsn_code])
            ->andFilterWhere(['like', 'pay_mode', $this->pay_mode])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }
}
