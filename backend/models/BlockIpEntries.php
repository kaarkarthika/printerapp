<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "block_ip_entries".
 *
 * @property int $auto_id
 * @property string $ip_no
 * @property string $mr_no
 * @property string $patient_name
 * @property string $address
 * @property int $age
 * @property string $sex
 * @property string $phone_no
 * @property string $mobile_no
 * @property string $doctor_name
 * @property string $doctor_name_2
 * @property string $admit_date
 * @property string $discharge_date
 * @property string $relative_name
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property string $updated_at
 * @property string $created_at
 * @property string $ip_address
 * @property string $user_id
 * @property string $in_reg_id
 * @property string $user_name
 */
class BlockIpEntries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_ip_entries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['auto_id', 'ip_no', 'mr_no', 'patient_name', 'address', 'age', 'sex', 'phone_no', 'mobile_no', 'doctor_name', 'doctor_name_2', 'admit_date', 'discharge_date', 'relative_name', 'city', 'state', 'pincode', 'created_at', 'ip_address', 'user_id', 'in_reg_id', 'user_name'], 'required'],
           // [['auto_id', 'ip_no', 'mr_no', 'age', 'phone_no', 'mobile_no', 'user_id', 'in_reg_id'], 'integer'],
           // [['address'], 'string'],
            [['auto_id', 'ip_no', 'mr_no', 'patient_name', 'address', 'age', 'sex', 'phone_no', 'mobile_no', 'doctor_name', 'doctor_name_2', 'admit_date', 'discharge_date', 'relative_name', 'city', 'state', 'pincode', 'created_at', 'ip_address', 'user_id', 'in_reg_id', 'user_name','admit_date', 'discharge_date', 'updated_at', 'created_at'], 'safe'],
            [['patient_name', 'doctor_name', 'doctor_name_2', 'relative_name', 'ip_address', 'user_name'], 'string', 'max' => 255],
            [['sex', 'city', 'state'], 'string', 'max' => 100],
           // [['pincode'], 'string', 'max' => 50],
            [['auto_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'ip_no' => 'Ip No',
            'mr_no' => 'Mr No',
            'patient_name' => 'Patient Name',
            'address' => 'Address',
            'age' => 'Age',
            'sex' => 'Sex',
            'phone_no' => 'Phone No',
            'mobile_no' => 'Mobile No',
            'doctor_name' => 'Doctor Name',
            'doctor_name_2' => 'Doctor Name 2',
            'admit_date' => 'Admit Date',
            'discharge_date' => 'Discharge Date',
            'relative_name' => 'Relation Name',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'ip_address' => 'Ip Address',
            'user_id' => 'User ID',
            'in_reg_id' => 'In Reg ID',
            'user_name' => 'User Name',
        ];
    }
}
