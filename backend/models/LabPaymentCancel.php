<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_payment_cancel".
 *
 * @property string $autoid
 * @property string $can_lab_prime_id
 * @property string $mr_number
 * @property string $paid_status Y=YES,N=NO
 * @property string $lab_testgroup
 * @property string $lab_testing
 * @property string $lab_common_id
 * @property string $lab_test_name
 * @property double $price
 * @property double $gst_percentage
 * @property double $cgst_percentage
 * @property double $sgst_percentage
 * @property double $gst_amount
 * @property double $cgst_amount
 * @property double $sgst_amount
 * @property double $total_amount
 * @property string $hsn_code
 * @property double $discount_percent
 * @property double $discount_amount
 * @property double $net_amount
 * @property double $refund_amount
 * @property string $pay_mode
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 */
class LabPaymentCancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_payment_cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['can_lab_prime_id', 'lab_testgroup', 'lab_testing', 'user_id'], 'integer'],
           // [['paid_status', 'lab_testgroup', 'lab_testing', 'lab_common_id', 'lab_test_name', 'price', 'gst_percentage', 'cgst_percentage', 'sgst_percentage', 'gst_amount', 'cgst_amount', 'sgst_amount', 'total_amount', 'hsn_code', 'discount_percent', 'discount_amount', 'net_amount', 'refund_amount', 'pay_mode', 'user_id', 'created_at', 'ip_address'], 'required'],
            [['paid_status'], 'string'],
            [['price', 'gst_percentage', 'cgst_percentage', 'sgst_percentage', 'gst_amount', 'cgst_amount', 'sgst_amount', 'total_amount', 'discount_percent', 'discount_amount', 'net_amount', 'refund_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['mr_number', 'lab_common_id', 'lab_test_name', 'hsn_code', 'pay_mode', 'ip_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'can_lab_prime_id' => 'Can Lab Prime ID',
            'mr_number' => 'Mr Number',
            'paid_status' => 'Paid Status',
            'lab_testgroup' => 'Lab Testgroup',
            'lab_testing' => 'Lab Testing',
            'lab_common_id' => 'Lab Common ID',
            'lab_test_name' => 'Lab Test Name',
            'price' => 'Price',
            'gst_percentage' => 'Gst Percentage',
            'cgst_percentage' => 'Cgst Percentage',
            'sgst_percentage' => 'Sgst Percentage',
            'gst_amount' => 'Gst Amount',
            'cgst_amount' => 'Cgst Amount',
            'sgst_amount' => 'Sgst Amount',
            'total_amount' => 'Total Amount',
            'hsn_code' => 'Hsn Code',
            'discount_percent' => 'Discount Percent',
            'discount_amount' => 'Discount Amount',
            'net_amount' => 'Net Amount',
            'refund_amount' => 'Refund Amount',
            'pay_mode' => 'Pay Mode',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
        ];
    }
}
