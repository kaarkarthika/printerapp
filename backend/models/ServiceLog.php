<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tansi_service_log".
 *
 * @property string $slog_id
 * @property string $created_date
 * @property integer $service_id
 * @property integer $branch_id
 * @property string $changes
 */
class ServiceLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date','service_id', 'branch_id', 'changes'], 'safe'],
            
            [['service_id', 'branch_id'], 'integer'],
            [['changes'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slog_id' => 'Slog ID',
            'created_date' => 'Created Date',
            'service_id' => 'Service ID',
            'branch_id' => 'Branch ID',
            'changes' => 'Changes',
        ];
    }
}
