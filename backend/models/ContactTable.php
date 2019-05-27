<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%contact_table}}".
 *
 * @property int $auto_id
 * @property string $customer_id
 * @property string $contact_name
 * @property string $contact_number
 * @property string $updated_ipaddress
 * @property string $user_id
 * @property string $created_date
 * @property string $updated_at
 */
class ContactTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_table}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['auto_id'], 'integer'],
            [['customer_id','created_date', 'updated_at', 'user_id'], 'safe'],
            [[ 'contact_name', 'contact_number', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'customer_id' => 'Customer ID',
            'contact_name' => 'Contact Name',
            'contact_number' => 'Contact Number',
            'updated_ipaddress' => 'Updated Ipaddress',
            'user_id' => 'User ID',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
        ];
    }
}
