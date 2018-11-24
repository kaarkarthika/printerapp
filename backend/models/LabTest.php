<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_test".
 *
 * @property string $autoid
 * @property string $lab_name
 * @property int $isactive
 * @property string $hsncode
 * @property string $amount
 * @property string $created_at
 * @property string $created_date
 * @property string $update_at
 * @property string $updated_date
 */
class LabTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_name', 'isactive', 'hsncode', 'amount', 'created_at', 'update_at'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['lab_name', 'hsncode', 'amount'], 'string', 'max' => 100],
            [['isactive'], 'string', 'max' => 4],
            [['created_at', 'update_at'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'lab_name' => 'Lab Name',
            'isactive' => 'Isactive',
            'hsncode' => 'Hsncode',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'created_date' => 'Created Date',
            'update_at' => 'Update At',
            'updated_date' => 'Updated Date',
        ];
    }
}
