<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lab_payment_prime".
 *
 * @property string $lab_id
 * @property string $payment_status P-Paid,U-Unpaid,R-Refund
 * @property string $mr_number
 * @property string $name
 * @property string $ph_number
 * @property string $physican_name
 * @property string $insurance
 * @property string $dob
 * @property int $overall_item
 * @property double $overall_gst_per
 * @property double $overall_cgst_per
 * @property double $overall_sgst_per
 * @property double $overall_gst_amt
 * @property double $overall_cgst_amt
 * @property double $overall_sgst_amt
 * @property double $overall_dis_type
 * @property double $overall_dis_percent
 * @property double $overall_dis_amt
 * @property double $overall_sub_total
 * @property double $overall_net_amt
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class LabPaymentPrime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
    
    public static function tableName()
    {
        return 'lab_payment_prime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
        	[['name'], 'required'],
            [['payment_status'], 'string'],
            [['dob', 'created_at', 'updated_at', 'user_id', 'updated_ipaddress','status','sample_test','bill_number'], 'safe'],
            [['overall_item'], 'integer'],
            [['overall_gst_per', 'overall_cgst_per', 'overall_sgst_per', 'overall_gst_amt', 'overall_cgst_amt', 'overall_sgst_amt', 'overall_dis_type', 'overall_dis_percent', 'overall_dis_amt', 'overall_sub_total', 'overall_net_amt'], 'number'],
            [['mr_number', 'name', 'ph_number', 'physican_name', 'insurance'], 'string', 'max' => 50],
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
            'mr_number' => 'Mr Number',
            'name' => 'Name',
            'ph_number' => 'Ph Number',
            'physican_name' => 'Physican Name',
            'insurance' => 'Insurance',
            'dob' => 'Dob',
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
