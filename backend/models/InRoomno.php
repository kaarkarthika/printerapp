<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_roomno".
 *
 * @property string $autoid
 * @property string $room_no
 * @property string $floor
 * @property string $roomtype
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InRoomno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_roomno';
    }

    /**
     * @inheritdoc
     */
     public $floorname;
	 public $roomtype1;
    public function rules()
    {
        return [
        
        	[['room_no','floorid','roomtypeid'], 'required'],
            [['created_date', 'updated_date', 'user_id', 'user_role'], 'safe'],
            [['room_no', 'ipaddress'], 'string', 'max' => 100],
            [['floorid', 'roomtypeid',], 'string', 'max' => 50],
            [['room_no'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'room_no' => 'Room No',
            'floorid' => 'Floor',
            'roomtypeid' => 'Roomtype',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
	public function afterFind() 
	{
         $this->floorname = $this->floor->floor_no;
         $this->roomtype1 = $this->roomtype->room_types;
		 parent::afterFind();
    }
	public function getfloor()
	{
        return $this->hasOne(InFloormaster::className(), ['autoid' => 'floorid']);
	}
	public function getroomtype()
	{
        return $this->hasOne(InRoomtypes::className(), ['autoid' => 'roomtypeid']);
	}
}
