<?php

namespace backend\models;
use backend\models\TansiServiceCentreAdmin;

use Yii;

/**
 * This is the model class for table "branchaddress".
 *
 * @property integer $autoid
 * @property integer $servicecenter_id
 * @property string $branchname
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $pin
 * @property integer $mobile
 * @property string $email
 * @property string $website
 */
class Branchaddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branchaddress';
    }

    /**
     * @inheritdoc
     */
     
     public $servicenter_name;
    public function rules()
    {
        return [
            [['servicecenter_id'], 'required'],
            [['servicecenter_id'], 'integer'],
            [['branchname', 'city', 'state', 'email', 'website','mobile'], 'string', 'max' => 100],
            [['address1', 'address2'], 'string', 'max' => 1000],
            [['pin'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'servicecenter_id' => 'Servicecenter Name',
            'branchname' => 'Branch Name',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'pin' => 'Pin',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'website' => 'Website',
        ];
    }
	
	public function afterFind() {
        
        
		 $this->servicenter_name= $this->servicecentreadmin['username']; 
       
        parent::afterFind();
        
    }
	
	public function getServicecentreadmin()
    {
        return $this->hasOne(ServiceCentreAdmin::className(), ['servicecenter_id' => 'servicecenter_id']);
    }
}
