<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property integer $opsaleid
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property string $mrnumber
 * @property string $opnumber
 * @property string $address
 * @property string $phonenumber
 * @property string $billnumber
 * @property string $invoicedate
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         //   [['name', 'dob', 'gender', 'mrnumber',   'phonenumber', 'physicianname','branch_id','billnumber', 'invoicedate'], 'required'],
            [['dob', 'invoicedate', 'updated_on','mrnumber',  'branch_id','patienttype','updated_by', 'updated_ipaddress','billnumber','name', 'address','physicianname','paid_status','paid_amt','due_amt','gender'], 'safe'],
           // [['name', 'emailid','physicianname'], 'string', 'max' => 100],
           // [['gender'], 'string', 'max' => 5],
           // [['mrnumber',  'updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
           // [['billnumber'], 'string', 'max' => 25],
          //  ['emailid', 'email'],
            [['phonenumber'],'integer', 'integerOnly' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'opsaleid' => 'Opsaleid',
            'name' => 'Name',
            'dob' => 'DOB',
            'gender' => 'Gender',
            'mrnumber' => 'MR Number',
            'address' => 'Address',
            'phonenumber' => 'Phone Number',
            'billnumber' => 'Bill Number',
            'invoicedate' => 'Invoice Date',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'physicianname'=>'Physician Name',
            'paid_status'=>'Paid Status',
            'patienttype'=>'Patient Type',
            ];
    }
	
	 public function getPhysician()
	 {
		 return $this->hasOne(Physicianmaster::className(), ['id' => 'physicianname']);
	   }
			
	  public function getTotalsaleproducts()
      {
              return Saledetail::find()->where(['opsaleid' =>'opsaleid'])->count();
		}
}