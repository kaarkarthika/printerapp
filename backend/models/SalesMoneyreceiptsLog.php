<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales_moneyreceipts_log".
 *
 * @property string $autoid
 * @property string $sales_money
 * @property string $mr_no
 * @property string $total_paid
 * @property string $bill_number
 * @property string $prev_cashpaid
 * @property string $bill_amount
 * @property string $mode_of_payment
 * @property string $amount
 * @property string $total_amount
 * @property string $remark
 * @property string $created_at
 * @property string $user_id
 * @property string $ip_address
 */
class SalesMoneyreceiptsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_moneyreceipts_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mr_no', 'total_paid'], 'required'],
            [['remark'], 'string'],
            [['sales_money','created_at', 'mr_no', 'total_paid', 'bill_number', 'prev_cashpaid', 'bill_amount', 'mode_of_payment', 'amount', 'total_amount', 'user_id'], 'safe'],
            //[[], 'string', 'max' => 50],
            [['ip_address'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'sales_money' => 'Sales Money',
            'mr_no' => 'Mr No',
            'total_paid' => 'Total Paid',
            'bill_number' => 'Bill Number',
            'prev_cashpaid' => 'Prev Cashpaid',
            'bill_amount' => 'Bill Amount',
            'mode_of_payment' => 'Mode Of Payment',
            'amount' => 'Amount',
            'total_amount' => 'Total Amount',
            'remark' => 'Remark',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'ip_address' => 'Ip Address',
        ];
    }
}
