<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property integer $patient_id

 * @property integer $patient_type
 * @property string $firstname
 * @property string $lastname
 * @property string $dob
 * @property integer $age
 * @property string $medicalrecord_number
 * @property string $address
 * @property string $gender
 * @property string $emailid
 * @property string $patient_mobilenumber
 * @property string $guardian_name
 * @property string $guardian_mobilenumber
 * @property string $physicianname
 * @property integer $is_active
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [[ 'patient_type', 'firstname', 'lastname', 'dob',  'gender', 'patient_mobilenumber', 'medicalrecord_number','physicianname'], 'required'],
            
					
            [['patient_type','is_active', 'updated_by','insurance_type'], 'integer'],
            [['dob',  'updated_on'], 'safe'],
            [['gender'], 'string'],
             [['emailid'], 'email'],
             [['patient_mobilenumber' ,'medicalrecord_number','emailid'],'unique'],
             //[['patient_mobilenumber'], 'match', 'pattern' => '/^(6|7|8|9)\d{9}$/', 'message' => 'Field must contain exactly 10 digits and Starts with 6/7/8/9 '],
          [[ 'firstname'], 'string', 'max' => 50],
            [['lastname','address','notes','emailid',  'updated_ipaddress',], 'string', 'max' => 100],
            [['guardian_name', 'physicianname'], 'string', 'max' => 200],
        ];
    }
	
   
    public function attributeLabels()
    {
        return [
            'patient_id' => 'Patient ID',
           
            'patient_type' => 'Patient Type',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'dob' => 'DOB',
            'age' => 'Age',
            'medicalrecord_number' => 'MR Number',
            'address' => 'Address',
            'gender' => 'Gender',
            'emailid' => 'Email Address',
            'patient_mobilenumber' => 'Mobile Number',
            'guardian_name' => 'Guardian Name',
            'guardian_mobilenumber' => 'Guardian Mobile Number',
            'physicianname' => 'Dr Name',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'notes'=>'Short Notes',
        ];
    }
				 public function getPatienttype()
			{
			        return $this->hasOne(Patienttype::className(), ['patient_typeid' => 'patient_type']);
			}
	
}
