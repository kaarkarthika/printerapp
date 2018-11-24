<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ip_moneyreceipts_log".
 *
 * @property string $autoid
 * @property string $mr_no
 * @property string $ip_no
 * @property string $bill_number
 * @property string $total_amt
 * @property string $action
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $ipaddress
 */
class IpMoneyreceiptsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ip_moneyreceipts_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'updated_date','user_id','bill_number'], 'safe'],
            [['mr_no', 'ip_no',  'total_amt', 'action', ], 'string', 'max' => 50],
            [['ipaddress'], 'string', 'max' => 100],
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
            'ip_no' => 'Ip No',
            'bill_number' => 'Bill Number',
            'total_amt' => 'Total Amt',
            'action' => 'Action',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
