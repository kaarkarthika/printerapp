<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "op_moneyreceipt".
 *
 * @property string $autoid
 * @property string $mr_type
 * @property double $amount
 * @property string $tds
 * @property string $service_tax_amount
 * @property string $request_date
 * @property string $post_discount
 * @property string $dis_allowed_amt
 * @property double $recovery_amt
 * @property string $paid_by
 * @property string $patient_name
 * @property double $total_amt
 * @property double $org_disc_amt
 * @property string $amount_words
 * @property string $payment_by
 * @property string $towards
 * @property string $auth_by
 * @property string $bank_name
 * @property string $remarks
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class OpMoneyreceipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'op_moneyreceipt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['mr_type'], 'integer'],
            [['amount', 'recovery_amt', 'total_amt', 'org_disc_amt'], 'number'],
            [['request_date', 'created_at', 'updated_at','remarks','user_id','mr_type'], 'safe'],
            [['tds', 'service_tax_amount', 'post_discount', 'dis_allowed_amt', 'paid_by', 'patient_name', 'amount_words', 'payment_by', 'towards', 'auth_by', 'status'], 'string'],
            [['bank_name'], 'string', 'max' => 150],
           // [['remarks'], 'string', 'max' => 200],
            [[ 'updated_ipaddress'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'mr_type' => 'Mr Type',
            'amount' => 'Amount',
            'tds' => 'Tds',
            'service_tax_amount' => 'Service Tax Amount',
            'request_date' => 'Request Date',
            'post_discount' => 'Post Discount',
            'dis_allowed_amt' => 'Dis Allowed Amt',
            'recovery_amt' => 'Recovery Amt',
            'paid_by' => 'Paid By',
            'patient_name' => 'Patient Name',
            'total_amt' => 'Total Amt',
            'org_disc_amt' => 'Org Disc Amt',
            'amount_words' => 'Amount Words',
            'payment_by' => 'Payment By',
            'towards' => 'Towards',
            'auth_by' => 'Auth By',
            'bank_name' => 'Bank Name',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
