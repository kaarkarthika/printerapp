<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "physicianmaster".
 *
 * @property integer $id
 * @property string $physician_name
 * @property string $qualification
 * @property string $specialist
 * @property integer $is_active
 * @property string $updatedby
 * @property string $updatedon
 * @property string $updated_ipaddress
 */
class Physicianmaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'physicianmaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['physician_name', 'is_active', 'updatedby', 'updatedon', 'updated_ipaddress'], 'required'],
            [['is_active'], 'integer'],
            [['updatedon','updatedby'], 'safe'],
            [['physician_name', 'qualification', 'specialist'], 'string', 'max' => 200],
            [['updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'physician_name' => 'Physician Name',
            'qualification' => 'Qualification',
            'specialist' => 'Specialist',
            'is_active' => 'Active',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	
	
		public function afterFind() 
		{
			 parent::afterFind();	
		}
	 	public function getSpecial()
		{
        	return $this->hasOne(Specialistdoctor::className(), ['s_id' => 'specialist']);
		}
	
}
