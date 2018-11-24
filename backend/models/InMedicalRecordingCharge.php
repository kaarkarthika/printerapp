<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_medical_recording_charge".
 *
 * @property string $autoid
 * @property string $name
 * @property double $amount
 * @property string $hsncode
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InMedicalRecordingCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_medical_recording_charge';
    }

    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
        	[['name','amount','hsncode'], 'required'],
            [['amount'], 'number'],
            [['created_date', 'updated_date','user_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['hsncode',  'user_role'], 'string', 'max' => 50],
            [['ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'name' => 'Name',
            'amount' => 'Amount',
            'hsncode' => 'Hsncode',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
	
	public function afterFind() 
	{
		$this->hsncode1=$this->hsn->hsncode;
	 	parent::afterFind();	
	}
	
	public function getHsn()
	{
        return $this->hasOne(TaxgroupingLog::className(), ['taxgroupid' => 'hsncode']);
	}
}
