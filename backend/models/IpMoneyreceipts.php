<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ip_moneyreceipts".
 *
 * @property string $autoid
 * @property string $transaction_type s-settlement,ns-non_settlement,a-advance,r-refund
 * @property string $ip_no
 * @property string $mr_no
 * @property string $bed_no
 * @property string $total_paid
 * @property string $name
 * @property string $mobile_no
 * @property string $bill_number
 * @property string $pancard_no
 * @property string $cardholder_name
 * @property string $service_tax
 * @property string $admission_status
 * @property string $prev_cashpaid
 * @property string $bill_amount
 * @property string $amount
 * @property string $total_amount
 * @property string $mode_of_payment
 * @property string $card_cheque_no
 * @property string $bank_name
 * @property string $payment_details
 * @property string $amount_in_words
 * @property string $remark
 * @property string $default_amount
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $ip_address
 * @property string $updated_ipaddress
 */
class IpMoneyreceipts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ip_moneyreceipts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remark'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['transaction_type', 'ip_no', 'mr_no', 'bed_no', 'total_paid', 'name', 'bill_number', 'pancard_no', 'cardholder_name', 'service_tax', 'admission_status', 'prev_cashpaid', 'bill_amount', 'amount', 'total_amount', 'mode_of_payment', 'card_cheque_no', 'payment_details', 'default_amount', 'status', 'user_id'], 'safe'],
           // [['mobile_no'], 'string', 'max' => 25],
           // [['bank_name'], 'string', 'max' => 150],
           // [['amount_in_words'], 'string', 'max' => 255],
           // [['ip_address', 'updated_ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'transaction_type' => 'Transaction Type',
            'ip_no' => 'Ip No',
            'mr_no' => 'Mr No',
            'bed_no' => 'Bed No',
            'total_paid' => 'Total Paid',
            'name' => 'Name',
            'mobile_no' => 'Mobile No',
            'bill_number' => 'Bill Number',
            'pancard_no' => 'Pancard No',
            'cardholder_name' => 'Cardholder Name',
            'service_tax' => 'Service Tax',
            'admission_status' => 'Admission Status',
            'prev_cashpaid' => 'Prev Cashpaid',
            'bill_amount' => 'Bill Amount',
            'amount' => 'Amount',
            'total_amount' => 'Total Amount',
            'mode_of_payment' => 'Mode Of Payment',
            'card_cheque_no' => 'Card Cheque No',
            'bank_name' => 'Bank Name',
            'payment_details' => 'Payment Details',
            'amount_in_words' => 'Amount In Words',
            'remark' => 'Remark',
            'default_amount' => 'Default Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'ip_address' => 'Ip Address',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
