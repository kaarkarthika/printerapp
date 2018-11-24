<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "newpatient".
 *
 * @property int $patientid
 * @property string $mr_no
 * @property string $patientname
 * @property string $pat_inital_name
 * @property int $pat_age
 * @property string $pat_sex
 * @property string $pat_marital_status
 * @property string $pat_relation
 * @property string $par_relationname
 * @property string $pat_address
 * @property string $pat_city
 * @property string $pat_distict
 * @property string $pat_state
 * @property string $pat_pincode
 * @property string $pat_phone
 * @property string $pat_mobileno
 * @property string $pat_email
 * @property string $pat_source
 * @property string $pat_occupation
 * @property string $pat_education
 * @property string $pat_nationality
 * @property string $pat_religion
 * @property string $pat_type
 * @property string $updated_at
 * @property string $create_at
 */
class Newpatient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $ucilval,$ucil_id,$curr_date,$ucil_issue_date,$hide_radio_value,$hide_ucil_id,$hide_curr_date,$hide_ucil_issue_date;
	public $patient_file;
	
	 public $ucil_id_1;
	 
    public static function tableName()
    {
        return 'newpatient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['pat_pincode'], 'required'],
           //  [['patientid','mr_no'], 'unique'],
          // [['patient_file'], 'file', 'skipOnEmpty' => true],
          // [['patient_file'], 'file', 'extensions' => 'gif, jpg',],
          // [['patient_file'], 'required'],
            [['patientid', 'pat_age'], 'integer'],
            [['updated_at', 'create_at','ucilval','ucil_id','curr_date','ucil_issue_date','hide_radio_value','hide_ucil_id','hide_curr_date','hide_ucil_issue_date'], 'safe'],
            [['mr_no', 'pat_address', 'pat_phone', 'pat_source', 'pat_type'], 'string', 'max' => 255],
            [['patientname', 'par_relationname', 'pat_mobileno', 'pat_email'], 'string', 'max' => 50],
            [['pat_inital_name', 'pat_sex', 'pat_pincode'], 'string', 'max' => 10],
            [['pat_marital_status'], 'string', 'max' => 15],
            [['pat_relation', 'pat_city', 'pat_distict', 'pat_state', 'pat_nationality', 'pat_religion'], 'string', 'max' => 25],
            [['pat_occupation', 'pat_education'], 'string', 'max' => 100],
           	
			 [['patientname','pat_mobileno'],'required', 'when' => function($patient_name) {
        			return true;
    		}],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patientid' => 'Patientid',
            'mr_no' => 'Mr No',
            'patientname' => 'Patientname',
            'pat_inital_name' => 'Pat Inital Name',
            'pat_age' => 'Pat Age',
            'pat_sex' => 'Pat Sex',
            'pat_marital_status' => 'Pat Marital Status',
            'pat_relation' => 'Pat Relation',
            'par_relationname' => 'Par Relationname',
            'pat_address' => 'Pat Address',
            'pat_city' => 'Pat City',
            'pat_distict' => 'Pat Distict',
            'pat_state' => 'Pat State',
            'pat_pincode' => 'Pat Pincode',
            'pat_phone' => 'Pat Phone',
            'pat_mobileno' => 'Pat Mobileno',
            'pat_email' => 'Pat Email',
            'pat_source' => 'Pat Source',
            'pat_occupation' => 'Pat Occupation',
            'pat_education' => 'Pat Education',
            'pat_nationality' => 'Pat Nationality',
            'pat_religion' => 'Pat Religion',
            'pat_type' => 'Pat Type',
            'updated_at' => 'Updated At',
            'create_at' => 'Create At',
        ];
    }
	
	public function afterFind() 
	{
		 parent::afterFind();	
	}

	public function getSubvisit()
	{
        return $this->hasOne(SubVisit::className(), ['pat_id' => 'patientid']);
	}

	public function Getage($userDob)
	{
		
		//Create a DateTime object using the user's date of birth.
		$dob = new \DateTime($userDob);
		//We need to compare the user's date of birth with today's date.
		$now = new \DateTime();
		//Calculate the time difference between the two dates.
		$difference = $now->diff($dob);
		//Get the difference in years, as we are looking for the user's age.
		$age = $difference->y;
		//Print it out.
		return $age;
	}
}
