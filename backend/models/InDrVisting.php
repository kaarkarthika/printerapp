<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_dr_visting".
 *
 * @property string $autoid
 * @property string $dr_name
 * @property string $amount
 * @property string $hsn_code
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class InDrVisting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_dr_visting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'updated_date'], 'safe'],
            [['dr_name', 'hsn_code', 'user_id', 'user_role'], 'string', 'max' => 50],
            [['amount'], 'string', 'max' => 10],
            [['is_active'], 'string', 'max' => 2],
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
            'dr_name' => 'Dr Name',
            'amount' => 'Amount',
            'hsn_code' => 'Hsn Code',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
