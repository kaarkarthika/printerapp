<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_roomtypes".
 *
 * @property string $autoid
 * @property string $room_types
 * @property string $hsn_code
 * @property double $price
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $userrole
 * @property string $ipaddress
 */
class InRoomtypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_roomtypes';
    }

    /**
     * @inheritdoc
     */
   
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['created_date', 'updated_date','user_id','userrole','hsncode','hsn_code'], 'safe'],
            [['room_types', 'ipaddress'], 'string', 'max' => 100],
            //[['hsn_code'], 'string', 'max' => 50],
            [['is_active'], 'string', 'max' => 2],
            [['room_types'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'room_types' => 'Room Types',
            'hsn_code' => 'Hsn Code',
            'price' => 'Price',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'userrole' => 'Userrole',
            'ipaddress' => 'Ipaddress',
            'hsncode' => 'hsncode',
            
        ];
    }
	public function afterFind() {
		
       //  $this->hsncode = $this->hsncodemaster->hsncode;
		 parent::afterFind();
    }
	public function getHsncodemaster()
	{
		return $this->hasOne(TaxgroupingLog::className(), ['taxgroupid' => 'hsn_code']);
	}
}
