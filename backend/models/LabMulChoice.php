<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_mul_choice".
 *
 * @property string $autoid
 * @property string $test_id
 * @property string $mulname
 * @property int $created_at
 * @property string $created_date
 * @property int $updated_at
 * @property string $updated_date
 */
class LabMulChoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_mul_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'updated_at'], 'required'],
            [['test_id', 'created_at', 'updated_at'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['mulname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'test_id' => 'Test ID',
            'mulname' => 'Mulname',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'updated_at' => 'Updated At',
            'updated_date' => 'Updated Date',
        ];
    }
}
