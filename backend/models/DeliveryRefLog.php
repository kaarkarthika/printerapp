<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%delivery_ref_log}}".
 *
 * @property string $auto_id
 * @property string $delivery_id
 * @property string $delivery_log_tbl_id
 * @property string $delivery_ref_id
 * @property string $bill_number
 * @property string $bill_date
 * @property string $description
 * @property double $qty
 * @property string $hsn
 * @property string $gst_rate
 * @property double $amount
 * @property string $c_date
 * @property string $u_date
 * @property string $user_id
 * @property string $ipaddress
 */
class DeliveryRefLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_ref_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_id', 'delivery_log_tbl_id', 'delivery_ref_id','bill_date', 'c_date', 'u_date', 'user_id'], 'safe'],
            [['description'], 'string'],
            [['qty', 'amount'], 'number'],
            [[ 'bill_number', 'hsn', 'gst_rate', 'ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'delivery_id' => 'Delivery ID',
            'delivery_log_tbl_id' => 'Delivery Log Tbl ID',
            'delivery_ref_id' => 'Delivery Ref ID',
            'bill_number' => 'Bill Number',
            'bill_date' => 'Bill Date',
            'description' => 'Description',
            'qty' => 'Qty',
            'hsn' => 'Hsn',
            'gst_rate' => 'Gst Rate',
            'amount' => 'Amount',
            'c_date' => 'C Date',
            'u_date' => 'U Date',
            'user_id' => 'User ID',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
