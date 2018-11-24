<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "finalbill".
 *
 * @property string $autoid
 * @property string $ipno
 * @property string $locipno
 * @property string $mrno
 * @property string $name
 * @property string $age
 * @property string $gender
 * @property string $doa
 * @property string $dod
 * @property string $total_amt
 * @property string $discount
 * @property string $net_amount
 * @property string $paid_amount
 * @property string $balance_amount
 * @property string $reason
 * @property string $refundable
 * @property string $auth_by
 * @property string $remark
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class Finalbill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finalbill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doa', 'dod', 'created_date', 'updated_date', 'total_amt', 'net_amount'], 'safe'],
            [['remark'], 'string'],
            [['ipno', 'locipno', 'mrno', 'age', 'discount', 'paid_amount', 'balance_amount'], 'string', 'max' => 20],
            [['name', 'reason', 'refundable', 'auth_by', 'status', 'user_id', 'user_role'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 15],
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
            'ipno' => 'Ipno',
            'locipno' => 'Locipno',
            'mrno' => 'Mrno',
            'name' => 'Name',
            'age' => 'Age',
            'gender' => 'Gender',
            'doa' => 'Doa',
            'dod' => 'Dod',
            'total_amt' => 'Total Amt',
            'discount' => 'Discount',
            'net_amount' => 'Net Amount',
            'paid_amount' => 'Paid Amount',
            'balance_amount' => 'Balance Amount',
            'reason' => 'Reason',
            'refundable' => 'Refundable',
            'auth_by' => 'Auth By',
            'remark' => 'Remark',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
