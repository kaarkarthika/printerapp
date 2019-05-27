<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%delivery_log}}".
 *
 * @property string $id
 * @property string $delivery_id
 * @property string $cust_id
 * @property string $cust_name
 * @property string $gstin_no
 * @property string $state
 * @property string $state_code
 * @property string $address
 * @property string $bill_no
 * @property string $bill_date
 * @property double $tot_qty
 * @property double $tot_amt
 * @property string $transport
 * @property string $vehicle_num
 * @property string $remarks
 * @property string $c_date
 * @property string $u_date
 * @property string $user_id
 * @property string $ipaddrss
 */
class DeliveryLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'remarks'], 'string'],
            [['cust_id','delivery_id','bill_date', 'c_date', 'u_date', 'user_id'], 'safe'],
            [['tot_qty', 'tot_amt'], 'number'],
            [[  'cust_name', 'gstin_no', 'state', 'state_code', 'bill_no', 'transport', 'vehicle_num', 'ipaddrss'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_id' => 'Delivery ID',
            'cust_id' => 'Cust ID',
            'cust_name' => 'Cust Name',
            'gstin_no' => 'Gstin No',
            'state' => 'State',
            'state_code' => 'State Code',
            'address' => 'Address',
            'bill_no' => 'Bill No',
            'bill_date' => 'Bill Date',
            'tot_qty' => 'Tot Qty',
            'tot_amt' => 'Tot Amt',
            'transport' => 'Transport',
            'vehicle_num' => 'Vehicle Num',
            'remarks' => 'Remarks',
            'c_date' => 'C Date',
            'u_date' => 'U Date',
            'user_id' => 'User ID',
            'ipaddrss' => 'Ipaddrss',
        ];
    }
}
