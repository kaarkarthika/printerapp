<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ucil".
 *
 * @property int $id
 * @property string $mr_number
 * @property string $ucil_emp_id
 * @property string $pat_come
 * @property string $ucil_date
 * @property string $status_given
 * @property string $claim_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $ipaddress
 */
class Ucil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pat_come', 'ucil_date', 'created_at', 'updated_at'], 'safe'],
            [['status_given', 'claim_status'], 'string'],
            [['mr_number', 'ucil_emp_id'], 'string', 'max' => 50],
            [['ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mr_number' => 'Mr Number',
            'ucil_emp_id' => 'Ucil Emp ID',
            'pat_come' => 'Pat Come',
            'ucil_date' => 'Ucil Date',
            'status_given' => 'Status Given',
            'claim_status' => 'Claim Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
