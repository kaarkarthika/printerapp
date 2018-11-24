<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taxmaster".
 *
 * @property string $taxid
 * @property integer $taxvalue
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Taxmaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxmaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxvalue','financialyear','additionaltax','taxgroup'], 'required'],
            [[ 'is_active'], 'integer'],
             [['taxvalue','additionaltax'], 'double'],
            [['updated_on','updated_by', 'updated_ipaddress'], 'safe'],
           // [['updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'taxid' => 'Taxid',
            'taxvalue' => 'Tax Value (%)',
            'is_active' => 'Active',
            'taxgroup'=>'Tax Group',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
             'financialyear' => 'Financial Year',
               'additionaltax' => 'Additional Tax (%)',
        ];
    }
}
