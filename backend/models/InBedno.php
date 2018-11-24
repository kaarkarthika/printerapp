<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_bedno".
 *
 * @property string $autoid
 * @property int $bedno
 * @property string $room_id
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InBedno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
   
    public static function tableName()
    {
        return 'in_bedno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bedno'], 'integer'],
            [['created_date', 'updated_date','is_active','user_id', 'user_role'], 'safe'],
            [['room_id',], 'string', 'max' => 50],
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
            'bedno' => 'Bedno',
            'room_id' => 'Room ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
	public function afterFind() {
        // $this->room_no1 = $this->room->room_no;
     	 parent::afterFind();
    }
	public function getroom()
	{
        return $this->hasOne(InRoomno::className(), ['autoid' => 'room_id']);
	}
}
