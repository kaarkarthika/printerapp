<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_payment".
 *
 * @property string $autoid
 * @property string $mr_number
 * @property string $paid_status Y=YES,N=NO
 * @property string $lab_testgroup
 * @property string $lab_testing
 * @property double $total_amount
 * @property double $discount_amount
 * @property double $net_amount
 * @property double $refund_amount
 * @property string $towards
 * @property string $pay_mode
 * @property string $cancellation
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 */
class LabPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['lab_common_id'], 'required'],
            [['paid_status'], 'string'],
            [['lab_testgroup', 'lab_testing', 'user_id'], 'integer'],
            [['total_amount', 'discount_amount', 'net_amount', 'refund_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['mr_number', 'ip_address'], 'string', 'max' => 255],
            [['pay_mode'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'mr_number' => 'Mr Number',
            'paid_status' => 'Paid Status',
            'lab_testgroup' => 'Lab Testgroup',
            'lab_testing' => 'Lab Testing',
            'total_amount' => 'Total Amount',
            'discount_amount' => 'Discount Amount',
            'net_amount' => 'Net Amount',
            'refund_amount' => 'Refund Amount',
            'towards' => 'Towards',
            'pay_mode' => 'Pay Mode',
            'cancellation' => 'Cancellation',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
        ];
    }
}
