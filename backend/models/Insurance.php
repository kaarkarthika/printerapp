<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "insurance".
 *
 * @property integer $insurance_typeid
 * @property integer $insurance_type
 * @property integer $is_active
 * @property string $updated_on
 * @property integer $updated_by
 * @property string $updated_ipaddress
 */
class Insurance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insurance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insurance_type', 'is_active', 'updated_on', 'updated_by', 'updated_ipaddress'], 'required'],
            [[ 'is_active', 'updated_by'], 'integer'],
            [['updated_on'], 'safe'],
              [['insurance_type'], 'unique'],
            [['updated_ipaddress','insurance_type'], 'string', 'max' => 30],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'insurance_typeid' => Yii::t('app', 'Insurance Typeid'),
            'insurance_type' => Yii::t('app', 'Insurance Type'),
            'is_active' => Yii::t('app', 'Active'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
