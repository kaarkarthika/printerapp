<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;
use yii\web\IdentityInterface;
use backend\models\ServiceCentre;
use backend\models\AuthUserRole;
use backend\models\CompanyBranch;

/**
 * This is the model class for table "_branch_admin".
 *
 * @property string $ba_autoid
 * @property string $ba_branchid
 * @property string $ba_code
 * @property string $auth_key
 * @property string $password_hash
 * @property string $ba_name
 * @property string $ba_status
 * @property integer $status
 * @property string $password_reset_token
 * @property string $ba_timestamp
 * @property string $ba_createdat
 */
class BranchAdmin extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    

    public static function tableName()
    {
        return 'branch_admin';
    }

    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

     public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

     public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['_branch_admin.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

     public function getId()
    {   return 1;
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

     public function login()
    {
        
        $session = Yii::$app->session;
        unset($session['user_id']);
        unset($session['user_name']);
        $session->destroy();

       $username = $_REQUEST['LoginForm']['username'];

        $password = $_REQUEST['LoginForm']['password'];
        

        if ($username!='' && $password!='') {
            $user_data = BranchAdmin::find()->where(['ba_name' => $username])->one();
			 
			if($user_data){
           $haspassword=$user_data->password_hash;
           

             if(!isset($haspassword)){
                $haspassword=Yii::$app->security->generatePasswordHash(date("Y-m-d"));
             }
             //  echo $password;
             //  echo "<pre>";

             // echo $haspassword;
             //  exit();

            if(Yii::$app->security->validatePassword($password,$haspassword)){
                $session['user_id']  = $user_data->ba_autoid;
                $session['user_name']  = $user_data->ba_name;  
                $session['user_logintype']  = 'BA'; 
                $session['branch_id']  = $user_data->ba_branchid;
				$session['servicecenter_id']  = $user_data->ba_branchid;      
				$session['authUserRole']  = $user_data->authUserRole;  
			    $company_data = CompanyBranch::find()->where(['branch_id' => $user_data->ba_branchid])->one();
				
			  if($company_data) {
			 	 
				 $session['branch_name']  = $company_data->branch_name;
				
			 }	
			
			
			 
			 
			                   
                return Yii::$app->user->login($user_data, false ? 3600 * 24 * 30 : 0);              
            }else{
                return FALSE;
            }
            }else{
            	return FALSE;
			}
            
        } else {            
            return false;
        }
    }
   
    

    
}
