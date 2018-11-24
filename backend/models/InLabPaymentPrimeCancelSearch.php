<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InLabPaymentPrimeCancel;

/**
 * InLabPaymentPrimeCancelSearch represents the model behind the search form of `backend\models\InLabPaymentPrimeCancel`.
 */
class InLabPaymentPrimeCancelSearch extends InLabPaymentPrimeCancel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_id', 'payment_prime_id', 'overall_item', 'user_id'], 'integer'],
            [['payment_status', 'lab_common_id', 'mr_number', 'mr_id', 'sub_id', 'subvisit_number', 'name', 'ph_number', 'physican_name', 'insurance', 'dob', 'bill_number', 'can_overall_dis_type', 'sample_test', 'sample_date', 'remarks', 'authority', 'outsourcetest', 'remarks_outsource', 'sample_received_date', 'report_received_date', 'remarks_report', 'file_path', 'status', 'created_at', 'updated_at', 'updated_ipaddress'], 'safe'],
            [['rate', 'can_overall_gst_per', 'can_overall_cgst_per', 'can_overall_sgst_per', 'can_overall_gst_amt', 'can_overall_cgst_amt', 'can_overall_sgst_amt', 'can_overall_dis_percent', 'can_overall_dis_amt', 'can_overall_sub_total', 'can_overall_net_amt', 'can_overall_paid_amt', 'can_overall_due_amt'], 'number'],
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
        $query = InLabPaymentPrimeCancel::find();

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
            'lab_id' => $this->lab_id,
            'payment_prime_id' => $this->payment_prime_id,
            'dob' => $this->dob,
            'overall_item' => $this->overall_item,
            'rate' => $this->rate,
            'can_overall_gst_per' => $this->can_overall_gst_per,
            'can_overall_cgst_per' => $this->can_overall_cgst_per,
            'can_overall_sgst_per' => $this->can_overall_sgst_per,
            'can_overall_gst_amt' => $this->can_overall_gst_amt,
            'can_overall_cgst_amt' => $this->can_overall_cgst_amt,
            'can_overall_sgst_amt' => $this->can_overall_sgst_amt,
            'can_overall_dis_percent' => $this->can_overall_dis_percent,
            'can_overall_dis_amt' => $this->can_overall_dis_amt,
            'can_overall_sub_total' => $this->can_overall_sub_total,
            'can_overall_net_amt' => $this->can_overall_net_amt,
            'can_overall_paid_amt' => $this->can_overall_paid_amt,
            'can_overall_due_amt' => $this->can_overall_due_amt,
            'sample_date' => $this->sample_date,
            'sample_received_date' => $this->sample_received_date,
            'report_received_date' => $this->report_received_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'lab_common_id', $this->lab_common_id])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'mr_id', $this->mr_id])
            ->andFilterWhere(['like', 'sub_id', $this->sub_id])
            ->andFilterWhere(['like', 'subvisit_number', $this->subvisit_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'can_overall_dis_type', $this->can_overall_dis_type])
            ->andFilterWhere(['like', 'sample_test', $this->sample_test])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'authority', $this->authority])
            ->andFilterWhere(['like', 'outsourcetest', $this->outsourcetest])
            ->andFilterWhere(['like', 'remarks_outsource', $this->remarks_outsource])
            ->andFilterWhere(['like', 'remarks_report', $this->remarks_report])
            ->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
