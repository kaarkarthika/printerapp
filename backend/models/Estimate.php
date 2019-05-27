<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%estimate}}".
 *
 * @property string $auto_id
 * @property string $customer_id
 * @property string $customer_name
 * @property string $bill_number
 * @property string $particular_field
 * @property double $amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class Estimate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estimate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name'],'required'],
           // [['particular_field'], 'string'],
            [['amount'], 'number'],
            [['created_at', 'updated_at', 'user_id','particular_field', 'bill_number','customer_name'], 'safe'],
            [['customer_id', 'customer_name', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'bill_number' => 'Bill Number',
            'particular_field' => 'Particular Field',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
