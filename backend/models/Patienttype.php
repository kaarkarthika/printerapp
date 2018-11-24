<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "patient_type".
 *
 * @property string $type_id
 * @property string $patient_type
 * @property int $is_active
 * @property string $updated_by
 * @property string $updated_at
 * @property string $created_at
 * @property string $ip_address
 */
class PatientType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
    
    public static function tableName()
    {
        return 'patient_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'safe'],
            [['patient_type', 'ip_address'], 'string', 'max' => 255],
            [['is_active'], 'string', 'max' => 4],
            [['updated_by'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'patient_type' => 'Patient Type',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'ip_address' => 'Ip Address',
        ];
    }
}
