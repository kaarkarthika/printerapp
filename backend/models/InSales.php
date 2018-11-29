<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_sales".
 *
 * @property int $opsaleid
 * @property int $branch_id
 * @property string $sales_type O=PATIENT,I=MRNUMBER,T=TEMP PATIENT
 * @property string $return_status N=TABLET NO RETURN,Y=TABLET RETURN
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property string $physicianname
 * @property string $mrnumber
 * @property int $patienttype
 * @property string $patient_id
 * @property string $subvisit_id
 * @property string $subvisit_num
 * @property string $insurancetype
 * @property string $address
 * @property string $phonenumber
 * @property string $billnumber
 * @property string $invoicedate
 * @property string $total
 * @property string $tot_no_of_items
 * @property string $tot_quantity
 * @property double $total_gst_percent
 * @property double $total_cgst_percent
 * @property double $total_sgst_percent
 * @property double $totalgstvalue
 * @property double $totalcgstvalue
 * @property double $totalsgstvalue
 * @property double $totaldiscountvalue
 * @property double $totaltaxableamount
 * @property string $overalldiscounttype
 * @property double $overalldiscountpercent
 * @property double $overalldiscountamount
 * @property double $overall_sub_total
 * @property double $overalltotal
 * @property int $saleincrement
 * @property string $paid_status
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 * @property string $created_at
 */
class InSales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //   [['name', 'dob', 'gender', 'mrnumber',   'phonenumber', 'physicianname','branch_id','billnumber', 'invoicedate'], 'required'],
            [['dob', 'invoicedate', 'updated_on','mrnumber',  'branch_id','patienttype','updated_by', 'updated_ipaddress','billnumber','name', 'address','physicianname','paid_status'], 'safe'],
           // [['name', 'emailid','physicianname'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 255],
           // [['mrnumber',  'updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
           // [['billnumber'], 'string', 'max' => 25],
          //  ['emailid', 'email'],
            [['phonenumber'],'integer', 'integerOnly' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'opsaleid' => 'Opsaleid',
            'branch_id' => 'Branch ID',
            'sales_type' => 'Sales Type',
            'return_status' => 'Return Status',
            'name' => 'Name',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'physicianname' => 'Physicianname',
            'mrnumber' => 'Mrnumber',
            'patienttype' => 'Patienttype',
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
            'totaltaxableamount' => 'Totaltaxableamount',
            'overalldiscounttype' => 'Overalldiscounttype',
            'overalldiscountpercent' => 'Overalldiscountpercent',
            'overalldiscountamount' => 'Overalldiscountamount',
            'overall_sub_total' => 'Overall Sub Total',
            'overalltotal' => 'Overalltotal',
            'saleincrement' => 'Saleincrement',
            'paid_status' => 'Paid Status',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'created_at' => 'Created At',
        ];
    }

    public function getPhysician()
     {
         return $this->hasOne(Physicianmaster::className(), ['id' => 'physicianname']);
       }
            
      public function getTotalsaleproducts()
      {
              return Saledetail::find()->where(['opsaleid' =>'opsaleid'])->count();
        }
}
