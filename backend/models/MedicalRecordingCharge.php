<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "medical_recording_charge".
 *
 * @property string $autoid
 * @property string $amount
 * @property string $hsncode
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 * @property string $name
 */
class MedicalRecordingCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medical_recording_charge';
    }

    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
            [['updated_at'], 'safe'],
            [['amount', 'hsncode', 'user_id', 'name'], 'string', 'max' => 50],
            [['updated_ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'amount' => 'Amount',
            'hsncode' => 'Hsncode',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
            'name' => 'Name',
        ];
    }
	public function afterFind() {
		    $this->hsncode1 = $this->hsncodemaster->hsncode;
     	 parent::afterFind();
    }
	public function getHsncodemaster()
	{
		return $this->hasOne(TaxgroupingLog::className(), ['taxgroupid' => 'hsncode']);
	}
}
