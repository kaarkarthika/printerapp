<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_floormaster".
 *
 * @property string $autoid
 * @property string $floor_no
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InFloormaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_floormaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['floor_no'], 'required'],
            [['created_date', 'updated_date','user_id', 'user_role'], 'safe'],
            [['floor_no'], 'string', 'max' => 255],
            [['is_active'], 'string', 'max' => 2],
            //[[], 'string', 'max' => 20],
            [['ipaddress'], 'string', 'max' => 100],
            [['floor_no'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'floor_no' => 'Floor No',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
