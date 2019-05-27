<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%estimate_main_tbl_log}}".
 *
 * @property string $auto_id
 * @property string $estimate_main_tbl_id
 * @property string $customer_id
 * @property string $customer_name
 * @property string $bill_number
 * @property double $total_amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class EstimateMainTblLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estimate_main_tbl_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_amount'], 'number'],
            [['created_at', 'updated_at', 'user_id','estimate_main_tbl_id'], 'safe'],
            [[ 'customer_id', 'customer_name', 'bill_number', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'estimate_main_tbl_id' => 'Estimate Main Tbl ID',
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
