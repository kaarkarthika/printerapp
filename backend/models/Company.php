<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;

/**
 * This is the model class for table "company".
 *
 * @property integer $company_id
 * @property string $company_code
 * @property string $company_name
 * @property string $company_type
 * @property string $cin
 * @property string $pan
 * @property string $dln1
 * @property string $dln2
 * @property string $dln3
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_code', 'company_name', 'company_type',], 'required'],
            [['is_active'], 'integer'],
            [['updated_on','company_code','company_name','company_type', 'cin', 'pan', 'dln1', 'dln2', 'dln3','updated_by','updated_ipaddress'], 'safe'],
          //  [['company_code'], 'string', 'max' => 10],
         //   [['company_name'], 'string', 'max' => 100],
          //  [['company_type', 'cin', 'pan', 'dln1', 'dln2', 'dln3'], 'string', 'max' => 25],
          //  [['updated_by'], 'string', 'max' => 20],
           // [['updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_code' => 'Company Code',
            'company_name' => 'Company Name',
            'company_type' => 'Company Type',
            'cin' => 'Cin',
            'pan' => 'Pan',
            'dln1' => 'Dln1',
            'dln2' => 'Dln2',
            'dln3' => 'Dln3',
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
