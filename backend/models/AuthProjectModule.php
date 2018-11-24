<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_project_module".
 *
 * @property string $p_autoid
 * @property string $moduleName
 * @property string $moduleCode
 * @property string $moduleMultiple
 * @property string $moduelRoot
 * @property string $userAction
 * @property string $FAIcon
 * @property string $sortOrder
 */
class AuthProjectModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_project_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleName', 'moduleCode', 'moduleMultiple','sortOrder'], 'required'],
            [['moduleMultiple'], 'string'],
           [['sortOrder','is_active'], 'integer'],
            [[ 'moduelRoot', 'userAction', 'FAIcon', 'sortOrder','action','sortOrder','is_active'], 'safe'],
            
            [['moduleName', 'moduleCode', 'moduelRoot', 'userAction', 'FAIcon'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_autoid' => 'Root Module ID',
            'moduleName' => 'Module Name',
            'moduleCode' => 'Module Code',
            'moduleMultiple' => 'Module Option',
            'moduelRoot' => 'Module Root',
            'userAction' => 'User Action',
            'FAIcon' => 'Font Awesome Icon',
            'sortOrder' => 'Order',
        ];
    }
}
