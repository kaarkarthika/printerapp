<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%taxmaster}}".
 *
 * @property string $taxid
 * @property double $taxvalue
 * @property string $taxgroup
 * @property string $financialyear
 * @property double $additionaltax
 * @property int $is_active
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
        return '{{%taxmaster}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxvalue', 'taxgroup', 'financialyear', 'additionaltax', 'is_active', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['taxvalue', 'additionaltax'], 'number'],
            [['updated_by','updated_on'], 'safe'],
            [['taxgroup'], 'string', 'max' => 50],
            [['financialyear'], 'string', 'max' => 100],
            [['is_active'], 'string', 'max' => 1],
            [[ 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'taxid' => 'Taxid',
            'taxvalue' => 'Tax Value',
            'taxgroup' => 'Tax Group',
            'financialyear' => 'Financial Year',
            'additionaltax' => 'Additional Tax',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
