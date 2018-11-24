<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tansi_branch_management".
 *
 * @property integer $branch_id
 * @property string $branch_name
 * @property string $branch_timestamp
 * @property string $branch_create_date
 * @property integer $branch_code
 * @property string $branch_location
 * @property string $branch_city
 * @property string $branch_mobilenumber
 * @property string $branch_status
 * @property string $service_center_id
 */
class BranchManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name', 'branch_create_date', 'branch_code', 'branch_location', 'branch_city', 'branch_mobilenumber', 'branch_status', 'service_center_id'], 'required'],
            [['branch_timestamp', 'branch_create_date'], 'safe'],
            [['branch_code'], 'integer'],
            [['branch_status'], 'string'],
            [['branch_name', 'branch_location', 'branch_city', 'branch_mobilenumber'], 'string', 'max' => 50],
            [['service_center_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_name' => 'Branch Name',
            'branch_timestamp' => 'Branch Timestamp',
            'branch_create_date' => 'Branch Create Date',
            'branch_code' => 'Branch Code',
            'branch_location' => 'Branch Location',
            'branch_city' => 'Branch City',
            'branch_mobilenumber' => 'Branch Mobilenumber',
            'branch_status' => 'Branch Status',
            'service_center_id' => 'Service Center ID',
        ];
    }
}
