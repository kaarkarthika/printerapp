<?php
namespace backend\models;
use Yii;
use backend\models\BranchAdmin;
class Composition extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'composition';
    }
    public function rules()
    {
        return [
            [['composition_name','agestart','age_end'], 'required'],
            [[ 'is_active'], 'integer'],
              [['agestart', 'age_end'], 'integer',  'integerOnly' => true,],
            [['updated_on','updated_by', 'updated_ipaddress'], 'safe'],
            [['composition_name'], 'string', 'max' => 100],
          
       
        ];
    }
    public function attributeLabels()
    {
        return [
            'composition_id' => 'Composition ID',
            'composition_name' => 'Composition Name',
             'agestart' => 'Age From',
            'age_end' => 'Age To',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	public function afterFind() {
		
		
		$BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updated_by]) ->one(); 
		 $this->updated_by = $BranchAdmin->ba_name;
		if($this->updated_on!="0000-00-00 00:00:00"){
			$this->updated_on=date('d-m-Y H:i:s',strtotime($this->updated_on));
		}
		
	 parent::afterFind();	
	}
	
	 public function getProductcomposition()
    {
         return $this->hasOne(Product::className(), ['composition_id' => 'composition_id']);
    }
}