<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%customer_master}}".
 *
 * @property string $auto_id
 * @property string $company_name
 * @property string $phone_no
 * @property string $address
 * @property string $gst
 * @property string $state_code
 * @property string $created_date
 * @property string $updated_at
 * @property string $updated_ipaddress
 * @property string $user_id
 */
class CustomerMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name','customer_name','phone_no','address'], 'required'],
            [['address'], 'string'],
            [['created_date', 'updated_at', 'user_id'], 'safe'],
            [['company_name', 'phone_no', 'gst', 'state_code', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'company_name' => 'Company Name',
            'phone_no' => 'Phone No',
            'address' => 'Billing Address',
            'gst' => 'Gst',
            'state_code' => 'State Code',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'updated_ipaddress' => 'Updated Ipaddress',
            'user_id' => 'User ID',
        ];
    }
}
