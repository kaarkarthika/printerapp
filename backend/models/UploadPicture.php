<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "upload_picture".
 *
 * @property string $id
 * @property string $mr_number
 * @property string $sub_visit
 * @property string $upload_picture
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */

class UploadPicture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
 //    public $upload_picture;
    public static function tableName()
    {
        return 'upload_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        //	[['upload_picture'], 'file'],
            [['upload_picture'], 'string'],
            [['created_at', 'updated_at','user_id'], 'safe'],
            [['mr_number', 'sub_visit'], 'string', 'max' => 200],
            [[ 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mr_number' => Yii::t('app', 'Mr Number'),
            'sub_visit' => Yii::t('app', 'Sub Visit'),
            'upload_picture' => Yii::t('app', 'Upload Picture'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_id' => Yii::t('app', 'User ID'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
