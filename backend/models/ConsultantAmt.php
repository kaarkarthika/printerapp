<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "consultant_amt".
 *
 * @property string $id
 * @property string $mrnumber
 * @property string $ucilnumber
 * @property string $tot_amt
 * @property string $less_disc_percent
 * @property string $less_disc_flat
 * @property string $net_amt
 * @property string $paid_amt
 * @property string $due_amt
 * @property string $pay_mode
 * @property string $disc_by
 * @property string $remarks
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_ip_address
 */
class ConsultantAmt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultant_amt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'ucilnumber'], 'safe'],
            [['mrnumber', 'tot_amt', 'less_disc_percent', 'less_disc_flat', 'net_amt', 'paid_amt', 'due_amt', 'pay_mode', 'disc_by', 'remarks', 'updated_ip_address'], 'string', 'max' => 200],
          //  [['user_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mrnumber' => 'Mrnumber',
            'ucilnumber' => 'Ucilnumber',
            'tot_amt' => 'Tot Amt',
            'less_disc_percent' => 'Less Disc Percent',
            'less_disc_flat' => 'Less Disc Flat',
            'net_amt' => 'Net Amt',
            'paid_amt' => 'Paid Amt',
            'due_amt' => 'Due Amt',
            'pay_mode' => 'Pay Mode',
            'disc_by' => 'Disc By',
            'remarks' => 'Remarks',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_ip_address' => 'Updated Ip Address',
        ];
    }
}
