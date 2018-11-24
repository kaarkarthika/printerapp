<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales_moneyreceipts".
 *
 * @property string $autoid
 * @property string $mr_no
 * @property string $total_paid
 * @property string $name
 * @property string $mobile_no
 * @property string $bill_number
 * @property string $pancard_no
 * @property string $cardholder_name
 * @property string $service_tax
 * @property string $prev_cashpaid
 * @property string $bill_amount
 * @property string $amount
 * @property string $total_amount
 * @property string $mode_of_payment
 * @property string $card_cheque_no
 * @property string $card_name
 * @property string $bank_name
 * @property string $payment_details
 * @property string $amount_in_words
 * @property string $remark
 * @property string $default_amount
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $authority
 * @property string $ip_address
 * @property string $updated_ipaddress
 */
class SalesMoneyreceipts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_moneyreceipts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mr_no', 'total_paid'], 'required'],
            [['remark'], 'string'],
            [['created_at', 'updated_at', 'user_id','ip_address', 'updated_ipaddress'], 'safe'],
            [['mr_no', 'total_paid', 'name', 'bill_number', 'pancard_no', 'cardholder_name', 'service_tax', 'prev_cashpaid', 'bill_amount', 'amount', 'total_amount', 'mode_of_payment', 'card_cheque_no', 'payment_details', 'default_amount', 'status'], 'string', 'max' => 50],
            [['mobile_no'], 'string', 'max' => 25],
            [['card_name' ], 'string', 'max' => 100],
            [['bank_name'], 'string', 'max' => 150],
            [['amount_in_words', 'authority'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'mr_no' => 'Mr No',
            'total_paid' => 'Total Paid',
            'name' => 'Name',
            'mobile_no' => 'Mobile No',
            'bill_number' => 'Bill Number',
            'pancard_no' => 'Pancard No',
            'cardholder_name' => 'Cardholder Name',
            'service_tax' => 'Service Tax',
            'prev_cashpaid' => 'Prev Cashpaid',
            'bill_amount' => 'Bill Amount',
            'amount' => 'Amount',
            'total_amount' => 'Total Amount',
            'mode_of_payment' => 'Mode Of Payment',
            'card_cheque_no' => 'Card Cheque No',
            'card_name' => 'Card Name',
            'bank_name' => 'Bank Name',
            'payment_details' => 'Payment Details',
            'amount_in_words' => 'Amount In Words',
            'remark' => 'Remark',
            'default_amount' => 'Default Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'authority' => 'Authority',
            'ip_address' => 'Ip Address',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
