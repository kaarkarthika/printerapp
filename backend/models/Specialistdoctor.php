<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "specialistdoctor".
 *
 * @property string $s_id
 * @property string $specialist
 * @property int $updated_by
 * @property string $updated_at
 * @property string $created_at
 * @property string $ip_address
 */
class Specialistdoctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialistdoctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at','updated_by'], 'safe'],
            [['specialist', 'ip_address'], 'string', 'max' => 255],
            [['ucil_amount'],'number'],
            [['specialist', 'is_active','consult_amount','ucil_amount'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's_id' => 'S ID',
            'specialist' => 'Specialist',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'ip_address' => 'Ip Address',
        ];
    }
}
