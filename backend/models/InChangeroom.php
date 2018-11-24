<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_changeroom".
 *
 * @property string $autoid
 * @property string $ip_no
 * @property string $paytype
 * @property string $roomtype
 * @property string $roomno
 * @property string $bedno
 * @property string $floorno
 * @property string $unit
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $userrole
 * @property string $ipaddress
 */
class InChangeroom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_changeroom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'updated_date','user_id', 'userrole'], 'safe'],
            [['ip_no'], 'string', 'max' => 20],
            [['paytype', 'roomtype', 'roomno', 'bedno', 'floorno'], 'string', 'max' => 25],
            [['unit'], 'string', 'max' => 50],
            [['ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'ip_no' => 'Ip No',
            'paytype' => 'Paytype',
            'roomtype' => 'Roomtype',
            'roomno' => 'Roomno',
            'bedno' => 'Bedno',
            'floorno' => 'Floorno',
            'unit' => 'Unit',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'userrole' => 'Userrole',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
