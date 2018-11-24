<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_registration".
 *
 * @property string $autoid
 * @property string $patient_type
 * @property string $registered
 * @property string $panel_type
 * @property string $mr_no
 * @property string $ip_no
 * @property string $name_initial
 * @property string $patient_name
 * @property string $dob
 * @property string $sex
 * @property string $marital_status
 * @property string $relation_suffix
 * @property string $relative_name
 * @property string $address
 * @property string $city
 * @property string $district
 * @property string $state
 * @property string $pincode
 * @property string $phone_no
 * @property string $mobile_no
 * @property string $country
 * @property string $religion
 * @property string $type
 * @property string $refered_name
 * @property string $ucil_from
 * @property string $ucil_to
 * @property string $paytype
 * @property string $bed_no
 * @property string $room_no
 * @property string $floor_no
 * @property string $room_type
 * @property string $consultant_dr
 * @property string $dr_unit
 * @property string $speciality
 * @property string $co_consultant
 * @property string $diagnosis
 * @property string $remarks
 * @property int $is_active
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $userrole
 * @property string $ipaddress
 */
class InRegistration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dob', 'created_date', 'updated_date', 'user_id', 'userrole','is_active'], 'safe'],
            [['address', 'remarks','refered_name','ucil_from','ucil_to'], 'string'],
            [['patient_type', 'registered', 'mr_no', 'ip_no', 'patient_name', 'relative_name', 'city', 'district', 'state', 'country', 'religion', 'consultant_dr', 'dr_unit', 'speciality', 'co_consultant', 'diagnosis'], 'string', 'max' => 50],
            [['panel_type', 'name_initial', 'marital_status'], 'string', 'max' => 20],
            [['sex', 'relation_suffix', 'pincode'], 'string', 'max' => 10],
            [['phone_no', 'mobile_no'], 'string', 'max' => 15],
            [['type', 'paytype', 'bed_no', 'room_no', 'floor_no', 'room_type'], 'string', 'max' => 25],
            //[[], 'string', 'max' => 2],
            [['ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'patient_type' => 'Patient Type',
            'registered' => 'Registered',
            'panel_type' => 'Panel Type',
            'mr_no' => 'Mr No',
            'ip_no' => 'Ip No',
            'name_initial' => 'Name Initial',
            'patient_name' => 'Patient Name',
            'dob' => 'Dob',
            'sex' => 'Sex',
            'marital_status' => 'Marital Status',
            'relation_suffix' => 'Relation Suffix',
            'relative_name' => 'Relative Name',
            'address' => 'Address',
            'city' => 'City',
            'district' => 'District',
            'state' => 'State',
            'pincode' => 'Pincode',
            'phone_no' => 'Phone No',
            'mobile_no' => 'Mobile No',
            'country' => 'Country',
            'religion' => 'Religion',
            'type' => 'Type',
            'refered_name' => 'Referred Name',
            'ucil_from' => 'Ucil From',
            'ucil_to' => 'Ucil To',
            'paytype' => 'Paytype',
            'bed_no' => 'Bed No',
            'room_no' => 'Room No',
            'floor_no' => 'Floor No',
            'room_type' => 'Room Type',
            'consultant_dr' => 'Consultant Dr',
            'dr_unit' => 'Dr Unit',
            'speciality' => 'Speciality',
            'co_consultant' => 'Co Consultant',
            'diagnosis' => 'Diagnosis',
            'remarks' => 'Remarks',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'userrole' => 'Userrole',
            'ipaddress' => 'Ipaddress',
        ];
    }


    public function patientdetails($id){
         $html ="";
    //echo $id;die;
    $session=Yii::$app->session;
    require ('../../vendor/tcpdf/tcpdf.php');
    
    $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf->setData($yop);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Istrides Technologies');

$pdf->SetSubject('DMC Pharmacy');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(true);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setFontSubsetting(true);

$pdf->SetFont('times', '', 10, '', true);
$pdf->SetTitle("Patient Info Report");  
$pdf->AddPage();


$html .= '<style>
.Defu{
    border: 1px solid black
}
.Defu_right{
    border-right: 1px solid black;
}
.Defu_left{
    border-left: 1px solid black
}
.Defu_top{
    border-top: 1px solid black
}
.Defu_down{
    border-bottom: 1px solid black
}
.Emp{
    border:none;
}
 
</style>';

 
$values=InRegistration::find()->where(['mr_no'=>$id])->one();
   // echo "<pre>"; print_r($values); die;
    $mr_no = $values ->mr_no; 
    $bed_no = $values ->bed_no; 
    $address = $values ->address.', '.$values ->city.', <br />'.$values ->district.', '.$values ->state.', <br />'.$values ->pincode; 
    $patient_name = $values ->patient_name;
    $relative_name = $values ->relative_name; 
    //$address1 = $values ->address2; 
    $city = $values ->city;
    $pin = $values ->pincode;
   // $email = $values ->email;
    $mobile = $values ->mobile_no;
    $phone_no = $values ->phone_no;
    // echo $address; die;
 
 //   $address1_1=wordwrap($address1,40,"<br>\n");

 

$html .='<br><br><table cellpadding="3" class="">


    <thead><tr>
    <th  align="right" class=""><b>MR.No:</b></th><th  align="left" style="text-align: justify;">'.$mr_no.'</th>
     
    <th  align="right" class=""><b>Name:</b></th><th  align="left" style="text-align: justify;">'.$patient_name.'</th>
    </tr> <br />
    <tr>
    <th  align="right" class=""><b>Phone No 1:</b></th><th  align="left" style="text-align: justify;">'.$mobile.'</th>
      
    <th  align="right" class=""><b>Relative Name:</b></th><th  align="left" style="text-align: justify;">'.$relative_name.'</th>
    </tr> 
    <tr>
    <th  align="right" class=""><b>Phone No 2:</b></th><th  align="left" style="text-align: justify;">'.$phone_no.'</th>
    
  
    <th  align="right" class=""><b>Address:</b></th><th  align="left" style="text-align: justify;">'.$address.'</th>

    </tr> 
    <tr>
    <th  align="right" class=""></th><th  align="left" style="text-align: justify;"></th>
     
    <th  align="right" class=""><b>Current Bed No:</b></th><th  align="left" style="text-align: justify;">'.$bed_no.'</th>

    </tr> 

   
    </thead><tbody></tbody>
</table>
    ';

 
 
$html .='<br><br><br><table cellpadding="3" class="">
<thead><tr>
  <th width="10%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>IP No</b></th>
  <th width="15%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>REG DATE</b></th> 
  <th width="15%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>DISCHARGE DATE</b></th>
  <th width="25%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>SURGERY</b></th> 
  <th width="25%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>DOCTOR</b></th>
  <th width="10%" align="center" class="Defu_top Defu_down" style="font-size:11px;"><b>LAST BED NO</b></th>
</tr>
</thead><tbody>';


$html .='</tbody></table>';

$pdf->writeHTML($html, true, false, false, false, '');


$filename= 'PATIENT_PRINT_'.date("d-m-Y_H-i-s").'.pdf'; 

 

$pdf->Output($filename, 'I');


    }
}
