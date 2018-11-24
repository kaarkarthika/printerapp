<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Patient;

/**
 * PatientSearch represents the model behind the search form about `backend\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'patient_type', 'patient_mobilenumber', 'guardian_mobilenumber', 'insurance_type','is_active', 'updated_by'], 'integer'],
            [[ 'firstname', 'lastname', 'dob', 'medicalrecord_number','address', 'notes','gender', 'emailid', 'guardian_name', 'physicianname',  'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Patient::find();
		$query->joinWith(['patienttype']);

      

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'patient_id' => $this->patient_id,
            'patient_mobilenumber' => $this->patient_mobilenumber,
            'guardian_mobilenumber' => $this->guardian_mobilenumber,
        ]);
        $query ->andFilterWhere(['like', 'firstname', $this->firstname])
			 ->andFilterWhere(['patienttype.patient_typeid'=>$this->patient_type])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'medicalrecord_number', $this->medicalrecord_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
			 ->andFilterWhere(['like', 'dob',$this->dob ])
            ->andFilterWhere(['like', 'emailid', $this->emailid])
            ->andFilterWhere(['like', 'guardian_name', $this->guardian_name])
            ->andFilterWhere(['like', 'physicianname', $this->physicianname])
			->andFilterWhere(['like', 'notes', $this->notes]);
         
          

        return $dataProvider;
    }
    public function patientsearch($params)
    {
        $query = Patient::find();
		$query->joinWith(['patienttype'])->orderBy(['patient_id'=>SORT_DESC]);

      

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }

        
        $query->andFilterWhere([
            'patient_id' => $this->patient_id,
            'patient_mobilenumber' => $this->patient_mobilenumber,
            'guardian_mobilenumber' => $this->guardian_mobilenumber,
        ]);
		

        $query ->andFilterWhere(['like', 'firstname', $this->firstname])
			 ->andFilterWhere(['patienttype.patient_typeid'=>$this->patient_type])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'medicalrecord_number', $this->medicalrecord_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
			 ->andFilterWhere(['like', 'dob',$this->dob ])
            ->andFilterWhere(['like', 'emailid', $this->emailid])
            ->andFilterWhere(['like', 'guardian_name', $this->guardian_name])
            ->andFilterWhere(['like', 'physicianname', $this->physicianname])
			->andFilterWhere(['like', 'notes', $this->notes]);
        return $dataProvider;
    }


public function search1($params,$pno,$mr,$patientname)
    {
        $query = Patient::find();
        $dataProvider = new ActiveDataProvider(['query' => $query,'pagination'=>false,]);

        $this->load($params);
       
            if($pno!="")
			{
				 $query->andFilterWhere([ 'patient_mobilenumber' => $pno ]);
			}
			if($patientname!="")
			{
				 $query->andWhere('firstname LIKE "%' . $patientname . '%" ' .  'OR lastname LIKE "%' . $patientname . '%" ');
			}
			if($mr!="")
			{
			 $query->andFilterWhere([ 'medicalrecord_number'=>$mr]);	
			}
           return $dataProvider;
    }
}
