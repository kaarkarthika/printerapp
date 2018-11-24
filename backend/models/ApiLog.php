<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "api_log".
 *
 * @property string $autoid
 * @property string $event_key
 * @property string $request_date
 * @property string $response_data
 * @property string $created_at
 * @property string $status
 * @property string $modified_at
 */
class ApiLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_data', 'response_data', 'status'], 'string'],
           // [['created_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['event_key'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => Yii::t('app', 'Autoid'),
            'event_key' => Yii::t('app', 'Event Key'),
            'request_data' => Yii::t('app', 'Request Data'),
            'response_data' => Yii::t('app', 'Response Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'modified_at' => Yii::t('app', 'Modified At'),
        ];
    }
}
