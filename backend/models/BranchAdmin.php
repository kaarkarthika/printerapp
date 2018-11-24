<?php

namespace backend\models;

use Yii;
use backend\models\BranchManagement;
use yii\widgets\ActiveForm;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;

/**
 * This is the model class for table "tansi_branch_admin".
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
class BranchAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $service_center_name;
    public $branchname;
	public $role;
	 public $companybranch;
	

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
            [[ 'ba_name','authUserRole','ba_branchid'], 'required'],
            [['ba_name'], 'unique'],
            [['ba_status'], 'string'],
            [['status'], 'integer'],
            [['ba_branchid','ba_timestamp', 'ba_createdat','authUserRole'], 'safe'],
            [[ 'ba_code', 'ba_name'], 'string', 'max' => 250],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ba_autoid' => 'Ba Autoid',
            'ba_branchid' => 'Company Branch',
            'ba_code' => 'Code',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'ba_name' => 'User Name',
            'ba_status' => 'Status',
            'service_center_name' => 'User',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'ba_timestamp' => 'Ba Timestamp',
            'ba_createdat' => 'Ba Createdat',
            'branchname' => 'Branch Name',
            'authUserRole'=>'User Role',
        ];
    }

     public function afterFind() {
        
         //$this->branchname = $this->branch->branch_name;
		 $this->role = $this->userrole->rolename; 
		 //  $this->companybranch=$this->company->branch_name;

        parent::afterFind();
    }


    public function getBranch()
    {

        return $this->hasOne(BranchManagement::className(), ['branch_id' => 'ba_branchid']);
    }
	public function getUserrole()
    {

        return $this->hasOne(AuthUserRole::className(), ['rolecode' => 'authUserRole']);
    }
       public function getCompany()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'ba_branchid']);
    }
	
	
	 public static function checkbeforeaction()
	{
		
		if (Yii::$app -> user -> isGuest)
		 {
        return Yii::$app->getResponse()->redirect(array('/site/login'));
		} 
		else {
			
        $session = Yii::$app -> session;
			$user_modules = ServiceuserLogin::find() -> where(['auth_role' => $session['authUserRole']]) -> one();
			if ($user_modules != "") 
			{
		$modules = AuthProjectModule::find() -> where(['moduleCode' => (Yii::$app -> controller -> id)]) -> andwhere(['moduleMultiple' => 'one']) -> one();
		$in_module = json_decode($user_modules -> assign_service);
		             if (!(in_array($modules -> p_autoid, $in_module))) 
						{
							
							return Yii::$app->getResponse()->redirect(array('/site/notaccess'));
							return false;
						}
					 else
					 	 {
						     return TRUE;
					      }
			} 
			else 
			{

				return Yii::$app->getResponse()->redirect(array('/site/notaccess'));
			}
		
		
	}

		}
	
	
}
