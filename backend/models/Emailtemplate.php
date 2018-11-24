<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "emailtemplate".
 *
 * @property integer $emailid
 * @property string $message
 * @property integer $userfrom
 * @property integer $userto
 * @property integer $isread
 * @property string $datesent
 * @property string $attachment
 */
class Emailtemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailtemplate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userto','subject'], 'required'],
            [['userto', 'cc', 'bcc'], 'email'],
            [['datesent','cc','bcc','message','userfrom','userto'], 'safe'],
            [['message'], 'string', 'max' => 255],
            [['attachment'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emailid' => 'Emailid',
            'message' => 'Message',
            'userfrom' => 'Userfrom',
            'userto' => 'To Address',
            'isread' => 'Isread',
            'datesent' => 'Datesent',
            'cc'=>'Cc',
            'bcc'=>'Bcc',
            'subject'=>'Subject',
            'attachment' => 'Attachment',
        ];
    }
}
