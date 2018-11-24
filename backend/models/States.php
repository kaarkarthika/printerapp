<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $stateid
 * @property string $state_name
 * @property integer $isactive
 * @property string $updatedby
 * @property string $updatedon
 * @property string $updatedipaddress
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_name', 'isactive', 'updatedby', 'updatedon', 'updatedipaddress'], 'required'],
            [['isactive'], 'integer'],
            [['updatedon'], 'safe'],
            [['state_name'], 'string', 'max' => 500],
            [['updatedby', 'updatedipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stateid' => 'Stateid',
            'state_name' => 'State Name',
            'isactive' => 'Isactive',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updatedipaddress' => 'Updatedipaddress',
        ];
    }
}
