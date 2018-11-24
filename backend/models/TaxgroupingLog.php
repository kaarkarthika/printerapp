<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taxgrouping_log".
 *
 * @property string $auto_id
 * @property string $taxgroupid
 * @property string $hsncode
 * @property string $groupid
 * @property string $last_effected_date
 * @property int $is_active
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class TaxgroupingLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxgrouping_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxgroupid', 'groupid'], 'integer'],
             [['tax','additional_tax'], 'double'],
            [['last_effected_date', 'created_at', 'updated_on','updated_by'], 'safe'],
            [['hsncode'], 'string', 'max' => 100],
            [['is_active'], 'string', 'max' => 1],
            [[ 'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'taxgroupid' => 'Taxgroupid',
            'hsncode' => 'Hsncode',
            'groupid' => 'Groupid',
            'last_effected_date' => 'Last Effected Date',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
