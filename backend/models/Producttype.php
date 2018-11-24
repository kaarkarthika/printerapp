<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;
/**
 * This is the model class for table "{{%producttype}}".
 *
 * @property integer $product_typeid
 * @property string $product_type
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Producttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%producttype}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type', 'is_active', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['is_active'], 'integer'],
            [['updated_on','updated_by', 'updated_ipaddress','product_type'], 'safe'],
            ['product_type','unique'],
          
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'product_typeid' => 'Product Typeid',
            'product_type' => 'Product Type',
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
	
}
