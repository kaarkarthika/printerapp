<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_payment_prime_cancel".
 *
 * @property string $lab_id
 * @property string $payment_prime_id
 * @property string $payment_status P=PAID,U=UNPAID,R=REFUND
 * @property string $lab_common_id
 * @property string $mr_number
 * @property string $mr_id
 * @property string $sub_id
 * @property string $subvisit_number
 * @property string $name
 * @property string $ph_number
 * @property string $physican_name
 * @property string $insurance
 * @property string $dob
 * @property int $overall_item
 * @property double $can_overall_gst_per
 * @property double $can_overall_cgst_per
 * @property double $can_overall_sgst_per
 * @property double $can_overall_gst_amt
 * @property double $can_overall_cgst_amt
 * @property double $can_overall_sgst_amt
 * @property string $can_overall_dis_type F=Flat,P=Percentage
 * @property double $can_overall_dis_percent
 * @property double $can_overall_dis_amt
 * @property double $can_overall_sub_total
 * @property double $can_overall_net_amt
 * @property double $can_overall_paid_amt
 * @property double $can_overall_due_amt
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
 * @property int $user_id
 * @property string $updated_ipaddress
 */
class LabPaymentPrimeCancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_payment_prime_cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['payment_prime_id', 'payment_status', 'lab_common_id', 'mr_number', 'mr_id', 'sub_id', 'subvisit_number', 'name', 'ph_number', 'physican_name', 'insurance', 'dob', 'overall_item', 'can_overall_gst_per', 'can_overall_cgst_per', 'can_overall_sgst_per', 'can_overall_gst_amt', 'can_overall_cgst_amt', 'can_overall_sgst_amt', 'can_overall_dis_type', 'can_overall_dis_percent', 'can_overall_dis_amt', 'can_overall_sub_total', 'can_overall_net_amt', 'can_overall_paid_amt', 'can_overall_due_amt', 'sample_test', 'remarks', 'authority', 'outsourcetest', 'remarks_outsource', 'remarks_report', 'file_path', 'created_at', 'user_id', 'updated_ipaddress'], 'required'],
            [['payment_prime_id', 'overall_item', 'user_id'], 'integer'],
            [['payment_status', 'can_overall_dis_type', 'remarks_outsource', 'remarks_report', 'status'], 'string'],
            [['dob', 'sample_date', 'sample_received_date', 'report_received_date', 'created_at', 'updated_at'], 'safe'],
            [['can_overall_gst_per', 'can_overall_cgst_per', 'can_overall_sgst_per', 'can_overall_gst_amt', 'can_overall_cgst_amt', 'can_overall_sgst_amt', 'can_overall_dis_percent', 'can_overall_dis_amt', 'can_overall_sub_total', 'can_overall_net_amt', 'can_overall_paid_amt', 'can_overall_due_amt'], 'number'],
            [['lab_common_id', 'mr_number', 'name', 'ph_number', 'physican_name', 'insurance'], 'string', 'max' => 50],
            [['mr_id', 'sub_id', 'subvisit_number', 'remarks', 'authority', 'file_path', 'updated_ipaddress'], 'string', 'max' => 255],
            [['sample_test', 'outsourcetest'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_id' => 'Lab ID',
            'payment_prime_id' => 'Payment Prime ID',
            'payment_status' => 'Payment Status',
            'lab_common_id' => 'Lab Common ID',
            'mr_number' => 'Mr Number',
            'mr_id' => 'Mr ID',
            'sub_id' => 'Sub ID',
            'subvisit_number' => 'Subvisit Number',
            'name' => 'Name',
            'ph_number' => 'Ph Number',
            'physican_name' => 'Physican Name',
            'insurance' => 'Insurance',
            'dob' => 'Dob',
            'overall_item' => 'Overall Item',
            'can_overall_gst_per' => 'Can Overall Gst Per',
            'can_overall_cgst_per' => 'Can Overall Cgst Per',
            'can_overall_sgst_per' => 'Can Overall Sgst Per',
            'can_overall_gst_amt' => 'Can Overall Gst Amt',
            'can_overall_cgst_amt' => 'Can Overall Cgst Amt',
            'can_overall_sgst_amt' => 'Can Overall Sgst Amt',
            'can_overall_dis_type' => 'Can Overall Dis Type',
            'can_overall_dis_percent' => 'Can Overall Dis Percent',
            'can_overall_dis_amt' => 'Can Overall Dis Amt',
            'can_overall_sub_total' => 'Can Overall Sub Total',
            'can_overall_net_amt' => 'Can Overall Net Amt',
            'can_overall_paid_amt' => 'Can Overall Paid Amt',
            'can_overall_due_amt' => 'Can Overall Due Amt',
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
}
