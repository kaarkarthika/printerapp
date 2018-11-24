<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_category".
 *
 * @property string $autoid
 * @property string $category_name
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date','user_id', 'user_role', 'updated_date'], 'safe'],
            [['category_name', ], 'string', 'max' => 50],
            [['is_active'], 'string', 'max' => 2],
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
            'category_name' => 'Category Name',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
