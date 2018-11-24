<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_unit".
 *
 * @property string $auto_id
 * @property string $unit_name
 * @property string $unit_value
 * @property string $unit_type
 * @property string $referencesymbol
 * @property string $isactive
 * @property string $created_at
 * @property string $created_date
 * @property string $update_at
 * @property string $update_date
 */
class LabUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_name', 'unit_value', 'isactive' ], 'required'],
            [['isactive'], 'string'],
            [['created_date', 'update_date', 'unit_type', 'referencesymbol','created_at', 'update_at'], 'safe'],
            [['unit_name', 'unit_value', 'unit_type', 'referencesymbol'], 'string', 'max' => 100],
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
            'unit_name' => 'Unit Name',
            'unit_value' => 'Unit Value',
            'unit_type' => 'Unit Type',
            'referencesymbol' => 'Referencesymbol',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'update_at' => 'Update At',
            'update_date' => 'Update Date',
        ];
    }
	public function del($id)
    {
		print_r("test");
		print_r($id);
	}
	
}
