<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cancel_log_table".
 *
 * @property string $cancel_id
 * @property string $cancel_ran_id
 * @property string $cancel_trans_type M=MR Number,S=Sub Visit
 * @property string $cancel_type T=Total Fees
 * @property string $subvisitno
 * @property string $mrnumber
 * @property string $opd_type
 * @property string $towards
 * @property string $refund_type
 * @property string $payment_mode
 * @property double $hospital_fees
 * @property double $doctor_fees
 * @property double $cancel_amt
 * @property string $amt_words
 * @property double $paid
 * @property string $reason_cancelled
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 * @property string $user_id
 */
class CancelLogTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cancel_log_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cancel_trans_type', 'cancel_type', 'reason_cancelled'], 'string'],
            [['hospital_fees', 'doctor_fees', 'cancel_amt', 'paid'], 'number'],
            [['created_at', 'updated_at', 'user_id'], 'safe'],
            [['cancel_ran_id', 'subvisitno', 'mrnumber', 'opd_type', 'towards', 'refund_type', 'payment_mode', 'amt_words', 'ip_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cancel_id' => 'Cancel ID',
            'cancel_ran_id' => 'Cancel Ran ID',
            'cancel_trans_type' => 'Cancel Trans Type',
            'cancel_type' => 'Cancel Type',
            'subvisitno' => 'Subvisitno',
            'mrnumber' => 'Mrnumber',
            'opd_type' => 'Opd Type',
            'towards' => 'Towards',
            'refund_type' => 'Refund Type',
            'payment_mode' => 'Payment Mode',
            'hospital_fees' => 'Hospital Fees',
            'doctor_fees' => 'Doctor Fees',
            'cancel_amt' => 'Cancel Amt',
            'amt_words' => 'Amt Words',
            'paid' => 'Paid',
            'reason_cancelled' => 'Reason Cancelled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
            'user_id' => 'User ID',
        ];
    }
}
