<?php

namespace backend\models;

use Yii;

class VendorGst extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'vendor_gst';
    }

   
    public function rules()
    {
        return [
            [['vendor_id', 'state', 'gst_tax'], 'required'],
            [['vendor_id',  'state', 'is_active', 'updated_by'], 'integer'],
            [['updated_on'], 'safe'],
            [['gst_tax', 'updated_ipaddress'], 'string', 'max' => 100],
             [['gst_tax'], 'match', 'pattern' => '/^([0][1-9]|[1-2][0-9]|[3][0-9])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/'],
             ['gst_tax','unique'],
            
			
        ];
    }

    public function attributeLabels()
    {
        return [
            'vendor_gst_id' => 'Vendor Gst',
            'vendor_id' => 'Vendor',
            'state' => 'State',
            'gst_tax' => 'GSTIN',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	
	
	 public function getStatename()
    {
         return $this->hasOne(States::className(), ['stateid' => 'state']);
    }
	 public function getVendorname()
    {
         return $this->hasOne(Vendor::className(), ['vendorid' => 'vendor_id']);
    }
}
