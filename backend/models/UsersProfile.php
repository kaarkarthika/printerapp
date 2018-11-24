<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property string $user_type
 * @property string $city
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $rights
 * @property string $status_flag
 * @property string $user_level
 * @property string $mobile_number
 * @property string $designation
 */
class UsersProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $password;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'  ], 'required'],
            [['dob','first_name','user_type', 'last_name','city','dob','auth_key','created_at', 'updated_at', 'rights', 'user_level', 'mobile_number', 'designation'], 'safe'],
            [['user_type', 'rights', 'status_flag'], 'string'],
            [['status',], 'integer'],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'city'], 'string', 'max' => 70],
            [['auth_key'], 'string', 'max' => 32],
            [['user_level', 'mobile_number'], 'string', 'max' => 20],
            [['designation'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }
public function scenarios()
    {
        $scenarios = parent::scenarios();
       // $scenarios['create'] = ['servicecenter_id', 'username','password_hash'];
        $scenarios['update'] = ['username' ];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dob' => 'Dob',
            'user_type' => 'User Type',
            'city' => 'City',
            'auth_key' => 'Auth Key',
            'password' => 'Password ',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'rights' => 'Rights',
            'status_flag' => 'Status Flag',
            'user_level' => 'User Level',
            'mobile_number' => 'Mobile Number',
            'designation' => 'Designation',
        ];
    }
}
