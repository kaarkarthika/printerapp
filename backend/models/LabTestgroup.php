<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_testgroup".
 *
 * @property string $autoid
 * @property string $testgroupid
 * @property string $test_nameid
 * @property string $created_at
 * @property string $created_date
 * @property string $updated_at
 * @property string $update_date
 */
class LabTestgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_testgroup';
    }

    /**
     * @inheritdoc
     */
     public $test_name;
    public function rules()
    {
        return [
            [['testgroupid', 'test_nameid'], 'required'],
            [['testgroupid', 'test_nameid', 'created_at', 'updated_at'], 'integer'],
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
            'testgroupid' => 'Testgroupid',
            'test_nameid' => 'Test Nameid',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'update_date' => 'Update Date',
        ];
    }
}
