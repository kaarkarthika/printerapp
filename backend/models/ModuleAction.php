<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;
/**
 * This is the model class for table "module_action".
 *
 * @property integer $actionid
 * @property string $action_name
 * @property string $action_key
 * @property string $action_value
 * @property integer $is_active
 * @property string $updatedby
 * @property string $updatedon
 * @property string $updated_ipaddress
 */
class ModuleAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_name', 'action_key',], 'required'],
            [['is_active'], 'integer'],
            [['updatedon','action_name', 'action_key', 'action_value', 'updatedby', 'updated_ipaddress'], 'safe'],
           // [['action_name', 'action_key', 'action_value', 'updatedby', 'updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actionid' => 'Actionid',
            'action_name' => 'Name',
            'action_key' => 'Key',
            'action_value' => 'Value',
            'is_active' => 'Active',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	
	public function afterFind() {
		
		
		$BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updatedby]) ->one(); 
		 $this->updatedby = $BranchAdmin->ba_name;
		if($this->updatedon!="0000-00-00 00:00:00"){
			$this->updatedon=date('d-m-Y H:i:s',strtotime($this->updatedon));
		}
	 parent::afterFind();	
	}
	
}
