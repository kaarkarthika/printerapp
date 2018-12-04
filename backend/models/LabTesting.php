<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_testing".
 *
 * @property string $autoid
 * @property string $test_name
 * @property string $testgroupid
 * @property string $cat_id
 * @property string $subcat_id
 * @property string $unit_id
 * @property string $price
 * @property string $isactive
 * @property int $created_at
 * @property string $created_date
 * @property string $updated_date
 * @property int $updated_at
 */
class LabTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
       public $category_name;
	   public $lab_subcategory;
	   public $unit_name;
	   public $referencevalue;
    public static function tableName()
    {
        return 'lab_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[  'cat_id', 'unit_id',  'isactive' ], 'required'],
            [['testgroupid','subcat_id','created_at', 'updated_at'], 'integer'],
            [['isactive','hsncode'], 'string'],
            [['created_date','cat_id' , 'unit_id', 'updated_date','updated_at','created_at','testgroupid','test_name','price','hsncode','method','description','subcat_id','result_type','result_type_val','shortcode' ], 'safe'], // ss code
            [['test_name', 'price'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'test_name' => 'Test Name',
            'testgroupid' => 'Testgroupid',
            'cat_id' => 'Cat ID',
            'subcat_id' => 'Subcat ID',
            'unit_id' => 'Unit ID',
            'shortcode'=>'Test Code',
            'price' => 'price',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'updated_at' => 'Updated At',
        ];
    }


     public function afterFind() {
         $this->category_name = $this->category->category_name;
         $this->lab_subcategory = $this->subcategory->lab_subcategory;
		  $this->hsncode = $this->hsncodemaster->hsncode;
		 $this->unit_name = $this->unit->unit_name;
        parent::afterFind();
    }
	public function getcategory()
	{
        return $this->hasOne(LabCategory::className(), ['auto_id' => 'cat_id']);
	}
	public function getsubcategory()
	{
        return $this->hasOne(LabSubcategory::className(), ['auto_id' => 'subcat_id']);
	}
	public function getunit()
	{
        return $this->hasOne(LabUnit::className(), ['auto_id' => 'unit_id']);
	}
	public function gethsncodemaster()
	{
        return $this->hasOne(Taxgrouping::className(), ['taxgroupid' => 'hsncode']);
	}
}
