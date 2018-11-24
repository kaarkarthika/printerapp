<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_theme_version".
 *
 * @property integer $autoid
 * @property string $reconcileversionname
 * @property string $reconcileversion
 * @property string $reconcileversionkey
 * @property string $timestamp
 */
class AdminThemeVersion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_theme_version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reconcileversionname', 'reconcileversion'], 'required'],
            [['timestamp'], 'safe'],
            [['reconcileversionname', 'reconcileversionkey'], 'string', 'max' => 100],
            [['reconcileversion'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'reconcileversionname' => 'Reconcileversionname',
            'reconcileversion' => 'Reconcileversion',
            'reconcileversionkey' => 'Reconcileversionkey',
            'timestamp' => 'Timestamp',
        ];
    }
}
