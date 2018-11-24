<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property string $autoid
 * @property integer $from_user
 * @property integer $to_user
 * @property string $message
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_user', 'to_user'], 'integer'],
            [['to_user', 'message', 'created_at'], 'required'],
            [['message', 'status'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'from_user' => 'From User',
            'to_user' => 'To User',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
