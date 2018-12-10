<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_packagemaster".
 *
 * @property string $id
 * @property string $pack_name
 * @property string $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_ipaddress
 */
class ProductPackagemaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_packagemaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['pack_name', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pack_name' => 'Pack Name',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
