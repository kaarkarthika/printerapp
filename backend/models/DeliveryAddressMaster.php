<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%delivery_address_master}}".
 *
 * @property string $id
 * @property string $cust_id
 * @property string $delivery_address
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property string $created_date
 * @property string $updated_at
 * @property string $user_id
 */
class DeliveryAddressMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_address_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_address'], 'string'],
            [['cust_id','created_date', 'updated_at', 'user_id', 'pincode'], 'safe'],
            [[ 'city', 'state'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cust_id' => 'Cust ID',
            'delivery_address' => 'Delivery Address',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }
}
