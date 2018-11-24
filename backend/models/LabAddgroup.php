<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_addgroup".
 *
 * @property string $autoid
 * @property string $mastergroupid
 * @property string $testgroupid
 * @property string $created_at
 * @property string $created_date
 * @property string $updated_at
 * @property string $update_date
 */
class LabAddgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_addgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mastergroupid', 'testgroupid'], 'required'],
            [['mastergroupid', 'testgroupid', 'created_at', 'updated_at'], 'integer'],
            [['created_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'mastergroupid' => 'Mastergroupid',
            'testgroupid' => 'Testgroupid',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'update_date' => 'Update Date',
        ];
    }
}
