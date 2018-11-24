<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_visit".
 *
 * @property string $sub_id
 * @property string $mr_number
 * @property string $sub_visit
 * @property string $consultant_id
 * @property string $ucil_id
 * @property string $consultant_time
 * @property string $consultant_doctor
 * @property string $department
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class SubVisit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     
     public $phone_number;
	 public $relative_name;
    public static function tableName()
    {
        return 'sub_visit';
    }

    /**
     * @inheritdoc
     */
     public $pat_name;
    public function rules()
    {
        return [
            [['pat_name','relative_name','phone_number','mr_number', 'sub_visit', 'consultant_id', 'ucil_id', 'consultant_time', 'consultant_doctor', 'department', 'user_id','created_at', 'updated_at','updated_ipaddress'], 'safe'],
          // [['mr_number', 'sub_visit', 'consultant_id', 'ucil_id', 'consultant_time', 'consultant_doctor', 'department', 'user_id','created_at'], 'string', 'max' => 200],
            //[['updated_ipaddress'], 'string', 'max' => 255],
        
       /* 	 ['ucil_date','required', 'when' => function($sub_visit_name) {
        return true;
    }],*/
    
		/* ['ucil_emp_id','required', 'when' => function($sub_visit_name) {
        return true;
    }],*/
        //[['ucil_emp_id'], 'required', 'on' => 'register'],
        ];
    }
	
	 public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['ucilupdate'] = ['ucil_emp_id'];//Scenario Values Only Accepted
		return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sub_id' => 'Sub ID',
            'mr_number' => 'Mr Number',
            'sub_visit' => 'Sub Visit',
            'consultant_id' => 'Consultant ID',
            'ucil_id' => 'Ucil ID',
            'consultant_time' => 'Consultant Time',
            'consultant_doctor' => 'Consultant Doctor',
            'department' => 'Department',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }

		public function getPhysician()
		{
		   return $this->hasOne(Physicianmaster::className(), ['id' => 'consultant_doctor']);
		}

		public function getSpecialist()
		{
		   return $this->hasOne(Specialistdoctor::className(), ['s_id' => 'department']);
		}
		
		public function getPatienttype()
		{
		   return $this->hasOne(PatientType::className(), ['type_id' => 'patient_type']);
		}
		
		public function getInsurance()
		{
		   return $this->hasOne(Insurance::className(), ['insurance_typeid' => 'insurance_type']);
		}
		public function getBranch()
	    {
	         return $this->hasOne(BranchAdmin::className(), ['ba_autoid' => 'user_id']);
	    }
		
		public function getPatient()
	    {
	         return $this->hasOne(Newpatient::className(), ['patientid' => 'pat_id']);
	    }

}
