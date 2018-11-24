<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;

/**
 * This is the model class for table "company_branch".
 *
 * @property integer $branch_id
 * @property string $company_id
 * @property string $branch_code
 * @property string $branch_name
 * @property integer $is_head_office
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property string $gst_number
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class CompanyBranch extends \yii\db\ActiveRecord
{ 
    /**
     * @inheritdoc
     */
     public $company_name;
    public static function tableName()
    {
        return 'company_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'branch_code', 'branch_name',   'city', 'state', 'pincode','gst_number','email_id'], 'required'],
           // [[ 'is_head_office', 'is_active'], 'integer'],
           	[['email_id'], 'email'],
            [['address1', 'address2', 'address3',], 'string'],
            [['updated_on','state','branch_code','is_head_office','city', 'is_active','branch_name', 'pincode', 'gst_tax', 'updated_by', 'updated_ipaddress','email_id'], 'safe'],
            //[['branch_code'], 'string', 'max' => 20],
            //[['branch_name', 'pincode', 'gst_number', 'updated_by', 'updated_ipaddress'], 'string', 'max' => 30],
            //[['city'], 'string', 'max' => 50],
           // [['state'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'company_id' => 'Company Name',
            'branch_code' => 'Branch Code',
            'branch_name' => 'Branch Name',
            'is_head_office' => 'Head Office',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
            'gst_tax' => 'GST (%)',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
             'gst_number'=>'GSTIN',
             'email_id'=>'Email',
        ];
    }
	public function afterFind() {
		
		//echo"<pre>";print_r($this->comp);die;
		if(!empty($this->comp)){
         $this->company_name = $this->comp->company_name;
		
		 }
		 else{
		 	$this->company_name ="Not Available";
			 
		 }
		 
		 $BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updated_by]) ->one(); 
		 $this->updated_by = $BranchAdmin->ba_name;
		if($this->updated_on!="0000-00-00 00:00:00"){
			$this->updated_on=date('d-m-Y H:i:s',strtotime($this->updated_on));
		}
		
	 parent::afterFind();	
	}
	
	
	 public function getComp()
    {
         return $this->hasOne(Company::className(), ['company_id' => 'company_id']);
    }
	 public function getContstate()
    {
         return $this->hasOne(States::className(), ['stateid' => 'state']);
    }
	
}
