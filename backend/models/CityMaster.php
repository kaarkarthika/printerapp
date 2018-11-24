<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "city_master".
 *
 * @property string $id
 * @property string $city
 * @property string $district
 * @property string $state
 * @property string $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 */
class CityMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'district', 'state'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['city'], 'unique'],
          //  [['city', 'district', 'state', 'ip_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'district' => 'District',
            'state' => 'State',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
        ];
    }
}
