<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_reference_val".
 *
 * @property string $autoid
 * @property string $test_id
 * @property string $reference_name
 * @property string $reference_value
 * @property string $gender
 * @property int $age
 * @property string $range
 * @property string $ref_from
 * @property string $ref_to
 * @property int $created_at
 * @property string $created_date
 * @property int $updated_at
 * @property string $updated_date
 */
class LabReferenceVal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $desc;
    public static function tableName()
    {
        return 'lab_reference_val';
    }

    /**
     * @inheritdoc  startt SS Code
     */
    public function rules()
    {
        return [
            [['test_id', 'gender', 'range', 'ref_from', 'ref_to'], 'required'],
            [['test_id', 'age', 'range', 'created_at', 'updated_at'], 'integer'],
            [['gender'], 'string'],
            [['created_date', 'updated_date', 'result_type','created_at', 'updated_at', 'updated_date',"age_cal", 'ref_from', 'ref_to'], 'safe'],
            [['reference_name'], 'string', 'max' => 100],
            [['ref_from','ref_to'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc  end ss code
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'test_id' => 'Test ID',
            'reference_name' => 'Reference Name',
            'reference_value' => 'Reference Value',
            'gender' => 'Gender',
            'age' => 'Age',
            'range' => 'Range',
            'ref_from' => 'Ref From',
            'ref_to' => 'Ref To',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'updated_date' => 'Updated Date',
        ];
    }
}
