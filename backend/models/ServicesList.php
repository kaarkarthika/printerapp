<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "services_list".
 *
 * @property string $autoid
 * @property string $servicename
 * @property string $rate
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $ipaddress
 */
class ServicesList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'updated_date'], 'safe'],
            [['servicename', 'user_id', 'ipaddress'], 'string', 'max' => 50],
            [['rate'], 'string', 'max' => 20],
            [['is_active'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'servicename' => 'Servicename',
            'rate' => 'Rate',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
