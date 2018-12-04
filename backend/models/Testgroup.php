<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "testgroup".
 *
 * @property string $autoid
 * @property string $testgroupname
 * @property string $testnameid
 * @property int $price
 * @property int $isactive
 * @property string $created_at
 * @property string $created_date
 * @property string $updated_at
 * @property string $updated_date
 */
class Testgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $test_name;
	 public $hsncode1;
    public static function tableName()
    {
        return 'testgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [[''], 'required'],
            [[ 'price','created_at', 'updated_at' ,'isactive'], 'integer'],
            [['created_date', 'updated_date','testnameid','testnameid', 'testgroupname','isactive','price','hsncode','shortcode'], 'safe'],
            [['testgroupname'], 'string', 'max' => 100],
            //[[''], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    { 
        return [
            'autoid' => 'Autoid',
            'testgroupname' => 'Testgroupname',
            'testnameid' => 'Testnameid',
            'price' => 'Price',
            'isactive' => 'Isactive',
            'shortcode'=>'Short Code',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'updated_date' => 'Updated Date',
            'hsncode1'=>$hsncode1,
        ];
    }
	public function afterFind() {
		 $this->hsncode1=$this->hsncode;
         $this->test_name = $this->group->test_name;
		 $this->hsncode = $this->hsncodemaster->hsncode;
        parent::afterFind();
    }
	public function getgroup()
	{
        return $this->hasOne(LabTesting::className(), ['autoid' => 'testnameid']);
	}
	public function gethsncodemaster()
	{  
        return $this->hasOne(Taxgrouping::className(), ['taxgroupid' => 'hsncode']);
	}
}
