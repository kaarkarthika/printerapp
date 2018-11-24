<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SubVisit;

/**
 * SubVisitSearch represents the model behind the search form of `backend\models\SubVisit`.
 */
class SubVisitSearch extends SubVisit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_id'], 'integer'],
            [['pat_name','relative_name','phone_number','pat_id', 'cons_status', 'mr_number', 'sub_visit', 'consultant_time', 'consultant_doctor', 'department', 'con_turn', 'patient_type', 'insurance_type', 'ucil_letter_status', 'ucil_emp_id', 'patient_date', 'ucil_date', 'status_given', 'claim_status', 'total_amount', 'less_disc_percent', 'less_disc_flat', 'net_amt', 'paid_amt', 'due_amt', 'pay_mode', 'disc_by', 'remarks', 'created_at', 'updated_at', 'user_id', 'updated_ipaddress'], 'safe'],
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
        $query = SubVisit::find()->orderBy(['created_at'=>SORT_DESC]);

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

		if(isset($_GET['SubVisitSearch']['pat_name'])  && $_GET['SubVisitSearch']['pat_name'] != '')
		{
			$patientname=$_GET['SubVisitSearch']['pat_name'];
			$query->joinWith(['patient']);
			$query->andFilterWhere(['like','patientname',$patientname]);
		}



        // grid filtering conditions
        $query->andFilterWhere([
            'sub_id' => $this->sub_id,
            'patient_date' => $this->patient_date,
            'ucil_date' => $this->ucil_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pat_id', $this->pat_id])
            ->andFilterWhere(['like', 'cons_status', $this->cons_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'sub_visit', $this->sub_visit])
            ->andFilterWhere(['like', 'consultant_time', $this->consultant_time])
            ->andFilterWhere(['like', 'consultant_doctor', $this->consultant_doctor])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'con_turn', $this->con_turn])
            ->andFilterWhere(['like', 'patient_type', $this->patient_type])
            ->andFilterWhere(['like', 'insurance_type', $this->insurance_type])
            ->andFilterWhere(['like', 'ucil_letter_status', $this->ucil_letter_status])
            ->andFilterWhere(['like', 'ucil_emp_id', $this->ucil_emp_id])
            ->andFilterWhere(['like', 'status_given', $this->status_given])
            ->andFilterWhere(['like', 'claim_status', $this->claim_status])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'less_disc_percent', $this->less_disc_percent])
            ->andFilterWhere(['like', 'less_disc_flat', $this->less_disc_flat])
            ->andFilterWhere(['like', 'net_amt', $this->net_amt])
            ->andFilterWhere(['like', 'paid_amt', $this->paid_amt])
            ->andFilterWhere(['like', 'due_amt', $this->due_amt])
            ->andFilterWhere(['like', 'pay_mode', $this->pay_mode])
            ->andFilterWhere(['like', 'disc_by', $this->disc_by])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

	public function ucilsearch($params)
    {
        $query = SubVisit::find()->where(['<>','ucil_letter_status',''])->orWhere(['<>','ucil_letter_status',NULL])->orderBy(['sub_id'=>SORT_DESC]);
	
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
            'sub_id' => $this->sub_id,
            'patient_date' => $this->patient_date,
            'ucil_date' => $this->ucil_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pat_id', $this->pat_id])
            ->andFilterWhere(['like', 'cons_status', $this->cons_status])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'sub_visit', $this->sub_visit])
            ->andFilterWhere(['like', 'consultant_time', $this->consultant_time])
            ->andFilterWhere(['like', 'consultant_doctor', $this->consultant_doctor])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'con_turn', $this->con_turn])
            ->andFilterWhere(['like', 'patient_type', $this->patient_type])
            ->andFilterWhere(['like', 'insurance_type', $this->insurance_type])
            ->andFilterWhere(['like', 'ucil_letter_status', $this->ucil_letter_status])
            ->andFilterWhere(['like', 'ucil_emp_id', $this->ucil_emp_id])
            ->andFilterWhere(['like', 'status_given', $this->status_given])
            ->andFilterWhere(['like', 'claim_status', $this->claim_status])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'less_disc_percent', $this->less_disc_percent])
            ->andFilterWhere(['like', 'less_disc_flat', $this->less_disc_flat])
            ->andFilterWhere(['like', 'net_amt', $this->net_amt])
            ->andFilterWhere(['like', 'paid_amt', $this->paid_amt])
            ->andFilterWhere(['like', 'due_amt', $this->due_amt])
            ->andFilterWhere(['like', 'pay_mode', $this->pay_mode])
            ->andFilterWhere(['like', 'disc_by', $this->disc_by])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
