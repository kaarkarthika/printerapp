<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%configuration}}".
 *
 * @property int $id
 * @property string $key_drop
 * @property string $value
 * @property string $create_by
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%configuration}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_by'], 'safe'],
            [['key_drop', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_drop' => 'Key Drop',
            'value' => 'Value',
            'create_by' => 'Create By',
        ];
    }
}
