<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_package_log".
 *
 * @property string $id
 * @property string $pack_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_ipaddress
 */
class ProductPackageLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_package_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pack_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pack_id' => 'Pack ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
