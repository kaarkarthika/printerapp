<?php

namespace backend\models;

use Yii;
use backend\models\BranchManagement;
/**
 * This is the model class for table "tansi_service_advisor".
 *
 * @property string $sa_autoid
 * @property string $sa_branch
 * @property string $sa_name
 * @property string $sa_code
 * @property string $sa_shift_from
 * @property string $sa_shift_to
 * @property string $sa_status
 * @property string $customer_id
 * @property string $sa_time_id
 * @property string $sa_timestamp
 */
class ServiceAdvisor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $branchname;
    public static function tableName()
    {
        return 'service_advisor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sa_branch', 'sa_name', 'sa_code', 'sa_shift_from', 'sa_shift_to'], 'required'],
            [['sa_shift_from', 'sa_shift_to', 'sa_timestamp'], 'safe'],
            [['sa_status'], 'string'],
            [['sa_branch', 'sa_name', 'sa_code', 'customer_id', 'sa_time_id'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sa_autoid' => 'Sa Autoid',
            'sa_branch' => 'Branch',
            'sa_name' => 'Name',
            'sa_code' => 'Code',
            'sa_shift_from' => 'Shift From',
            'sa_shift_to' => 'Shift To',
            'sa_status' => 'Status',
            'customer_id' => 'Customer ID',
            'sa_time_id' => 'Sa Time ID',
            'sa_timestamp' => 'Timestamp',
            'branchname' => 'Branch Name',
        ];
    }

    public function afterFind() {
        
         $this->branchname = $this->branch->branch_name; 

        parent::afterFind();
    }


    public function getBranch()
    {

        return $this->hasOne(BranchManagement::className(), ['branch_id' => 'sa_branch']);
    }
}
