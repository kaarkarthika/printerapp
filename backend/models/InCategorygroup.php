<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_categorygroup".
 *
 * @property string $autoid
 * @property string $category_id
 * @property string $room_typeid
 * @property double $total
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InCategorygroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_categorygroup';
    }

    /**
     * @inheritdoc
     */
    public $categoryname;
	public $roomtypename;
    public function rules()
    {
        return [
            [['category_id', 'room_typeid'], 'integer'],
            [['total'], 'number'],
            [['created_date', 'updated_date','user_id', 'user_role'], 'safe'],
            [['is_active'], 'string', 'max' => 2],
            //[[], 'string', 'max' => 50],
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
            'category_id' => 'Category ID',
            'room_typeid' => 'Room Typeid',
            'total' => 'Total',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
	public function afterFind() {
		
         $this->categoryname = $this->category->category_name;
		 $this->roomtypename = $this->roomtype->room_types;
		 parent::afterFind();
    }
	public function getcategory()
	{
		return $this->hasOne(InCategory::className(), ['autoid' => 'category_id']);
	}
	public function getroomtype()
	{
		return $this->hasOne(InRoomtypes::className(), ['autoid' => 'room_typeid']);
	}
}
