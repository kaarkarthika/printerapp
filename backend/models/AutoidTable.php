<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%auto_idtable}}".
 *
 * @property int $id
 * @property string $name
 * @property string $number_field
 * @property string $updated_at
 */
class AutoIdtable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auto_idtable}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at'], 'safe'],
            [['name', 'number_field'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number_field' => 'Number Field',
            'updated_at' => 'Updated At',
        ];
    }
}
