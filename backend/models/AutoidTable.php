<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "autoid_table".
 *
 * @property string $auto
 * @property string $func
 * @property string $start_num
 * @property string $updated_at
 * @property string $ipaddress
 */
class AutoidTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autoid_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_num'], 'integer'],
            [['updated_at'], 'safe'],
            [['func'], 'string', 'max' => 200],
            [['ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto' => 'Auto',
            'func' => 'Func',
            'start_num' => 'Start Num',
            'updated_at' => 'Updated At',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
