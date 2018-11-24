<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_lab_payment_prime".
 *
 * @property string $lab_id
 * @property string $payment_status P-Paid,U-Unpaid,R-Refund
 * @property string $lab_common_id
 * @property string $mr_number
 * @property string $mr_id
 * @property string $sub_id
 * @property string $subvisit_num
 * @property string $name
 * @property string $ph_number
 * @property string $physican_name
 * @property string $insurance
 * @property string $dob
 * @property string $bill_number
 * @property int $overall_item
 * @property double $overall_gst_per
 * @property double $overall_cgst_per
 * @property double $overall_sgst_per
 * @property double $overall_gst_amt
 * @property double $overall_cgst_amt
 * @property double $overall_sgst_amt
 * @property string $overall_dis_type P=Percentage,F=Flat
 * @property double $overall_dis_percent
 * @property double $overall_dis_amt
 * @property double $overall_sub_total
 * @property double $overall_net_amt
 * @property double $overall_paid_amt
 * @property double $overall_due_amt
 * @property int $sample_test
 * @property string $sample_date
 * @property string $remarks
 * @property string $authority
 * @property int $outsourcetest
 * @property string $remarks_outsource
 * @property string $sample_received_date
 * @property string $report_received_date
 * @property string $remarks_report
 * @property string $file_path
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class InLabPaymentPrime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_lab_payment_prime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_status', 'overall_dis_type', 'remarks_outsource', 'remarks_report', 'status'], 'string'],
            [['dob', 'sample_date', 'sample_received_date', 'report_received_date', 'created_at', 'updated_at'], 'safe'],
            [['overall_item'], 'integer'],
            [['overall_gst_per', 'overall_cgst_per', 'overall_sgst_per', 'user_id', 'overall_gst_amt', 'overall_cgst_amt', 'overall_sgst_amt', 'overall_dis_percent', 'overall_dis_amt', 'overall_sub_total', 'overall_net_amt', 'overall_paid_amt', 'overall_due_amt'], 'number'],
            [['lab_common_id', 'mr_number', 'name', 'ph_number', 'physican_name', 'insurance', 'updated_ipaddress'], 'string', 'max' => 50],
            [['mr_id', 'sub_id', 'subvisit_num', 'remarks', 'authority', 'file_path'], 'string', 'max' => 255],
            [['bill_number'], 'string', 'max' => 100],
            [['sample_test'], 'string', 'max' => 4],
            [['outsourcetest'], 'string', 'max' => 2],
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
            'lab_id' => 'Lab ID',
            'payment_status' => 'Payment Status',
            'lab_common_id' => 'Lab Common ID',
            'mr_number' => 'Mr Number',
            'mr_id' => 'Mr ID',
            'sub_id' => 'Sub ID',
            'subvisit_num' => 'Subvisit Num',
            'name' => 'Name',
            'ph_number' => 'Ph Number',
            'physican_name' => 'Physican Name',
            'insurance' => 'Insurance',
            'dob' => 'Dob',
            'bill_number' => 'Bill Number',
            'overall_item' => 'Overall Item',
            'overall_gst_per' => 'Overall Gst Per',
            'overall_cgst_per' => 'Overall Cgst Per',
            'overall_sgst_per' => 'Overall Sgst Per',
            'overall_gst_amt' => 'Overall Gst Amt',
            'overall_cgst_amt' => 'Overall Cgst Amt',
            'overall_sgst_amt' => 'Overall Sgst Amt',
            'overall_dis_type' => 'Overall Dis Type',
            'overall_dis_percent' => 'Overall Dis Percent',
            'overall_dis_amt' => 'Overall Dis Amt',
            'overall_sub_total' => 'Overall Sub Total',
            'overall_net_amt' => 'Overall Net Amt',
            'overall_paid_amt' => 'Overall Paid Amt',
            'overall_due_amt' => 'Overall Due Amt',
            'sample_test' => 'Sample Test',
            'sample_date' => 'Sample Date',
            'remarks' => 'Remarks',
            'authority' => 'Authority',
            'outsourcetest' => 'Outsourcetest',
            'remarks_outsource' => 'Remarks Outsource',
            'sample_received_date' => 'Sample Received Date',
            'report_received_date' => 'Report Received Date',
            'remarks_report' => 'Remarks Report',
            'file_path' => 'File Path',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
    public function labprint($id){
   

    }
    public function afterFind() 
    {
         $this->dr_name = $this->physion->physician_name;
         $this->insurance_type = $this->insurance->insurance_type;
         parent::afterFind();
    }
    public function getphysion()
    {
        return $this->hasOne(Physicianmaster::className(), ['id' => 'physican_name']);
    }
    public function getinsurance()
    {
        return $this->hasOne(Insurance::className(), ['insurance_typeid' => 'insurance']);
    }
}
