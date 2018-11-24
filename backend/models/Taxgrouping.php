<?php

namespace backend\models;
use Yii;
class Taxgrouping extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'taxgrouping';
    }
    public function rules()
    {
        return [
            [['hsncode','groupid','groupname','effect_date'], 'required'],
            [['is_active'], 'integer'],
            [['updated_on','updated_by','product','tax', 'updated_ipaddress'], 'safe'],
           // ['hsncode','unique']
        ];
    }
    public function attributeLabels()
    {
        return [
            'taxgroupid' => 'Tax Group id',
            'hsncode'=>'Hsn Code',
            'groupid' => 'Tax Group Name',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'tax'=>'Tax (%)'
        ];
    }
	
	
	public function getTaxmaster()
    {
         return $this->hasOne(Taxmaster::className(), ['taxid' => 'groupid']);
    }
}