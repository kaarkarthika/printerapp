<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_category".
 *
 * @property string $auto_id
 * @property string $category_name
 * @property string $isactive
 * @property string $created_at
 * @property string $created_date
 * @property string $update_at
 * @property string $update_date
 */
class LabCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'isactive'], 'required'],
            [['isactive'], 'string'],
            [['category_name'],'unique'],
            [['category_name','created_date', 'update_date', 'created_at', 'update_at'], 'safe'],
            [['category_name'], 'string', 'max' => 100],
            [['created_at'], 'string', 'max' => 10],
            [['update_at'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'category_name' => 'Category Name',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'update_at' => 'Update At',
            'update_date' => 'Update Date',
        ];
    }
	
}
