<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "treatment".
 *
 * @property integer $id
 * @property string $treatment_name
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 * @property string $userrole
 */
class Treatment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $hsncode1;
    public static function tableName()
    {
        return 'treatment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['code'], 'unique'],
        	 [['amount'], 'number'],
            [['treatment_name','amount','code','hsn_code'], 'required'],
            [['created_at','hsn_code','updated_at','user_id','is_active'], 'safe'],
            [['treatment_name',  'updated_ipaddress', 'userrole'], 'string', 'max' => 255],
          //  [['user_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'treatment_name' => 'Treatment Name',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
            'userrole' => 'Userrole',
        ];
    }
	public function afterFind() {
		 $this->hsncode1=$this->hsn_code;
        // $this->test_name = $this->group->test_name;
        if(isset($this->hsncode1)){
        	$this->hsncode1 = $this->hsncodemaster->hsncode;	
        }
		 
        parent::afterFind();
    }
	public function getgroup()
	{
    //    return $this->hasOne(LabTesting::className(), ['autoid' => 'testnameid']);
	}
	public function gethsncodemaster()
	{
        return $this->hasOne(Taxgrouping::className(), ['taxgroupid' => 'hsn_code']);
	}
	
}
