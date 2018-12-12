<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabPaymentPrime;

/**
 * LabPaymentPrimeSearch represents the model behind the search form of `backend\models\LabPaymentPrime`.
 */

class LabPaymentPrimeSearch extends LabPaymentPrime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	
            [['lab_id', 'overall_item'], 'integer'],
            [['payment_status', 'mr_number', 'name', 'ph_number','bill_number','physican_name', 'insurance', 'dob', 'created_at', 'updated_at', 'user_id', 'updated_ipaddress','status','sample_test'], 'safe'],
            [['overall_gst_per', 'overall_cgst_per', 'overall_sgst_per', 'overall_gst_amt', 'overall_cgst_amt', 'overall_sgst_amt', 'overall_dis_type', 'overall_dis_percent', 'overall_dis_amt', 'overall_sub_total', 'overall_net_amt'], 'number'],
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
        $query = LabPaymentPrime::find();

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
            'dob' => $this->dob,
            'bill_number' => $this->bill_number,
            'overall_item' => $this->overall_item,
            'overall_gst_per' => $this->overall_gst_per,
            'overall_cgst_per' => $this->overall_cgst_per,
            'overall_sgst_per' => $this->overall_sgst_per,
            'overall_gst_amt' => $this->overall_gst_amt,
            'overall_cgst_amt' => $this->overall_cgst_amt,
            'overall_sgst_amt' => $this->overall_sgst_amt,
            'overall_dis_type' => $this->overall_dis_type,
            'overall_dis_percent' => $this->overall_dis_percent,
            'overall_dis_amt' => $this->overall_dis_amt,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amt' => $this->overall_net_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

	public function searchlabtest($params)
    {
        $query = LabPaymentPrime::find()->where(['payment_status'=>'P'])->andWhere(['outsourcetest'=>'0'])->andWhere(['LIKE','status','pending'])->orderBy(['created_at' => SORT_DESC]);;

		//echo"<pre>";print_r($query); die;
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
            'dob' => $this->dob,
            'overall_item' => $this->overall_item,
             'bill_number' => $this->bill_number,
            'overall_gst_per' => $this->overall_gst_per,
            'overall_cgst_per' => $this->overall_cgst_per,
            'overall_sgst_per' => $this->overall_sgst_per,
            'overall_gst_amt' => $this->overall_gst_amt,
            'overall_cgst_amt' => $this->overall_cgst_amt,
            'overall_sgst_amt' => $this->overall_sgst_amt,
            'overall_dis_type' => $this->overall_dis_type,
            'overall_dis_percent' => $this->overall_dis_percent,
            'overall_dis_amt' => $this->overall_dis_amt,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amt' => $this->overall_net_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
			->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

		return $dataProvider;
    }
public function searchlabtest_out($params)
    {
        $query = LabPaymentPrime::find()->where(['payment_status'=>'P'])->andWhere(['outsourcetest'=>'1'])->orderBy(['created_at' => SORT_DESC]);;
	
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
            'dob' => $this->dob,
            'overall_item' => $this->overall_item,
            'overall_gst_per' => $this->overall_gst_per,
            'overall_cgst_per' => $this->overall_cgst_per,
            'overall_sgst_per' => $this->overall_sgst_per,
            'overall_gst_amt' => $this->overall_gst_amt,
            'overall_cgst_amt' => $this->overall_cgst_amt,
            'overall_sgst_amt' => $this->overall_sgst_amt,
            'overall_dis_type' => $this->overall_dis_type,
            'overall_dis_percent' => $this->overall_dis_percent,
            'overall_dis_amt' => $this->overall_dis_amt,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amt' => $this->overall_net_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

 public function searchreportlabtest($params)
    {
        $query = LabPaymentPrime::find()->where(['payment_status'=>'P'])
        ->andWhere(['outsourcetest'=>'0'])
        ->andWhere(['status'=>'report'])
        ->orderBy(['created_at' => SORT_DESC]);

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
            'dob' => $this->dob,
            'overall_item' => $this->overall_item,
            'overall_gst_per' => $this->overall_gst_per,
            'overall_cgst_per' => $this->overall_cgst_per,
            'overall_sgst_per' => $this->overall_sgst_per,
            'overall_gst_amt' => $this->overall_gst_amt,
            'overall_cgst_amt' => $this->overall_cgst_amt,
            'overall_sgst_amt' => $this->overall_sgst_amt,
            'overall_dis_type' => $this->overall_dis_type,
            'overall_dis_percent' => $this->overall_dis_percent,
            'overall_dis_amt' => $this->overall_dis_amt,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amt' => $this->overall_net_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
public function searchreportlabtest_out($params)
    {
        $query = LabPaymentPrime::find()->where(['payment_status'=>'P'])->andWhere(['outsourcetest'=>'1'])->andWhere(['status'=>'report'])->orderBy(['created_at' => SORT_DESC]);;

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
            'dob' => $this->dob,
            'overall_item' => $this->overall_item,
            'overall_gst_per' => $this->overall_gst_per,
            'overall_cgst_per' => $this->overall_cgst_per,
            'overall_sgst_per' => $this->overall_sgst_per,
            'overall_gst_amt' => $this->overall_gst_amt,
            'overall_cgst_amt' => $this->overall_cgst_amt,
            'overall_sgst_amt' => $this->overall_sgst_amt,
            'overall_dis_type' => $this->overall_dis_type,
            'overall_dis_percent' => $this->overall_dis_percent,
            'overall_dis_amt' => $this->overall_dis_amt,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amt' => $this->overall_net_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ph_number', $this->ph_number])
            ->andFilterWhere(['like', 'physican_name', $this->physican_name])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
