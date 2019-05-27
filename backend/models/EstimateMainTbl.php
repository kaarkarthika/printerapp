<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%estimate_main_tbl}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $customer_name
 * @property string $bill_number
 * @property double $total_amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class EstimateMainTbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estimate_main_tbl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gst_type','company_name'],'required'],
            [['total_amount'], 'number'],
            [['created_at', 'updated_at', 'user_id','company_name','customer_name'], 'safe'],
            [['customer_id', 'customer_name', 'bill_number', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'bill_number' => 'Bill Number',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
