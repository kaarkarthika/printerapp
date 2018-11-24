<?php

namespace backend\models;

use Yii;
use backend\models\ServiceCentre;

/**
 * This is the model class for table "tansi_service_centre_admin".
 *
 * @property string $id
 * @property string $servicecenter_id
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
 * @property string $created_at
 * @property string $timestamp
 * @property string $rights
 * @property string $status_flag
 * @property string $user_level
 * @property string $mobile_number
 * @property string $designation
 */
class ServiceCentreAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $servicecentername;
    public static function tableName()
    {
        return 'service_centre_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicecenter_id', 'username','password_hash'], 'required'],

            [['username'], 'unique'],
            [['dob', 'created_at', 'timestamp'], 'safe'],
            [['user_type', 'rights', 'status_flag'], 'string'],
            [['status'], 'integer'],
            [['servicecenter_id', 'user_level', 'mobile_number'], 'string', 'max' => 20],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'city'], 'string', 'max' => 70],
            [['auth_key'], 'string', 'max' => 32],
            [['designation'], 'string', 'max' => 100],
        ];
    }
 public function scenarios()
    {
        $scenarios = parent::scenarios();
       // $scenarios['create'] = ['servicecenter_id', 'username','password_hash'];
        $scenarios['update'] = ['servicecenter_id', 'username'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicecenter_id' => 'Service Center',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dob' => 'Dob',
            'user_type' => 'User Type',
            'city' => 'City',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'timestamp' => 'Timestamp',
            'rights' => 'Rights',
            'status_flag' => 'Status Flag',
            'user_level' => 'User Level',
            'mobile_number' => 'Mobile Number',
            'designation' => 'Designation',
            'servicecentername'=>'Service Center',
        ];
    }

     public function afterFind() {
        
         $this->servicecentername = $this->service->service_center_name; 
         
        parent::afterFind();
    }


    public function getService()
    {
        return $this->hasOne(ServiceCentre::className(), ['center_autoid' => 'servicecenter_id']);
    }
}
