<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stickynotes".
 *
 * @property integer $noteid
 * @property string $notetitle
 * @property string $notedesc
 * @property integer $is_active
 * @property string $colorscheme
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Stickynotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stickynotes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['notetitle', 'notedesc', 'is_active', 'colorscheme', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['notedesc', 'colorscheme'], 'string'],
            [['is_active', 'updated_by'], 'integer'],
            [['updated_on'], 'safe'],
            [['notetitle'], 'string', 'max' => 100],
            [['updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'noteid' => 'Noteid',
            'notetitle' => 'Notetitle',
            'notedesc' => 'Notedesc',
            'is_active' => 'Is Active',
            'colorscheme' => 'Colorscheme',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
