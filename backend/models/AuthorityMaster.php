<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "authority_master".
 *
 * @property string $autoid
 * @property string $authorityname
 * @property int $isactive
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 */
class AuthorityMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authority_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at','user_id', 'user_role'], 'safe'],
            [['authorityname', ], 'string', 'max' => 50],
            [['isactive'], 'string', 'max' => 2],
            [['ipaddress'], 'string', 'max' => 100],
            [['authorityname'],'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'authorityname' => 'Authorityname',
            'isactive' => 'Isactive',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
