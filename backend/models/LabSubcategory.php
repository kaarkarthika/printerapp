<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_subcategory".
 *
 * @property string $auto_id
 * @property string $lab_subcategory
 * @property string $category_id
 * @property string $isactive
 * @property string $created_at
 * @property string $created_date
 * @property string $update_at
 * @property string $update_date
 */
class LabSubcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        public $category_name;
    public static function tableName()
    {
        return 'lab_subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'isactive','lab_subcategory'], 'required'],
            [['isactive'], 'string'],
          //  [['lab_subcategory'],'unique'],
            [['created_date', 'update_date', 'created_at', 'update_at'], 'safe'],
            [['lab_subcategory', 'category_id'], 'string', 'max' => 100],
            [['created_at', 'update_at'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'lab_subcategory' => 'Lab Subcategory',
            'category_id' => 'Category ID',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'update_at' => 'Update At',
            'update_date' => 'Update Date',
        ];
    }
	 public function afterFind() {
         $this->category_name = $this->category->category_name;
        parent::afterFind();
    }
	public function getcategory()
	{
        return $this->hasOne(LabCategory::className(), ['auto_id' => 'category_id']);
	}
}
