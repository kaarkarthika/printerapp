<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "salesreturn".
 *
 * @property integer $return_id
 * @property string $return_invoicenumber
 * @property integer $patient_type
 * @property string $mrnumber
 * @property integer $return_quantity
 * @property integer $is_active
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Salesreturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salesreturn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['return_invoicenumber', 'branch_id'], 'required'],
            [['patient_type',  'is_active', 'updated_by','branch_id'], 'integer'],
            [['updated_on','return_invoicenumber', 'branch_id'], 'safe'],
            [['return_invoicenumber', 'mrnumber', 'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'return_id' => 'Return ID',
            'return_invoicenumber' => 'Return Invoice Number',
            'patient_type' => 'Patient Type',
            'mrnumber' => 'Medical Record Number',
         
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
