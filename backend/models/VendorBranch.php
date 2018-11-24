<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_branch".
 *
 * @property integer $vendor_branchid
 * @property string $vendorid
 * @property string $branchcode
 * @property string $branchname
 * @property integer $is_headoffice
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property string $gstnumber
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class VendorBranch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $vendor_name;
    public static function tableName()
    {
        return 'vendor_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendorid', 'branchcode', 'branchname',  'state','gstnumber', 'igstpercent', 'branch_emailid','branch_phonenumber'], 'required'],
            [['is_headoffice', 'is_active','branch_phonenumber','igstpercent'], 'integer'],
            [['updated_on','vendorid','updated_by', 'updated_ipaddress','pincode', 'contact_person','person_mobilenumber','city', 'state','branchcode','creditperiod', 'gstnumber','ifsccode','branchname', 'address1', 'address2','bankname','accnumber'], 'safe'],
              [['branch_emailid','branch_phonenumber','branchcode'], 'unique'],
             [['branch_emailid'], 'email'],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vendor_branchid' => 'Vendor Branch ID',
            'vendorid' => 'Vendor Name',
            'branchcode' => 'Branch Code',
            'branchname' => 'Branch Name',
            'is_headoffice' => 'Head Office',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
            'gstnumber' => 'GSTIN',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'branch_emailid'=>'Email Address',
            'branch_phonenumber'=>'Phone Number',
            'bankname'=>'Bank Name',
            'ifsccode'=>'IFSC Code',
            'accnumber'=>'Account Number',
            'igstpercent'=>'IGST Percent'
        ];
    }
public function afterFind() {
        
        $this->vendor_name = $this->vendor->vendorname;
		parent::afterFind();
         
    }
	
	
	

	public function getStates()
{
        return $this->hasOne(States::className(), ['stateid' => 'state']);
}
public function getVendor()
{
        return $this->hasOne(Vendor::className(), ['vendorid' => 'vendorid']);
}

}
