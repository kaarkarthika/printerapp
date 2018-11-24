<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;

/**
 * This is the model class for table "company_gst".
 *
 * @property integer $gstid
 * @property string $company_id
 * @property string $stateid
 * @property string $gst
 * @property integer $isactive
 * @property string $updatedby
 * @property string $updatedon
 * @property string $updatedipaddress
 */
class CompanyGst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_gst';
    }

    /**
     * @inheritdoc
     */
         public $company_name;
		 public $state;
    public function rules()
    {
        return [
            [['company_id', 'stateid', 'gst', ], 'required'],
            [['company_id', 'stateid', 'isactive'], 'integer'],
            [['updatedon','gst','updatedby','updatedipaddress'], 'safe'],
           [['gst'], 'match', 'pattern' => '/^([0][1-9]|[1-2][0-9]|[3][0-9])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/'],
           ['gst','unique'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gstid' => 'Gstid',
            'company_id' => 'Company',
            'stateid' => 'State',
            'gst' => 'GSTIN',
            'isactive' => 'Active',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updatedipaddress' => 'Updatedipaddress',
            'company_name'=>'Company'
        ];
    }
	
	public function afterFind() {
		
		
		if(isset($this->comp)){
         $this->company_name = $this->comp->company_name;
		
		 }
		 else{
		 	$this->company_name ="Not Available";
			 
		 }
		 
		 if(isset($this->comp)){
         $this->state = $this->satz->state_name;
		 }else{
		 $this->state ="Not Available";
		 }
		
		$BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updatedby]) ->one(); 
		 $this->updatedby = $BranchAdmin->ba_name;
		if($this->updatedon!="0000-00-00 00:00:00"){
			$this->updatedon=date('d-m-Y H:i:s',strtotime($this->updatedon));
		}
		
		
	 parent::afterFind();	
	}
	
	
	 public function getComp()
    {
         return $this->hasOne(Company::className(), ['company_id' => 'company_id']);
    }
	
	 public function getSatz()
    {
         return $this->hasOne(States::className(), ['stateid' => 'stateid']);
    }
	
}
