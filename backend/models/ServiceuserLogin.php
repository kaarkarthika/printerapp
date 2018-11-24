<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "serviceuser_login".
 *
 * @property integer $id
 * @property string $auth_role
 * @property string $assign_service
 * @property string $status
 */
class ServiceuserLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'serviceuser_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_role', 'assign_service'], 'required'],
            [['status'], 'string'],
            [['assign_service'], 'safe'],
            [['auth_role'], 'string', 'max' => 2000],
             [['auth_role'], 'unique'],
        ];
      
		
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_role' => 'User Role',
            'assign_service' => 'Assign Service',
            'status' => 'Status',
        ];
    }
}
