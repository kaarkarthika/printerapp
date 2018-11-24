<?php

namespace backend\models;

use Yii;
use backend\models\ServiceCentreAdmin;
/**
 * This is the model class for table "tansi_service_centre".
 *
 * @property string $center_autoid
 * @property string $service_center_name
 * @property string $service_center_code
 * @property string $service_center_status
 * @property string $service_center_timestamp
 * @property string $service_center_createdat
 */
class ServiceCentre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
  
  
    public $username;
  //   public $username1;
    public $password;
    
    public static function tableName()
    {
        return 'service_centre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_center_name', 'service_center_code','username','password'], 'required'],
            [['service_center_status'], 'string'],
            [['service_center_timestamp', 'service_center_createdat'], 'safe'],
            [['service_center_name', 'service_center_code'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'center_autoid' => 'Center Autoid',
            'service_center_name' => 'Center Name',
            'service_center_code' => 'Center Code',
            'service_center_status' => 'Service Center Status',
            'service_center_timestamp' => 'Service Center Timestamp',
            'service_center_createdat' => 'Service Center Createdat',
            'username'=>'Username',
            'password'=>'Password',
        ];
    }

     public function afterFind() {
        
         // $this->username= $this->service->username; 
         
         parent::afterFind();
     }

 
   // public function getService()
     // {
     //     return $this->hasOne(TansiServiceCentreAdmin::className(), ['servicecenter_id' => 'center_autoid']);
     // }
}
