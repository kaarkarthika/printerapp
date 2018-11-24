<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ucil_validate_date".
 *
 * @property int $autoid
 * @property int $ucil_date_value
 * @property string $created_date
 */
class UcilValidateDate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucil_validate_date';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucil_date_value'], 'required'],
            [['ucil_date_value'], 'number'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'ucil_date_value' => 'Ucil Date Value',
            'created_date' => 'Created Date',
        ];
    }
}
