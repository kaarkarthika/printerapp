<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_user_role".
 *
 * @property integer $ur_autoid
 * @property string $rolename
 * @property string $rolecode
 * @property string $sortorder
 * @property string $timestamp
 */
class AuthUserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rolename', 'rolecode', 'sortorder'], 'required'],
            [['sortorder'], 'integer'],
            [['timestamp'], 'safe'],
            [['rolename', 'rolecode'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ur_autoid' => 'Ur Autoid',
            'rolename' => 'Role Name',
            'rolecode' => 'Role Code',
            'sortorder' => 'Order',
            'timestamp' => 'Timestamp',
        ];
    }
}
