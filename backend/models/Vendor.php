<?php
namespace backend\models;
use Yii;

class Vendor extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'vendor';
    }

   
    public function rules()
    {
        return [
            [['vendorname', 'vendorcode' ], 'required'],
            [['is_active'], 'integer'],
            [['updated_on','updated_by', 'updated_ipaddress','vendorname', 'vendorcode','default_vendor'], 'safe'],
            [['vendorcode' ,'vendorname'],'unique'],
         //   [['vendorname', 'vendorcode'], 'string', 'max' => 100],
            //[[ 'updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'vendorid' => 'Vendor Id',
            'vendorname' => 'Vendor Name',
            'vendorcode' => 'Vendor Code',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
