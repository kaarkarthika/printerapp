<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "main_testgroup".
 *
 * @property string $autoid
 * @property string $testgroupname
 * @property string $price
 * @property string $hsncode
 * @property int $isactive
 * @property string $created_at
 * @property string $created_date
 * @property string $updated_at
 * @property string $updated_date
 */
class MainTestgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_testgroup';
    }

    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
            [['isactive'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['testgroupname', 'hsncode'], 'string', 'max' => 100],
            [['price'], 'string', 'max' => 20],
            [['isactive'], 'string', 'max' => 4],
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
            'price' => 'Price',
            'hsncode' => 'Hsncode',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'updated_date' => 'Updated Date',
        ];
    }
	public function afterFind() {
		 $this->hsncode1=$this->hsncode;
        // $this->test_name = $this->group->test_name;
		 $this->hsncode = $this->hsncodemaster->hsncode;
        parent::afterFind();
    }
	public function getgroup()
	{
    //    return $this->hasOne(LabTesting::className(), ['autoid' => 'testnameid']);
	}
	public function gethsncodemaster()
	{
        return $this->hasOne(Taxgrouping::className(), ['taxgroupid' => 'hsncode']);
	}
}
