<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%config_year}}".
 *
 * @property int $id
 * @property string $curr_year
 */
class ConfigYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config_year}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curr_year'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'curr_year' => 'Curr Year',
        ];
    }
}
