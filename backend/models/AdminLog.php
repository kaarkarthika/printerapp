<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tansi_admin_log".
 *
 * @property string $log_id
 * @property integer $user_id
 * @property integer $service_center_id
 * @property string $action
 * @property string $log_timestamp
 */
class AdminLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['user_id', 'service_center_id', 'action'], 'required'],
            [['user_id', 'service_center_id'], 'integer'],
            [['action'], 'string'],
            [['log_timestamp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'user_id' => 'User ID',
            'service_center_id' => 'Service Center ID',
            'action' => 'Action',
            'log_timestamp' => 'Log Timestamp',
        ];
    }
}
