<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "manufacturermaster".
 *
 * @property integer $id
 * @property string $manufacturer_name
 * @property string $manufacturer_description
 * @property integer $is_active
 * @property string $updatedby
 * @property string $updatedon
 * @property string $updated_ipaddress
 */
class Manufacturermaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturermaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer_name', 'manufacturer_description', 'is_active', 'updatedby', 'updatedon', 'updated_ipaddress'], 'required'],
            [['is_active'], 'integer'],
            [['updatedon','updatedby'], 'safe'],
            [['manufacturer_name', 'manufacturer_description'], 'string', 'max' => 2000],
            [[ 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manufacturer_name' => 'Manufacturer Name',
            'manufacturer_description' => 'Manufacturer Description',
            'is_active' => 'Active',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
