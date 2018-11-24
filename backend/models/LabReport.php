<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_report".
 *
 * @property string $id
 * @property string $status P=Printed, N=No Report
 * @property string $testname
 * @property string $lab_testing
 * @property string $testname_id
 * @property string $lab_payment_id
 * @property string $lab_test_group
 * @property string $mr_number
 * @property string $result
 * @property string $unit_name
 * @property string $reference_name
 * @property string $textarea
 * @property string $grouping_status T=Test Group,L=LabTest
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class LabReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['status', 'user_id'], 'required'],
            [['status', 'grouping_status'], 'string'],
            [['created_at', 'updated_at','user_id'], 'safe'],
            [['testname', 'lab_testing', 'testname_id', 'lab_payment_id', 'lab_test_group', 'mr_number', 'result', 'unit_name', 'reference_name', 'textarea',  'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'testname' => 'Testname',
            'lab_testing' => 'Lab Testing',
            'testname_id' => 'Testname ID',
            'lab_payment_id' => 'Lab Payment ID',
            'lab_test_group' => 'Lab Test Group',
            'mr_number' => 'Mr Number',
            'result' => 'Result',
            'unit_name' => 'Unit Name',
            'reference_name' => 'Reference Name',
            'textarea' => 'Textarea',
            'grouping_status' => 'Grouping Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
