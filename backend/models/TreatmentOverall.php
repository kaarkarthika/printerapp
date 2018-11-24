<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "treatment_overall".
 *
 * @property string $id
 * @property string $refund_status
 * @property string $name
 * @property string $dob
 * @property string $physicianname
 * @property string $mrnumber
 * @property string $patient_id
 * @property string $subvisit_id
 * @property string $subvisit_num
 * @property string $insurancetype
 * @property string $address
 * @property string $phonenumber
 * @property string $billnumber
 * @property string $invoicedate
 * @property double $total
 * @property integer $tot_no_of_items
 * @property integer $tot_quantity
 * @property double $total_gst_percent
 * @property double $total_cgst_percent
 * @property double $total_sgst_percent
 * @property double $totalgstvalue
 * @property double $totalcgstvalue
 * @property double $totalsgstvalue
 * @property double $totaldiscountvalue

 * @property string $overalldiscounttype
 * @property double $overalldiscountpercent
 * @property double $overalldiscountamount
 * @property double $overall_sub_total
 * @property double $overalltotal
 * @property string $user_id
 * @property string $user_role
 * @property string $created_at
 * @property string $updated_at
 * @property string $ipaddress
 */
class TreatmentOverall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'treatment_overall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refund_status'], 'string'],
            [['invoicedate', 'created_at', 'updated_at', 'user_id'], 'safe'],
            [['total', 'total_gst_percent', 'total_cgst_percent', 'total_sgst_percent', 'totalgstvalue', 'totalcgstvalue', 'totalsgstvalue', 'totaldiscountvalue',  'overalldiscountpercent', 'overalldiscountamount', 'overall_sub_total', 'overalltotal'], 'number'],
            [['tot_no_of_items', 'tot_quantity'], 'integer'],
            [['name', 'dob', 'mrnumber', 'patient_id', 'subvisit_id', 'subvisit_num', 'insurancetype', 'address', 'phonenumber', 'billnumber', 'ipaddress'], 'string', 'max' => 255],
            [['physicianname', 'user_role'], 'string', 'max' => 50],
            [['overalldiscounttype'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
     public $dr_name;
	 public $insurance_type;
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'refund_status' => 'Refund Status',
            'name' => 'Name',
            'dob' => 'Dob',
            'physicianname' => 'Physicianname',
            'mrnumber' => 'Mrnumber',
            'patient_id' => 'Patient ID',
            'subvisit_id' => 'Subvisit ID',
            'subvisit_num' => 'Subvisit Num',
            'insurancetype' => 'Insurancetype',
            'address' => 'Address',
            'phonenumber' => 'Phonenumber',
            'billnumber' => 'Billnumber',
            'invoicedate' => 'Invoicedate',
            'total' => 'Total',
            'tot_no_of_items' => 'Tot No Of Items',
            'tot_quantity' => 'Tot Quantity',
            'total_gst_percent' => 'Total Gst Percent',
            'total_cgst_percent' => 'Total Cgst Percent',
            'total_sgst_percent' => 'Total Sgst Percent',
            'totalgstvalue' => 'Totalgstvalue',
            'totalcgstvalue' => 'Totalcgstvalue',
            'totalsgstvalue' => 'Totalsgstvalue',
            'totaldiscountvalue' => 'Totaldiscountvalue',
       
            'overalldiscounttype' => 'Overalldiscounttype',
            'overalldiscountpercent' => 'Overalldiscountpercent',
            'overalldiscountamount' => 'Overalldiscountamount',
            'overall_sub_total' => 'Overall Sub Total',
            'overalltotal' => 'Overalltotal',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ipaddress' => 'Ipaddress',
        ];
    }
	public function afterFind() 
	{
         $this->dr_name = $this->physion->physician_name;
		 $this->insurance_type = $this->insurance->insurance_type;
         parent::afterFind();
    }
	public function getphysion()
	{
        return $this->hasOne(Physicianmaster::className(), ['id' => 'physicianname']);
	}
	public function getinsurance()
	{
        return $this->hasOne(Insurance::className(), ['insurance_typeid' => 'insurancetype']);
	}

}
