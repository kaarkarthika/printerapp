<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property string $unitid
 * @property string $unitname
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     public $unit_name;
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unitname','unitvalue','no_of_unit'], 'required'],
            [['is_active','no_of_unit'], 'integer'],
            [['updated_on','updated_by', 'updated_ipaddress','unitname'], 'safe'],
           // [['unitname'], 'string', 'max' => 100],
           // [['updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unitid' => 'Unit',
            'unitname' => 'Unit Name',
            'unitvalue' => 'Unit Value',
            'no_of_unit' => 'No of Units',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	
	
	public function afterFind()
	{
		 if(isset($this->producttype->unitname)){
			 $this->unit_name = $this->producttype->product_type;
		 }
       
		 

        parent::afterFind();
    }
	
	 public function getProducttype()
	{
	     return $this->hasOne(Producttype::className(), ['product_typeid' => 'unitname']);
	}
	
}
