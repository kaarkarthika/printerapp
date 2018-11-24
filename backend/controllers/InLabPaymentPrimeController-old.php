<?php

namespace backend\controllers;

use Yii;
use backend\models\InLabPaymentPrimeCancel;
use backend\models\InLabPaymentPrimeCancelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\LabPayment;
use backend\models\LabPaymentSearch;
use backend\models\InLabPayment;
use backend\models\InLabPaymentSearch;
use yii\helpers\ArrayHelper;
use backend\models\Testgroup;
use backend\models\LabTesting; 
use backend\models\TaxgroupingLog; 
use backend\models\NewPatient; 
use backend\models\SubVisit; 
use backend\models\Physicianmaster;
use backend\models\Insurance; 
use backend\models\LabTestgroup; 
use backend\models\LabUnit;
use backend\models\LabReferenceVal; 
use backend\models\LabReport;
use backend\models\LabCategory;
use backend\models\LabSubcategory;
use backend\models\LabMulChoice;
use backend\models\MainTestgroup;
use backend\models\LabAddgroup;
use app\models\UploadForm;
use yii\web\UploadedFile;
use backend\models\BranchAdmin;
use backend\models\LabPaymentPrimeCancel;
use backend\models\InLabPaymentPrime;
use backend\models\InLabPaymentPrimeSearch;
use backend\models\AutoidTable;
use backend\models\OpMoneyreceipt;
use backend\models\InRegistration;
use backend\models\Patienttype;
use backend\models\IpMoneyreceiptsLog;
use backend\models\AuthorityMaster;
/**
 * InLabPaymentPrimeController implements the CRUD actions for InLabPaymentPrime model.
 */
 
class InLabPaymentPrimeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LabPaymentPrime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InLabPaymentPrimeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    
    public function actionLabIndexGrid()
    {
       $searchModel = new InLabPaymentPrimeSearch();
       $dataProvider = $searchModel->searchlabtest(Yii::$app->request->queryParams);
     //  echo"<pre>";print_r($dataProvider); die;
        return $this->render('labtestpending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDownload()
    {
        $id=$_GET['id'];
         $model = InLabPaymentPrime::find()->where(['lab_id'=>$id])->one();
         $name=$model->file_path;
         $upload_path= "uploads/".$name;
         ini_set('max_execution_time', 5*60);
        return Yii::$app->response->sendFile($upload_path);             
       
       //die;
    }
    public function actionLaboutsourcegrid()
    {
       $searchModel = new LabPaymentPrimeSearch();
       $dataProvider = $searchModel->searchlabtest_out(Yii::$app->request->queryParams);
        return $this->render('outsourcetest', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReportIndexGrid()
    {
    
       $searchModel = new InLabPaymentPrimeSearch();
        $dataProvider = $searchModel->searchreportlabtest(Yii::$app->request->queryParams);

        return $this->render('reportgeneration', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReport($id)
    {
        $model = $this->findModel($id);
        $labmodel= new InLabPaymentPrime();
        $newpatient=Newpatient::find()->where(['mr_no'=>$model->mr_number])->asArray()->one();
        $sub_visit=SubVisit::find()->where(['mr_number'=>$model->mr_number])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
        $physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
        $insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
        $lab_payment=InLabPayment::find()->where(['lab_prime_id'=>$model->lab_id])->asArray()->all();
        
        $age=$this->Getage($newpatient['dob']);
        
        $set_id=array();
        if(!empty($lab_payment))
        {
            foreach ($lab_payment as $key => $value) 
            {
                if($value['lab_testgroup'] != '' )
                {
                    $hide='show';
                    $set_id[]=$value['lab_testgroup'];
                }
            }
            $set_id_val=implode(',', $set_id);
        }
        $id=$model->lab_id;
        $setid=$set_id_val;
        if($id != '' && $setid != '')
        {   $set=explode(',', $setid);
            $lab_payment1=InLabPayment::find()->where(['lab_prime_id'=>$id])->andWhere(['in','lab_testgroup',$set])->asArray()->all();
        }
        
        
        
        if($_POST)
        {
            //   echo"<pre>"; print_r($_POST); die;
          if("Save"==$_POST['Save_Group']){
                
            $command = Yii::$app->db->createCommand("UPDATE in_lab_payment_prime SET status='report' WHERE lab_id=".$id);
            $command->execute();
            
            if($_POST['Save_Group']== 'Save')
            {
                $data=array();
                $date_id=date('Y-m-d H:i:s');
                $session = Yii::$app -> session;
                foreach ($_POST['TESTNAME'] as $key => $value) 
                {
                    $data[]=['N',$value,$_POST['LabTesting'][$key],$_POST['TESTNAMEID'][$key],$_POST['LABPAYMENTID'][$key],$_POST['LabTestgroup'][$key],$_POST['mastergroupid'][$key],
                            $_POST['MRNUMBER'][$key],$_POST['RESULT'][$key],$_POST['UNITNAME'][$key],$_POST['REFERENCENAME'][$key],$_POST['TextArea'],'T',$date_id,$session['user_id'],$_SERVER['REMOTE_ADDR']
                    ];
                }
        //echo"<pre>"; print_r($data); die;
                $status_count=Yii::$app->db->createCommand()->batchInsert('lab_report', ['status','testname', 'lab_testing','testname_id','lab_payment_id','lab_test_group','mastergroupid','mr_number','result','unit_name','reference_name','textarea','grouping_status','created_at','user_id','updated_ipaddress'],$data)->execute();
                Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
                return $this->redirect(['lab-index-grid']);
            
            }
            }else if("Update"==$_POST['Save_Group']){
                  
                 $res=$_POST['TESTNAMEID'][0];
                    $data=array();
                $date_id=date('Y-m-d H:i:s');
                $session = Yii::$app -> session;
                foreach ($_POST['TESTNAME'] as $key => $value) 
                {
                    $data[]=['N',$value,$_POST['LabTesting'][$key],$_POST['TESTNAMEID'][$key],$_POST['LABPAYMENTID'][$key],$_POST['LabTestgroup'][$key],$_POST['mastergroupid'][$key],
                            $_POST['MRNUMBER'][$key],$_POST['RESULT'][$key],$_POST['UNITNAME'][$key],$_POST['REFERENCENAME'][$key],$_POST['TextArea'],'T',$date_id,$session['user_id'],$_SERVER['REMOTE_ADDR']
                    ];
                }
            
                    $del_count=Yii::$app->db->createCommand()->delete('lab_report', ['testname_id'=>$res])->execute();       // ss code
                    $status_count=Yii::$app->db->createCommand()->batchInsert('lab_report', ['status','testname', 'lab_testing','testname_id','lab_payment_id','lab_test_group','mastergroupid','mr_number','result','unit_name','reference_name','textarea','grouping_status','created_at','user_id','updated_ipaddress'],$data)->execute();
                
                Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
                return $this->redirect(['report-index-grid']);
            }

        } 
        else
        { 
            return $this->render('payment_page', [
            'model' => $model,
            'newpatient' => $newpatient,
            'sub_visit' => $sub_visit,
            'physicianmaster' => $physicianmaster,
            'insurance' => $insurance,
            'age' => $age,
            'lab_payment' => $lab_payment,
            'lab_testgroup'=>$lab_testgroup,
            ]);
        }
    }
    
    
    public function actionGrouppack($id,$setid)
    { 
        if($id != '' && $setid != '')
        {
            $set=explode(',', $setid);
            $lab_payment=INLabPayment::find()->where(['lab_prime_id'=>$id])->andWhere(['in','lab_testgroup',$set])->asArray()->all();
            if(!empty($lab_payment))
            {
                $result_string='';
                
                foreach ($lab_payment as $key => $value) 
                {
                    $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$value['lab_testgroup']])->asArray()->all();
                    if(!empty($lab_testgroup))
                    {
                        foreach ($lab_testgroup as $key1 => $value1) 
                        {
                            $lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->asArray()->one();
                            $lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
                            $lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
                            $result_string.='<table class="table table-bordered algincss"><thead><tr><th>Test Name</th><th>Result</th><th>Units</th><th>Method</th><th>Normal Values</th><th>Description</th></tr></thead>';
                            $result_string.='<tbody>';
                            $result_string.='<tr>';
                            $result_string.='<td>'.$lab_testing['test_name'].'<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
                                <input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
                            <input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
                            <input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
                            <input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
                            <input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
                        
                            
                            <input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'>
                            
                            </td>';
                            $result_string.='<td><input type="text" class="form-control" name="RESULT[]" required></td>';
                            $result_string.='<td>'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
                            $result_string.='<td></td>';
                            $result_string.='<td>'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';
                            $result_string.='<td></td>';
                            $result_string.='</tr></tbody></table>';
                        }
                        
                        
                    }
                    
                }

                    
            }
            
            $result_string.='<div class="row"><div class="col-sm-6"><textarea rows="4" cols="50" name="TextArea"></textarea></div>';
            $result_string.='<div class="col-sm-6"><input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 60px;" value="Save Grouping"></div></div>';
            echo $result_string;
        }
    }
    
    
    /**
     * Displays a single LabPaymentPrime model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    { 
        $labpayment_list=InLabPayment::find()->where(['lab_prime_id'=>$id])->asArray()->all();
        //echo"<pre>";print_r($labpayment_list); die;
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'labpayment_list'=>$labpayment_list,
        ]);
    }
    
     public function actionSamplecollect($id)
    {
        return $this->renderAjax('sampletesttake', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionReportsave(){
        
              if ($_FILES["file_upload"]["error"] == UPLOAD_ERR_OK)
                 {
                      $tmp_name =$_FILES["file_upload"]["tmp_name"];
                      $file_name = $_FILES["file_upload"]["name"];
                      $uploads_dir = '/backend/web/uploads/'.$file_name;
                      move_uploaded_file($_FILES['file_upload']['tmp_name'], 'uploads/'.$file_name);
                 }
        
            $originalDate = $_POST['date_sample'];
            $newDate = date("Y-m-d H:i ", strtotime($originalDate));
        //echo"<pre>";  print_r($_POST); die;       
            $command = Yii::$app->db->createCommand("UPDATE in_lab_payment_prime SET report_received_date='".$newDate."',remarks_report='".$_POST['remarks']."',file_path='".$_FILES["file_upload"]["name"]."'  WHERE lab_id=".$_POST['autoid']);
    
            $command->execute();
             
            return $this->redirect('index.php?r=in-lab-payment-prime/laboutsourcegrid',302);
            
    }
     public function actionReportreceived($id)
    {
        $model = $this->findModel($id);
        $lab_payment_prime_val=InLabPaymentPrime::find()->where(['lab_id'=>$id])->asArray()->one();
        return $this->renderAjax('reportreceived', [
                'model' => $this->findModel($id),
                'lab_payment_prime_val'=>$lab_payment_prime_val,
        ]);
        
    }
     public function actionSamplereceived($id)
    { 
        if(!empty($_POST)){
            $originalDate = $_POST['sample'];
            $newDate = date("Y-m-d H:i ", strtotime($originalDate));
            $command = Yii::$app->db->createCommand("UPDATE in_lab_payment_prime SET outsourcetest='1',status='report_received',sample_received_date='".$newDate."',remarks_outsource='".$_POST['remark']."'  WHERE lab_id=".$id);
            $command->execute();
            return true;
        }else{
            return $this->renderAjax('samplereceived', [
            'model' => $this->findModel($id),
            ]); 
        }
        
    }
    
    public function actionTestsave($id)
    {
        $originalDate = $_POST['sample'];
        $newDate = date("Y-m-d H:i ", strtotime($originalDate));
        $command = Yii::$app->db->createCommand("UPDATE in_lab_payment_prime SET sample_test='1',outsourcetest='".$_POST['outsourcetest']."',sample_date='".$newDate."',remarks='".$_POST['remark']."'  WHERE lab_id=".$id);
        $command->execute();
    }
    public function actionViewlab($id)
    {    
        $lab_payment_prime=InLabPaymentPrime::find()->where(['lab_id'=>$id])->asArray()->one();
        $result_string='';
        $inc =1;
    
        if(!empty($lab_payment_prime))
        {   
        
            $model = $this->findModel($id);
            $labmodel= new InLabPaymentPrime();
            $sub_visit=SubVisit::find()->where(['mr_number'=>$model->mr_number])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
            $physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
            $insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
            $lab_payment=InLabPayment::find()->where(['lab_prime_id'=>$model->lab_id])->asArray()->all();
            
            $new_patient=Newpatient::find()->where(['mr_no'=>$lab_payment_prime['mr_number']])->asArray()->one();
            $test_list_det=ArrayHelper::map(InLabPayment::find()->where(['lab_prime_id'=>$id])->asArray()->all(), 'autoid', 'lab_testing');
            $result = ArrayHelper::index($test_list_det, 'lab_testing');
            $age=$this->Getage($new_patient['dob']);    
            
         $val=""; 
            if(!empty($new_patient))
            { 
                $result_string.='<h4 style="background: #ffacac;padding: 7px 15px;margin: 0; color: #fff;">Patient Details</h4>';
                if($new_patient['insurance'] !=""){  $val=$new_patient['insurance']; }else{ $val="NIL";  }
                $result_string.='<table class="table table-bordered">';
                $result_string.='<thead><tr><th>MR Number</th><th>Name</th><th>Age</th><th>Gender</th><th>Mobile No</th><th>Last Consultant Doctor</th><th>Insurance</th></tr></thead>';
                $result_string.='<tbody><tr><td>'.$new_patient['mr_no'].'</td><td>'.$new_patient['patientname'].'</td><td>'.$age.' Year(s) </td><td>'.$new_patient['pat_sex'].'</td><td>'.$new_patient['pat_mobileno'].'</td><td>'.$lab_payment_prime['physican_name'].'</td><td>'. $val .'</td></tr></body></table>';
            }
              if(!empty($lab_payment)){
                 
                $result_string.='<h4 style="margin-top: 4%;background: #ffacac;color: #fff;text-align: left;padding: 7px 15px;margin-bottom: 1px;"> Testing List</h4>';
                $result_string.='<table class="table table-bordered">';
                $result_string.='<thead><tr><th>S.No</th><th>Name</th><th style="text-align:center">Amount</th></tr></thead>';
                $result_string.='<tbody>';
                
                foreach ($lab_payment as $key => $value) 
                {  
                   $split_group=explode('_', $value['lab_common_id']);
                   if($split_group[0]=="MasterGroup"){
                        $mastergroup=MainTestgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all();
                        if(!empty($mastergroup))
                        {
                                foreach ($mastergroup as $key => $value) {
                                    $result_string.='<tr><td>'.$inc++.'</td><td><p style="width: 90%;float: left;">'.$value['testgroupname'].'</p> <p class="view_right">MG</p></td><td style="text-align:right">'.$value['price'].'</td></tr>';
                                    $totalamount+=$value['price'];  
                                }
                            }
                         }

                    if($split_group[0]=="TestGroup"){
                        $testgroup=Testgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all();
                        if(!empty($testgroup))
                        {   
                                foreach ($testgroup as $key => $value) {
                                    $result_string.='<tr><td>'.$inc++.'</td><td><p style="width: 90%;float: left;">'.$value['testgroupname'].'</p> <p class="view_right">G</p></td> <td style="text-align:right">'.$value['price'].'</td></tr>';
                                    $totalamount+=$value['price'];  
                                }
                            }
                        }
 
                    if($split_group[0]=="LabTesting")
                    { 
                      $labtesting=LabTesting::find()->where(['autoid'=>$value['lab_testing']])->asArray()->all();
                        
                        if(!empty($labtesting))
                        {  
                            foreach ($labtesting as $key => $value) { 
                               $unit_det=LabUnit::find()->where(['auto_id'=>$value['unit_id']])->asArray()->all();
                               $totalamount+=$value['price'];
                              $result_string.='<tr><td>'.$inc++.'</td><td><p style="width: 90%;float: left;">'.$value['test_name'].'</p> <p class="view_right">T</p></td> <td style="text-align:right">'.$value['price'].'</td></tr>';                      
                            }
                          }
                       }
                    }
                   } 
                                
                $result_string.='<tr><td></td><td style="    color: green;text-align:center"><b>Total</b></td> <td style="    color: green;text-align:right"><b>'.$totalamount.'</b></td></tr>'; 
                $result_string.='</body></table>';
            
        }
        
        
         echo $result_string;
    }
    
    
    
    /**
     * Creates a new LabPaymentPrime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionAjaxipnumber()
    {
        
        if(!empty($_POST['query']))
        {
            $Newpatient=InRegistration::find()->select(['*'])->andWhere(['LIKE','ip_no',$_POST['query']])->asArray()->all();
            
            //echo"<pre>";print_r($Newpatient); die;
           
            if(!empty($Newpatient))
            {
                $fetch_array=array();
                foreach ($Newpatient as $key => $value) 
                {
                    $fetch_array[]=array('mr_no'=>$value['mr_no'],'ip_no'=>$value['ip_no'],'patient_type'=>$value['patient_type'],'registered'=>$value['registered'],
                                         'panel_type'=>$value['panel_type'],'name_initial'=>$value['name_initial'],'patient_name'=>$value['patient_name'],'dob' =>$value['dob'],
                                        'sex'=>$value['sex'],'marital_status' => $value['marital_status'],'relation_suffix'=>$value['relation_suffix'],'relative_name'=>$value['relative_name'],
                                        'address'=>$value['address'],'city'=>$value['city'],'district'=>$value['district'],'state'=>$value['state'],'pincode'=>$value['pincode'],
                                        'phone_no'=>$value['phone_no'],'mobile_no'=>$value['mobile_no'],'religion'=>$value['religion'],'type'=>$value['type'],'refered_name'=>$value['refered_name'],
                                        'ucil_from'=>$value['ucil_from'],'ucil_to'=>$value['ucil_to'],'paytype'=>$value['paytype'],'bed_no'=>$value['bed_no'],'room_no'=>$value['room_no'],
                                        'floor_no'=>$value['floor_no'],'room_type'=>$value['room_type'],'consultant_dr'=>$value['consultant_dr'],'dr_unit'=>$value['dr_unit'],
                                        'speciality'=>$value['speciality'],'co_consultant'=>$value['co_consultant'],'diagnosis'=>$value['diagnosis'],'remarks'=>$value['remarks'],
                                        'country'=>$value['country']);
                                        
                }
                return json_encode($fetch_array);
            }
        }
    }
   
    public function actionCreate()
    {
        $model = new InLabPayment();
        $main = new  InLabPaymentPrime();
        $labtesting=ArrayHelper::map(LabTesting::find()->where(['isactive'=>'1'])->all(), 'autoid', 'test_name');
        $testgroup=ArrayHelper::map(Testgroup::find()->where(['isactive'=>'1'])->all(),'autoid','testgroupname');
        $mastergroup=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>'1'])->all(),'autoid','testgroupname');
        $session = Yii::$app->session;
        
        $op_money_receipt=new OpMoneyreceipt();

        $authority_master=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname');
        
        if ($main->load(Yii::$app->request->post())) 
        {
            // echo "<pre>"; print_r($_POST); die;
            $subvisit=SubVisit::find()->where(['mr_number'=>Yii::$app->request->post('InLabPaymentPrime')['mr_number']])->orderBy(['sub_id' => SORT_DESC])->asArray()->one();
            $patientdata=InRegistration::find()->where(['ip_no'=>$_POST['InLabPaymentPrime']['ip_no']])->asArray()->one();
            
            //Auto ID Table
            $auto_get=AutoidTable::find()->where(['auto'=>10])->asArray()->one();

            $autoget=$auto_get['start_num'];
            $inc_value=$autoget+1;
            $rtno = str_pad($autoget, 6, "0", STR_PAD_LEFT);
               
          
            if($patientdata['patient_name'] == Yii::$app->request->post('InLabPaymentPrime')['name'])
            {
                $cgst_percent=Yii::$app->request->post('InLabPayment')['cgst_percentage'];
                $sgst_percent=Yii::$app->request->post('InLabPayment')['sgst_percentage'];
                $cst_per=array_sum($cgst_percent);
                $sgst_per=array_sum($sgst_percent);
                $main->mr_number=Yii::$app->request->post('InLabPaymentPrime')['mr_number'];
                $main->ip_no=Yii::$app->request->post('InLabPaymentPrime')['ip_no'];
                $main->mr_id=$subvisit['pat_id'];
                $main->sub_id=$subvisit['sub_id'];

                $main->subvisit_num=$subvisit['sub_visit'];
                $main->name=$patientdata['patient_name'];
                $main->ph_number=$patientdata['phone_no'];
                $main->physican_name=$subvisit['consultant_dr'];
                $main->insurance=$subvisit['insurance_type'];
                $main->dob=$patientdata['dob'];
                $main->bill_number =$rtno;
                $main->overall_item=Yii::$app->request->post('InLabPaymentPrime')['overall_item'];
                $main->overall_gst_per=$cst_per+$sgst_per;
                $main->overall_cgst_per=$cst_per;
                $main->overall_sgst_per=$sgst_per;
                $main->overall_gst_amt=Yii::$app->request->post('InLabPaymentPrime')['overall_gst_amt'];
                $main->overall_cgst_amt=Yii::$app->request->post('InLabPaymentPrime')['overall_gst_amt']/2;
                $main->overall_sgst_amt=Yii::$app->request->post('InLabPaymentPrime')['overall_gst_amt']/2;
                $main->overall_dis_percent =Yii::$app->request->post('InLabPaymentPrime')['overall_dis_percent'];
                $main->overall_dis_amt =Yii::$app->request->post('InLabPaymentPrime')['overall_dis_amt'];
                $main->overall_sub_total =Yii::$app->request->post('InLabPaymentPrime')['overall_sub_total'];
                $main->overall_net_amt =Yii::$app->request->post('InLabPaymentPrime')['overall_net_amt'];
                $main->overall_paid_amt =Yii::$app->request->post('InLabPaymentPrime')['overall_paid_amt'];
                if(Yii::$app->request->post('InLabPaymentPrime')['overall_due_amt']==""){
                    $main->overall_due_amt ="0";
                }else{
                    $main->overall_due_amt =Yii::$app->request->post('InLabPaymentPrime')['overall_due_amt'];    
                }
                $main->remarks = Yii::$app->request->post('remarks');
                /*$main->authority = Yii::$app->request->post('authority');*/
                $main->authority = Yii::$app->request->post('InLabPaymentPrime')['authority'];
                $main->created_at =date('Y-m-d H:i:s');
                $main->user_id=$session['user_id'];
                $main->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                
                if($main->save())
                {
                    $op_money_receipt->mr_type = 'R';
                    $op_money_receipt->pat_id = $main->mr_id;
                    $op_money_receipt->mr_number = $main->mr_number;
                    $op_money_receipt->sub_id = $main->sub_id;
                    $op_money_receipt->subvisit_id = $main->subvisit_num;
                    $op_money_receipt->default_amount = $main->overall_net_amt;  //Patient Net Amount This Not Editable and Not Update
                    $op_money_receipt->amount = $main->overall_net_amt;          //Patient Net Amount
                    $op_money_receipt->paid_amount = $main->overall_paid_amt;      //Patient Paid Amount This Not Editable and Not Update
                    $op_money_receipt->request_date = date('Y-m-d H:i:s');
                    $op_money_receipt->paid_by = $main->bill_number;                //Patient Bill Number
                    $op_money_receipt->patient_name = $main->name;
                    $op_money_receipt->total_amt = $main->overall_paid_amt;    //Patient Paid Amount
                    $op_money_receipt->org_disc_amt = $main->overall_due_amt;  //Patient Due Amount
                    $op_money_receipt->amount_words = $this->AmtinWords($main->overall_due_amt);   //Due Amount In Words
                    $op_money_receipt->created_at = date('Y-m-d H:i:s');   
                    $op_money_receipt->user_id = $session['user_id'];   
                    $op_money_receipt->updated_ipaddress = $_SERVER['REMOTE_ADDR'];   
                    
                    if($op_money_receipt->save())
                    {
                        $data=array();
                        if(!empty(Yii::$app->request->post('InLabPayment')['lab_common_id']))
                        {
                            foreach (Yii::$app->request->post('InLabPayment')['lab_common_id'] as $key => $value) 
                            {
                                $split_group=explode('_', $value);
                                
                                $data[]=[$main->lab_id,$split_group[1],$split_group[0],$main->mr_number,$_POST['InLabPayment']['price'][$key],
                                        $_POST['InLabPayment']['cgst_percentage'][$key]+$_POST['InLabPayment']['sgst_percentage'][$key],
                                        $_POST['InLabPayment']['cgst_percentage'][$key],$_POST['InLabPayment']['sgst_percentage'][$key],
                                        $_POST['InLabPayment']['cgst_amount'][$key]+$_POST['InLabPayment']['sgst_amount'][$key],
                                        $_POST['InLabPayment']['cgst_amount'][$key],$_POST['InLabPayment']['sgst_amount'][$key],
                                        $_POST['InLabPayment']['price'][$key],$_POST['InLabPayment']['total_amount'][$key],
                                        $_POST['InLabPayment']['discount_percent'][$key],$_POST['InLabPayment']['discount_amount'][$key],
                                        $session['user_id'],date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']];
                            }
                            Yii::$app->db->createCommand()->batchInsert('in_lab_payment', ['lab_prime_id','lab_common_id', 'lab_test_name','mr_number',
                            'price','gst_percentage','cgst_percentage','sgst_percentage','gst_amount','cgst_amount','sgst_amount',
                            'total_amount','net_amount','discount_percent','discount_amount','user_id','created_at','ip_address'],$data)->execute();
                        }
    
                        $AutoidTable=AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 10]);
                       // echo "<pre>"; print_r($AutoidTable); die;
                        if($AutoidTable == '1')
                        {

                            /**********       LOG SAVE     **************/
                  /*  $money_reciept_log = new IpMoneyreceiptsLog();
                    $money_reciept_log->mr_no = $main->mr_number;
                    $money_reciept_log->ip_no = $in_registration['ip_no'];
                    $money_reciept_log->total_amt = $model->overall_net_amount;
                    $money_reciept_log->action = 'IPProcedure';
                    $money_reciept_log->created_date = date('Y-m-d H:i:s');
                    $money_reciept_log->user_id = $session['user_id'];;
                    $money_reciept_log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $money_reciept_log->save();*/


                            return $rtno;
                        }
                    }
                    else {
                        print_r($op_money_receipt->getErrors());die;    
                    }
                }
                    
                else 
                {
                    print_r($main->getErrors());die;    
                }
            }
            else if($patientdata['patient_name'] != Yii::$app->request->post('InLabPaymentPrime')['name']) 
            {
                return 'N';
            }
        }
        else 
        {
             return $this->render('create', [
                'model' => $main,
                'labtesting' => $labtesting,
                'testgroup'=>$testgroup,
                'mastergroup'=>$mastergroup,
                'main' =>  $model,
                'authority_master' => $authority_master,
            ]);
        }
    }




    public function actionLabreturn($id)
    {
        $id=base64_decode(urldecode($id));
        
        $main =InLabPaymentPrime::find()->where(['lab_id'=>$id])->one();
        $lab_payment= ArrayHelper::toArray($main);
        $lab_payment_array= ArrayHelper::index($lab_payment,'lab_id');
        
        $model =InLabPayment::find()->where(['lab_prime_id'=>$id])->all();
        $lab_toArray= ArrayHelper::toArray($model);
        $lab_index_array= ArrayHelper::index($lab_toArray,'autoid');
        
        $labtesting=ArrayHelper::index(LabTesting::find()->asArray()->all(), 'autoid');
        $testgroup=ArrayHelper::index(Testgroup::find()->asArray()->all(),'autoid');
        $mastergroup=ArrayHelper::index(MainTestgroup::find()->asArray()->all(),'autoid');
        
        $session = Yii::$app->session;
        
        $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
        
        
        $lab_payment_prime_cancel=new InLabPaymentPrimeCancel();
        
        if ($main->load(Yii::$app->request->post())) 
        {
            echo '<pre>';
            //($_POST);die;
            //Table Fetch
            
            if($main['overall_dis_percent'] != '' || $main['overall_dis_percent'] != 0)
             {
                 $previous_overall_dis_percent=$main['overall_dis_percent'];    
             } 
             else 
             {
                  $previous_overall_dis_percent=0;  
             }
             
             if($main['overall_dis_amt'] != '' || $main['overall_dis_amt'] != 0)
             {
                 $previous_overall_dis_amt=$main['overall_dis_amt'];    
             } 
             else 
             {
                  $previous_overall_dis_amt=0;  
             }
            
            
             if($_POST['InLabPaymentPrime']['overall_due_amt'] != '' || $_POST['InLabPaymentPrime']['overall_due_amt'] != 0)
             {
                 $can_due_amount=$_POST['InLabPaymentPrime']['overall_due_amt'];  
             } 
             else 
             {
                  $can_due_amount=0;    
             }
             
             if($_POST['InLabPaymentPrime']['can_overall_dis_percent'] != '' || $_POST['InLabPaymentPrime']['can_overall_dis_percent'] != 0)
             {
                 $can_overall_dis_percent=$_POST['InLabPaymentPrime']['can_overall_dis_percent']; 
             } 
             else 
             {
                  $can_overall_dis_percent=0;   
             }
             
             if($_POST['InLabPaymentPrime']['can_overall_dis_amt'] != '' || $_POST['InLabPaymentPrime']['can_overall_dis_amt'] != 0)
             {
                 $can_overall_dis_amt=$_POST['InLabPaymentPrime']['can_overall_dis_amt']; 
             } 
             else 
             {
                  $can_overall_dis_amt=0;   
             }
             
                  //print_r($main['overall_paid_amt']); die;
          
          $due_amt=$main['overall_due_amt']-$_POST['InLabPaymentPrimeCancel']['can_overall_net_amt'];
          if($due_amt<=0){
                $update_paid_amount=$main['overall_net_amt']-$_POST['InLabPaymentPrimeCancel']['can_overall_net_amt'];
                
            }else{
                $update_paid_amount=$main['overall_paid_amt'];
            }
            //print_r($update_paid_amount);die; 
            
            $lab_payment_prime_cancel->payment_prime_id = $id;
            $lab_payment_prime_cancel->mr_number = $main->mr_number;
            $lab_payment_prime_cancel->mr_id = $main->mr_id;
            $lab_payment_prime_cancel->sub_id = $main->sub_id;
            $lab_payment_prime_cancel->subvisit_number = $main->subvisit_num;
            $lab_payment_prime_cancel->name =  $main->name;
            $lab_payment_prime_cancel-> ph_number = $main->ph_number;
            $lab_payment_prime_cancel-> physican_name = $main->physican_name;
            $lab_payment_prime_cancel-> insurance = $main->insurance;
            $lab_payment_prime_cancel-> dob = $main->dob;
            //$lab_payment_prime_cancel->   bill_number = ;
            $lab_payment_prime_cancel-> overall_item = $_POST['InLabPaymentPrimeCancel']['overall_item'] ;
            $lab_payment_prime_cancel-> rate = $_POST['InLabPaymentPrimeCancel']['rate'];
            $lab_payment_prime_cancel-> can_overall_gst_per = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_per'];
            $lab_payment_prime_cancel-> can_overall_cgst_per = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_per']/2;
            $lab_payment_prime_cancel-> can_overall_sgst_per = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_per']/2;
            $lab_payment_prime_cancel-> can_overall_gst_amt = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt'];
            $lab_payment_prime_cancel-> can_overall_cgst_amt = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt']/2;
            $lab_payment_prime_cancel-> can_overall_sgst_amt = $_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt']/2;
            $lab_payment_prime_cancel-> can_overall_dis_percent = $can_overall_dis_percent;
            $lab_payment_prime_cancel-> can_overall_dis_amt = $can_overall_dis_amt;
            $lab_payment_prime_cancel-> can_overall_sub_total = $_POST['InLabPaymentPrimeCancel']['rate'];
            $lab_payment_prime_cancel-> can_overall_net_amt = $_POST['InLabPaymentPrimeCancel']['can_overall_net_amt'];
            $lab_payment_prime_cancel-> can_overall_due_amt = $can_due_amount;
            $lab_payment_prime_cancel-> remarks = $_POST['InLabPaymentPrimeCancel']['remarks'];
            $lab_payment_prime_cancel-> authority = $_POST['InLabPaymentPrimeCancel']['authority'];
            $lab_payment_prime_cancel-> created_at = date('Y-m-d H:i:s');
            $lab_payment_prime_cancel-> user_id = $session['user_id'];
            $lab_payment_prime_cancel-> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
            
            
            
            if($lab_payment_prime_cancel->save())
            {
                if(!empty($_POST['InLabPayment']['primeid']))
                    {
                        $data=array();
                        $date_id=date('Y-m-d H:i:s');
                        
                        foreach ($_POST['LabPayment']['primeid'] as $key => $value) 
                        {
                            $data[]=[$value,$lab_payment_prime_cancel->mr_number,
                            $_POST['InLabPayment']['lab_common_id'][$key],
                            $_POST['InLabPayment']['lab_test_name'][$key],
                            $_POST['InLabPayment']['price'][$key],
                            $_POST['InLabPayment']['cgst_percentage'][$key]+$_POST['InLabPayment']['sgst_percentage'][$key],
                            $_POST['InLabPayment']['cgst_percentage'][$key],
                            $_POST['InLabPayment']['sgst_percentage'][$key],
                            $_POST['InLabPayment']['cgst_amount'][$key]+$_POST['InLabPayment']['sgst_amount'][$key],
                            $_POST['InLabPayment']['cgst_amount'][$key],
                            $_POST['InLabPayment']['sgst_amount'][$key],
                            $_POST['InLabPayment']['total_amount'][$key],
                            $_POST['InLabPayment']['discount_percent'][$key],
                            $_POST['InLabPayment']['discount_amount'][$key],
                            $_POST['InLabPayment']['total_amount'][$key],
                            $session['user_id'],
                            $date_id,
                            $_SERVER['REMOTE_ADDR']];
                            
                            LabPayment::updateAll([
                            'gst_percentage' =>$lab_index_array[$value]['gst_percentage'] -($_POST['InLabPayment']['cgst_percentage'][$key]+$_POST['InLabPayment']['sgst_percentage'][$key]),
                            'cgst_percentage' =>$lab_index_array[$value]['cgst_percentage']-$_POST['InLabPayment']['cgst_percentage'][$key],
                            'sgst_percentage' =>$lab_index_array[$value]['sgst_percentage']-$_POST['InLabPayment']['sgst_percentage'][$key],
                            'gst_amount' =>$lab_index_array[$value]['gst_amount']-($_POST['InLabPayment']['cgst_amount'][$key]+$_POST['InLabPayment']['sgst_amount'][$key]),
                            'cgst_amount' =>$lab_index_array[$value]['cgst_amount']-$_POST['InLabPayment']['cgst_amount'][$key],
                            'sgst_amount' =>$lab_index_array[$value]['sgst_amount']-$_POST['InLabPayment']['sgst_amount'][$key],
                            'total_amount' =>$lab_index_array[$value]['total_amount']-$_POST['InLabPayment']['total_amount'][$key],
                            'discount_percent' =>$lab_index_array[$value]['discount_percent']-$_POST['InLabPayment']['discount_percent'][$key],
                            'discount_amount' =>$lab_index_array[$value]['discount_amount']-$_POST['InLabPayment']['discount_amount'][$key],
                            'net_amount' =>$lab_index_array[$value]['net_amount']-$_POST['InLabPayment']['total_amount'][$key]],
                            ['autoid' => $value]);
                        }

                        Yii::$app->db->createCommand()->batchInsert('in_lab_payment_cancel', ['can_lab_prime_id',
                        'mr_number', 'lab_common_id','lab_test_name','price','gst_percentage',
                        'cgst_percentage','sgst_percentage','gst_amount','cgst_amount','sgst_amount','total_amount',
                        'discount_percent','discount_amount','net_amount','user_id','created_at','ip_address'],$data)->execute();
                        
                        
                    LabPaymentPrime::updateAll(['overall_item' =>$main['overall_item']- $_POST['InLabPaymentPrimeCancel']['overall_item'],
                    'overall_gst_per' =>$main['overall_gst_per']- $_POST['InLabPaymentPrimeCancel']['can_overall_gst_per'],
                    'overall_cgst_per' =>$main['overall_cgst_per']- ($_POST['InLabPaymentPrimeCancel']['can_overall_gst_per']/2),
                    'overall_sgst_per' =>$main['overall_sgst_per']- ($_POST['InLabPaymentPrimeCancel']['can_overall_gst_per']/2),
                    'overall_gst_amt' =>$main['overall_gst_amt']- $_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt'],
                    'overall_cgst_amt' =>$main['overall_cgst_amt']- ($_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt']/2),
                    'overall_sgst_amt' =>$main['overall_sgst_amt']- ($_POST['InLabPaymentPrimeCancel']['can_overall_gst_amt']/2),
                    'overall_dis_percent' =>$previous_overall_dis_percent- $can_overall_dis_percent,
                    'overall_dis_amt' =>$previous_overall_dis_amt- $can_overall_dis_amt,
                    'overall_sub_total' =>$main['overall_sub_total']- $_POST['InLabPaymentPrimeCancel']['rate'],
                    'overall_paid_amt'=>$update_paid_amount,
                    'overall_due_amt'=>$_POST['ProcedureCancelation']['balance_amt'],
                    'overall_net_amt' =>$main['overall_net_amt']- $_POST['InLabPaymentPrimeCancel']['can_overall_net_amt']],
                    ['lab_id' => $id]);
                    }
            }
            else
            {
                echo '<pre>';
                print_r($lab_payment_prime_cancel);die;
            }
        }
        else 
        {
            return $this->render('labreturn', [
                'model' => $model,
                'labtesting' => $labtesting,
                'testgroup'=>$testgroup,
                'mastergroup'=>$mastergroup,
                'main' =>  $main,
                'insurancelist' => $insurancelist,
                'lab_index_array' => $lab_index_array,
                'lab_payment_prime_cancel' => $lab_payment_prime_cancel,
                'lab_payment_array' => $lab_payment_array,
            ]);
        }
        
    }


    /**
     * Updates an existing LabPaymentPrime model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lab_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    
    public function actionLabset($id)
    {    
       if($id != '')
       {
            $split_group=explode('_', $id);
            $result_string='';
            
            if($split_group[0] == 'LabTesting')
            {
                $lab_testing=LabTesting::find()->where(['autoid'=>$split_group[1]])->asArray()->one();
                $hsn_code=$lab_testing['hsncode'];
                $tax_grouping_log=TaxgroupingLog::find()->where(['taxgroupid'=>$hsn_code])->andWhere(['is_active'=>1])->one();
                $percentage=$tax_grouping_log['tax'];
                
                $gstpercent_divided=$percentage/2;
                
                $calculation=($lab_testing['price']*$percentage)/100;
                
                if(!empty($lab_testing))
                {
                    $result_string.='<tr class="calculation" id="lab_test'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">';
                    $result_string.='<td style="text-align:center;width:15.6%;" id="lab_name'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.$lab_testing['test_name'].'<input type="hidden" name="InLabPayment[lab_common_id][]" value="'.$id.'" ></td>';
                    $result_string.='<td style="text-align:center;width:10.2%;" ><input type="text" readonly="readonly" id="price_test_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[price][]" value="'.number_format($lab_testing['price'],2, '.', '').'" ></td>';
                   
                    //$result_string.='<td  style="text-align:center" id="gst_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($calculation,2, '.', '').'</td>';
                   $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="cgst_per_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[cgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                   $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="sgst_per_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[sgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                   
                   $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text" readonly="readonly" id="cgst_amt_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[cgst_amount][]" value="'.number_format(($lab_testing['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                   $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text" readonly="readonly" id="sgst_amt_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[sgst_amount][]" value="'.number_format(($lab_testing['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                  
                   $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_percent_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[discount_percent][]" value="0" ></td>';
                   $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_amount_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[discount_amount][]" value="0" ></td>';
                  
                  
                   
                    $result_string.='<td  style="text-align:center;" ><input type="text" readonly="readonly" id="net_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[total_amount][]" value="'.number_format($calculation+$lab_testing['price'],2, '.', '').'" ></td>';
                     $result_string.='<td  class="hide" style="text-align:center" ><input type="text" readonly="readonly" id="net_lab_hidden'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'" name="InLabPayment[total_amount_hidden][]" value="'.number_format($calculation+$lab_testing['price'],2, '.', '').'" ></td>';
                    $result_string.='<td  style="text-align:center;width:6.2%;"  id="remove_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'"><button dataid="LabTesting_'.$lab_testing['autoid'].'" class="remove btn btn-danger btn-xs" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>';
                    $result_string.='</tr>';
                }
            
            }
            elseif ($split_group[0] == 'TestGroup') 
            {
                $testgroup=Testgroup::find()->where(['autoid'=>$split_group[1]])->asArray()->one();
                
                $hsn_code=$testgroup['hsncode'];
                $tax_grouping_log=TaxgroupingLog::find()->where(['taxgroupid'=>$hsn_code])->andWhere(['is_active'=>1])->one();
                $percentage=$tax_grouping_log['tax'];
                $gstpercent_divided=$percentage/2;
                
                $calculation=($testgroup['price']*$percentage)/100;
                
                if(!empty($testgroup))
                {
                    $result_string.='<tr class="calculation"  id="test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">';
                    $result_string.='<td style="text-align:center;width:15.6%;" id="test_group_name'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.$testgroup['testgroupname'].'<input type="hidden" value="'.$id.'"  name="InLabPayment[lab_common_id][]"></td>';
                    $result_string.='<td style="text-align:center;width:10.2%;" ><input type="text" readonly="readonly" id="price_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[price][]" value="'.number_format($testgroup['price'],2, '.', '').'" ></td>';
                   
                    //$result_string.='<td style="text-align:center" id="gst_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($calculation,2, '.', '').'</td>';
                     $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="cgst_per_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[cgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                     $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="sgst_per_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[sgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                   
                     $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text" readonly="readonly" id="cgst_amt_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[cgst_amount][]" value="'.number_format(($testgroup['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                     $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text" readonly="readonly" id="sgst_amt_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[sgst_amount][]" value="'.number_format(($testgroup['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                  
                     $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_percent_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[discount_percent][]" value="0" ></td>';
                     $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_amount_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[discount_amount][]" value="0" ></td>';
                  
                  
                     $result_string.='<td style="text-align:center;" ><input type="text" readonly="readonly" id="net_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[total_amount][]" value="'.number_format($calculation+$testgroup['price'],2, '.', '').'" ></td>';
                     $result_string.='<td class="hide" style="text-align:center" ><input type="text" readonly="readonly" id="net_test_group_hidden'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'" name="InLabPayment[total_amount_hidden][]" value="'.number_format($calculation+$testgroup['price'],2, '.', '').'" ></td>';
                    
                     $result_string.='<td style="text-align:center;width:6.2%;" id="remove_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'"><button dataid="TestGroup_'.$testgroup['autoid'].'"  class="remove btn btn-danger btn-xs"  type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>';
                     $result_string.='</tr>';
                }
            
            }elseif ($split_group[0] == 'MasterGroup') 
            {
                
                $mastergroup=MainTestgroup::find()->where(['autoid'=>$split_group[1]])->asArray()->one();
                $hsn_code=$mastergroup['hsncode'];
                $tax_grouping_log=TaxgroupingLog::find()->where(['taxgroupid'=>$hsn_code])->andWhere(['is_active'=>1])->one();
                $percentage=$tax_grouping_log['tax'];
                $gstpercent_divided=$percentage/2;
                
                $calculation=($mastergroup['price']*$percentage)/100;
                
                if(!empty($mastergroup))
                {
                    $result_string.='<tr class="calculation"  id="master_group'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'">';
                    $result_string.='<td style="text-align:center;width:15.6%;" >'.$mastergroup['testgroupname'].'<input type="hidden" readonly="readonly" value="'.$id.'"  name="InLabPayment[lab_common_id][]"></td>';
                    $result_string.='<td style="text-align:center;width:10.2%;" ><input type="text" readonly="readonly" id="price_master_group'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[price][]" value="'.number_format($mastergroup['price'],2, '.', '').'" ></td>';
                   
                    //$result_string.='<td style="text-align:center" id="gst_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($calculation,2, '.', '').'</td>';
                     $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="cgst_per_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[cgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                     $result_string.='<td  style="text-align:center;width:9.8%;" ><input type="text" readonly="readonly" id="sgst_per_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[sgst_percentage][]" value="'.number_format($gstpercent_divided,2, '.', '').'" ></td>';
                   
                     $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text"  readonly="readonly" id="cgst_amt_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[cgst_amount][]" value="'.number_format(($mastergroup['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                     $result_string.='<td  style="text-align:center;width:11.4%;" ><input type="text" readonly="readonly" id="sgst_amt_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[sgst_amount][]" value="'.number_format(($mastergroup['price']*$gstpercent_divided/100),2, '.', '').'" ></td>';
                  
                     $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_percent_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[discount_percent][]" value="0" ></td>';
                     $result_string.='<td  style="text-align:center;width:8.5%;" ><input type="text" readonly="readonly" id="discount_amount_master'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[discount_amount][]" value="0" ></td>';
                  
                  
                     $result_string.='<td style="text-align:center;" ><input type="text" readonly="readonly" id="net_master_group'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[total_amount][]" value="'.number_format($calculation+$mastergroup['price'],2, '.', '').'" ></td>';
                     $result_string.='<td class="hide" style="text-align:center" ><input type="text" readonly="readonly" id="net_test_master_hidden'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'" name="InLabPayment[total_amount_hidden][]" value="'.number_format($calculation+$mastergroup['price'],2, '.', '').'" ></td>';
                     $result_string.='<td style="text-align:center;width:6.2%;" id="remove_master_group'.$mastergroup['autoid'].'" dataid="MasterGroup_'.$mastergroup['autoid'].'"><button dataid="MasterGroup_'.$mastergroup['autoid'].'"  class="remove btn btn-danger btn-xs"  type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>';
                     $result_string.='</tr>';
                }
            
            }
  
            return $result_string;
       
        }   
    }

    /**
     * Deletes an existing LabPaymentPrime model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the LabPaymentPrime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabPaymentPrime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
  
    
    public function actionDesign()
    {
        $searchModel = new LabPaymentPrimeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('design', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
                         
    }

    public function Getage($userDob)
    {
        
        $dob = new \DateTime($userDob);
        $now = new \DateTime();
        $difference = $now->diff($dob);
        $age = $difference->y;
        return $age;
    }
    
    
    public function actionAjaxfetch()
    {
        
        if(!empty($_POST['query']))
        {
            $Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no'])->where(['temporary_blocked'=>'N'])->andWhere(['LIKE','mr_no',$_POST['query']])->asArray()->all();
        
            if(!empty($Newpatient))
            {
                $fetch_array=array();
                foreach ($Newpatient as $key => $value) 
                {
                    $fetch_array[]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname']);
                }
                return json_encode($fetch_array);
            }
        }
    }
     
     public function actionAjaxipnumberselectblockipentries($id)
    {
        
        if(!empty($id))
        {
            $Newpatient=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
            
            if(!empty($Newpatient))
            {
                $physicianmaster=Physicianmaster::find()->where(['id'=>$Newpatient['consultant_dr']])->asArray()->one();
                $physicianmaster1=Physicianmaster::find()->where(['id'=>$Newpatient['co_consultant']])->asArray()->one();

                $patienttype=Patienttype::find()->where(['is_active'=>1])
                    ->andWhere(['type_id'=>$Newpatient['type']])->asArray()->one();

                $response[0] = $Newpatient;
                $response[1] = $physicianmaster;
                $response[2] = $physicianmaster1;
                $response[3] = $patienttype;
                return json_encode($response);
            }
        }
    }
    public function actionAjaxsinglefetch($id)
    {
        
        if(!empty($id))
        {
            $fetch_array=array();
            
            $sub_visit=SubVisit::find()->where(['mr_number'=>$id])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
            
            $Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
            'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_mobileno'=>'pat_mobileno'])
            ->where(['temporary_blocked'=>'N'])->andWhere(['mr_no'=>$id])->asArray()->one();
            
            if(!empty($Newpatient))
            {
                $physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
                $insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
                //echo "<pre>";print_r($sub_visit); die;
                $fetch_array[0] =   $sub_visit;
                $fetch_array[1] =   $Newpatient;
                $fetch_array[2] =   $physicianmaster;
                $fetch_array[3] =   $insurance;
            //  print_r($fetch_array);die;
                return json_encode($fetch_array);
            }
        }
    }
    
    public function actionBillreport($id)
    {
    
        $labpayment_list=InLabPayment::find()->where(['lab_prime_id'=>$id])->asArray()->all();
        $labprime_list=InLabPaymentPrime::find()->where(['lab_id'=>$id])->asArray()->one();
        $branch_det=BranchAdmin::find()->where(['ba_autoid'=>$labprime_list['user_id']])->asArray()->one();
        //echo"<pre>";print_r($branch_det['authUserRole']); die;
        
        require ('../../vendor/tcpdf/tcpdf.php');
                $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('DMC');
                $pdf->SetTitle('Invoice');
                $pdf->SetSubject('TCPDF Tutorial');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf->setFontSubsetting(true);
                $pdf->SetFont('helvetica', '', 8, '', true);
                $pdf->SetMargins(10, false, 10, true); // set the margins 
                $pdf->AddPage();
                $tbl1='<html>
                <head>
                </head>
                </head>
                <body>  <div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
                $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
                $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
                // $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
                // $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
                $tbl1.='<p style="border-top:1px solid #000;"></p>';
                $tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;line-height:2px;"><u> INVESTIGATION REQUISITION - CUM -RECEIPT </u></p>';
                
                $tbl1.='<table cellpadding="4" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
                <tr> <td style="width:15%;"> Requisition No </td><td style="width:35%;">: '.$labprime_list['mr_number'].'</td>
                    <td style="width:15%;"> Bill Number </td><td style="width:35%;">:</td> </tr>
                <tr><td style="width:15%;"> Patient Name </td><td style="width:35%;">: '.$labprime_list['name'].'</td>
                    <td style="width:15%;"> Bill Date & Time</td> <td style="width:35%;">: </td> </tr>
                <tr><td style="width:15%;"> Age  </td><td style="width:35%;">: '.$this->Getage(date('Y-m-d',strtotime($labprime_list['dob']))).' Year(s) </td>
                    <td style="width:15%;"> MR Number</td> <td style="width:35%;">:  '.$labprime_list['mr_number'].' </td> </tr>
                <tr><td style="width:15%;"> Contact Number </td><td style="width:35%;">: '.$labprime_list['ph_number'].' </td>
                    <td style="width:15%;"> Org Name</td> <td style="width:35%;">: </td> </tr>
                </table>';
                
                $tbl1.='<table cellpadding="3" style="padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="Center" border=1 >
                    <thead ><tr ><td style="width:15%;border-bottom:1px solid #000;text-align:left;"><B>S.NO</B></td>
                             <td style="width:70%;border-bottom:1px solid #000;text-align:left;"><B>Investications</B></td>
                             <td style="width:15%;border-bottom:1px solid #000;"><B>Amount</B></td> </tr></thead >
                <tbody>'; 
                if(!empty($labpayment_list)){  $i=1; 
                    foreach($labpayment_list as $val){
                        $labtest_list=LabTesting::find()->where(['isactive'=>1])->andWhere(['autoid'=>$val['lab_common_id']])->asArray()->one();
                $tbl1.='<tr><td style="width:15%;text-align:left;">'. $i++.'</td>
                    <td style="width:70%;text-align:left;">'.$labtest_list['test_name'].'</td>
                    <td style="width:15%;">'. $val['net_amount'] .'</td>
                    </tr>';
                }
                $tbl1.='<tr>
                    <td style="width:70%;border-top:1px solid #000;text-align:left;"></td>
                    <td style="width:15%;border-top:1px solid #000;text-align:left;font-weight:bold;">TOTAL</td>
                    <td style="width:15%;border-top:1px solid #000;text-align:right;">  '.$labprime_list['overall_net_amt'] .'</td>
                    </tr><tr>
                    <td style="width:70%;text-align:left;"></td>
                    <td style="width:15%;text-align:left;font-weight:bold;">CONCESSIO</td>
                    <td style="width:15%;text-align:right;">  '.$labprime_list['overall_gst_amt'] .'</td>
                    </tr><tr>
                    <td style="width:70%;text-align:left;"></td>
                    <td style="width:15%;text-align:left;font-weight:bold;">PAID</td>
                    <td style="width:15%;text-align:right;">  '.$labprime_list['overall_paid_amt'] .'</td>
                    </tr>
                    <tr>
                    <td style="width:70%;text-align:left;"></td>
                    <td style="width:15%;text-align:left;font-weight:bold;">DUE AMOUNT</td>
                    <td style="width:15%;text-align:right;"> '.$labprime_list['overall_due_amt'] .' </td>
                    </tr>';
                }

                $tbl1.='
                </tbody>
                </table>';
                $tbl1.='<p></p><p></p><table><tr><td style="text-align:left;text-transform: uppercase;font-weight:bold;"> USER '. $branch_det['ba_name'].'</td><td style="text-align:right;text-transform: uppercase;font-weight:bold;">'.$branch_det['authUserRole'].' </td></tr></table>';
                $pdf->writeHTML($tbl1, true, false, false, false, '');
                $pdf->Output('treatment_overall.pdf');        
    
    }
    
    public function actionPrint($id)
    {
    
        $model = $this->findModel($id);
        $labmodel= new InLabPaymentPrime();
        $newpatient=Newpatient::find()->where(['mr_no'=>$model->mr_number])->asArray()->one();
        $sub_visit=SubVisit::find()->where(['mr_number'=>$model->mr_number])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
        $physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
        $insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
        $lab_payment=InLabPayment::find()->where(['lab_prime_id'=>$model->lab_id])->asArray()->all();
        $lab_payment_prime_val=InLabPaymentPrime::find()->where(['lab_id'=>$lab_payment[0]['lab_prime_id']])->asArray()->all();
        $age=$this->Getage($newpatient['dob']);
        
        $set_id=array();
        if(!empty($lab_payment))
        {
            foreach ($lab_payment as $key => $value) 
            {
                if($value['lab_testgroup'] != '' )
                {
                    $hide='show';
                    $set_id[]=$value['lab_testgroup'];
                }
            }
            $set_id_val=implode(',', $set_id);
        }
        $id=$model->lab_id;
        $setid=$set_id_val;
        
        require ('../../vendor/tcpdf/tcpdf.php');
                $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('DMC');
                $pdf->SetTitle('Lab Test');
                $pdf->SetSubject('TCPDF Tutorial');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf->setFontSubsetting(true);
                $pdf->SetFont('helvetica', '', 8, '', true);
                $pdf->SetMargins(10, false, 10, true); // set the margins 
                $pdf->AddPage();
                
                
                if($newpatient['pat_sex']=="Male"){
                    if(0 <= $this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) AND 10 >=$this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) ){
                        $name_titel="Baby"; 
                    }
                    else if(10 <= $this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) AND 18 >=$this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) ){
                        $name_titel="Master";
                    }else{
                        $name_titel="Mr";
                    }   
                }
                else{
                    if(0 <= $this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) AND 5 >=$this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) ){
                        $name_titel="Baby"; 
                    }
                    else if(5 <= $this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) AND 18 >=$this->Getage(date('Y-m-d',strtotime($newpatient['dob']))) ){
                        $name_titel="Mistress ";
                    }else{
                        $name_titel="Miss";
                    }
                }
                $newDate = date("d-m-Y H:i A", strtotime($lab_payment_prime_val[0]['sample_date']));
                $tbl1='';
            //   $tbl1.='<p></p><h2 style="text-align:center;color:RED;">DINESH MEDICAL CENTER</h2><p class="" style="display:none;text-align:center;line-height:2px;font-size:12px;color:green">A Unit Of Carmel HealthCare PVT LTD</p>';
            //   $tbl1.='<p style="text-align:center;line-height:20px;font-size:12px;>D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
            //   $tbl1.='<p style="text-align:center;line-height:20px;font-size:12px;>DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
            //   $tbl1.='<p style="text-align:center;line-height:20px;font-size:12px;>TIN.NO :37141115904</p>';
        //       $tbl1.='<div style="line-height:20px;font-size:12px;"><p >R.No.: 04-02</p><p style="color:green;text-align:right">No.of Beds : 125 </p></div>';
        //       $tbl1.='<p style="border-top:3px solid green;"></p>';
                $tbl1.='<p></p><p></p><p></p><p></p><p></p><p></p><p></p><table style="border:none;padding:2px 10px;font-size:12px;margin-top:250px;" ALIGN="left" ><tr><td style="width:15%;">Registration </td>';
                $tbl1.='<td style="width:35%;"> : </td>';
                $tbl1.='<td style="width:23%;">Registered On </td>';
                $tbl1.='<td style="width:35%;"> : '.date('d-m-Y H:i A').'</td>';
                $tbl1.='</tr>';
                $tbl1.='<tr><td>Patient Name </td>';
                $tbl1.='<td> : '.$name_titel.' '.$newpatient['patientname'].'</td>';
                $tbl1.='<td>Sample collect Dt & Tm</td>';
                $tbl1.='<td> : '.$newDate.'</td>';
                $tbl1.='</tr>';
                $tbl1.='<tr><td>Age/Gender</td>';
                $tbl1.='<td> : '.$this->Getage(date('Y-m-d',strtotime($newpatient['dob']))).' Year(s) / '.$newpatient['pat_sex'].'</td>';
                $tbl1.='<td>Reported On </td>';
                $tbl1.='<td> : '.date('d-m-Y H:i A').' </td>';
                $tbl1.='</tr>';
                $tbl1.='<tr><td>Consultant Dr. </td>';
                $tbl1.='<td> : '.$physicianmaster['physician_name'].'</td>';
                $tbl1.='<td>MR Number </td>';
                $tbl1.='<td> : '.$newpatient['mr_no'].'</td>';
                $tbl1.='</tr></table>';
                $pdf->writeHTML($tbl1, true, false, false, false, '');
                $tbl_res='';
            
            $lab_cat=LabCategory::find()->asArray()->all();
             
            $lab_report_res=LabReport::find()->where(['testname_id'=>$id])->asArray()->all();
            
                $dob=$newpatient['dob'];
            $check=new \DateTime($dob,new \DateTimeZone('UTC'));
            $current_date =new \DateTime('now', new \DateTimeZone('UTC'));
            $interval = $check->diff($current_date);
            //print_r($interval); die;
            $day_val=$interval->days;
            $month_val=$interval->m;
            $year_val=$interval->y;
            
            $tbl_res.='<table class="table table-bordered algincss" style="border-top:1px solid #000;margin-top: 15px;font-size:12px;line-height:40px;" ALIGN="CENTER">
                    <thead><tr><th style=""><b>Parameter</b></th><th style=""><b>Result Value</b></th><th style=""><b>Units</b></th><th style=""><b>Normal Values</b></th></tr></thead></table>';
        
        /*echo"<pre>";   //print_r($lab_report_res);
           $i=1;
           foreach ($lab_cat as $key => $catvalue) {
                $tbl_res.='<div style="text-align:center;font-size:16px;text-transform: uppercase;line-height:30px;"><B>'.$catvalue['category_name'] .'</B></div>';
                foreach($lab_report_res as $key=> $repvalue){
                    $mastergroupname=ArrayHelper::map(MainTestgroup::find()->where(['autoid'=>$repvalue['mastergroupid']])->asArray()->all(), 'autoid', 'testgroupname');
                    print_r($mastergroupname);
                    
                    $mastergroupname=MainTestgroup::find()->where(['autoid'=>$repvalue['mastergroupid']])->asArray()->one();
                    $tbl_res.='<table class="table table-bordered algincss" ALIGN="Center" style="line-height:40px;margin-bottom: -2px;background: #ffd9d9;font-size:12px;line-height:40px;"><tr><td style="padding: 3px 10px;text-align: center;"><b>'.$mastergroupname['testgroupname'].'</b></td></tr></table>';
                    
                }
           }            
            print_r($tbl_res);*/    
            
            foreach ($lab_cat as $key => $catvalue) {
                $tbl_res.='<div style="text-align:center;font-size:16px;text-transform: uppercase;line-height:30px;"><B>'.$catvalue['category_name'] .'</B></div>';
                $ia=1; $mul="";$catname=""; 
                foreach ($lab_payment as $key => $value)  
                {
                  $split_group=explode('_', $value['lab_common_id']);
                  
                  if($split_group[0]=="MasterGroup"){
                    $mastergroupname=ArrayHelper::map(MainTestgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all(), 'autoid', 'testgroupname');
                    $lab_mastergroup=LabAddgroup::find()->where(['mastergroupid'=>$value['lab_testgroup']])->asArray()->all();
                    if(!empty($lab_mastergroup))
                     {
                         $vali=0;
                         $tbl_res.='<table class="table table-bordered algincss" ALIGN="Center" style="line-height:40px;margin-bottom: -2px;background: #ffd9d9;font-size:12px;line-height:40px;"><tr><td style="padding: 3px 10px;text-align: center;"><b>'.$mastergroupname[$value["lab_testgroup"]].'</b></td></tr></table>';
                        foreach ($lab_mastergroup as $key => $masvalue) 
                        { 
                            $testgroupname=ArrayHelper::map(Testgroup::find()->where(['autoid'=>$masvalue['testgroupid']])->asArray()->all(), 'autoid', 'testgroupname');
                            $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$masvalue['testgroupid']])->asArray()->all();
                            $i=1;
                            
                            if(!empty($lab_testgroup)){
                                    $tbl_res.='<table class="table table-bordered algincss" ALIGN="Center" style="margin-bottom: -2px;background: #ffd9d9;"><tr><td style="padding: 3px 10px;text-align: Left;"><b>'.$testgroupname[$masvalue['testgroupid']].'</b></td></tr></table>';
                                }
                        
                           foreach ($lab_testgroup as $key1 => $value1) 
                            {   
                                $lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->andWhere(['cat_id'=>$catvalue['auto_id']])->asArray()->one();
                                if(!empty($lab_testing)){
                                    
                                $lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
                                $lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
                                
                                            if('Male'==$newpatient['pat_sex'])
                                            {
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->asArray()->one();
                                            }
                                            if('Female'==$newpatient['pat_sex']){
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
                                                ->asArray()->one();
                                            }
                                $lab_report=LabReport::find()->asArray()->one();
                                $lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
                                $mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
                                $savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
                                $lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
                                $normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
                                if($lab_testing['result_type']=="numeric"){
                                
                                 if(!empty($lab_reference_val)){
                                    $tbl_res.='<table class="table table-bordered algincss group" style="line-height:20px;margin-bottom: -2px;" ALIGN="CENTER">';
                                $tbl_res.='<tbody>';
                                $tbl_res.='<tr>';
                                $tbl_res.='<td style="position:relative;text-align:left">'.$lab_testing['test_name'].'</td>';
                                    $tbl_res.='<td style="">'.$lab_report_val[$vali]['result'].'</td>'; 
                                    $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                    if('numeric'==$lab_testing['result_type']){
                                        $tbl_res.='<td style="text-align:left">'.$lab_reference_val['reference_name'].' '.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';  
                                    }else if('multichoice'==$lab_testing['result_type']){
                                        foreach ($normal_multext as $key => $value) {
                                            $mul.=",".$value;
                                        }
                                            $string = trim($mul,",");
                                            $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                            $mul="";
                                    }else{
                                        $tbl_res.='<td style="text-align:Center">-<input type="hidden" name="REFERENCENAME[]" ></td>';
                                    }
                                    $tbl_res.='</tr></tbody></table>';
                                        $i++;
                                             }
                                }else{
                                    $tbl_res.='<table class="table table-bordered algincss group" style="line-height:20px;margin-bottom: -2px;" ALIGN="CENTER">';
                                $tbl_res.='<tbody>';
                                $tbl_res.='<tr>';
                                $tbl_res.='<td style="position:relative;text-align:left">'.$lab_testing['test_name'].'</td>';
                                    $tbl_res.='<td style="">'.$lab_report_val[$vali]['result'].'</td>'; 
                                    $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                    if('numeric'==$lab_testing['result_type']){
                                        $tbl_res.='<td style="text-align:left">'.$lab_reference_val['reference_name'].' '.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';  
                                    }else if('multichoice'==$lab_testing['result_type']){
                                        foreach ($normal_multext as $key => $value) {
                                            $mul.=",".$value;
                                        }
                                            $string = trim($mul,",");
                                            $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                            $mul="";
                                    }else{
                                        $tbl_res.='<td style="text-align:Center">-<input type="hidden" name="REFERENCENAME[]" ></td>';
                                    }
                                    $tbl_res.='</tr></tbody></table>';
                                        $i++;
                                }
                                
                                    }
                                    $vali++;
                                  } 
                                }
                               }
                             }
                    
                        $split_group=explode('_', $value['lab_common_id']);
                        if($split_group[0]=="TestGroup"){
                             $testgroupname=ArrayHelper::map(Testgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all(), 'autoid', 'testgroupname');
                             $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$value['lab_testgroup']])->asArray()->all();
                            if(!empty($lab_testgroup)){
                                $i=1;
                                $tbl_res.='<table class="table table-bordered algincss" ALIGN="Center" style="line-height:30px;margin-bottom: -2px;background: #ffd9d9;"><tr><td style="padding: 3px 10px;text-align: Left;font-size:10px;"><b>'.$testgroupname[$value['lab_testgroup']].'</b></td></tr></table>';  
                                foreach ($lab_testgroup as $key1 => $value1) 
                                {   
                                    $lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->andWhere(['cat_id'=>$catvalue['auto_id']])->asArray()->one();
                                    if(!empty($lab_testing))
                                    {
                                        $lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
                                        $lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
                                        $lab_report=LabReport::find()->asArray()->one();
                                        $lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
                                //echo"<pre>";print_r($lab_report_val[$key1]['result']);    
                                        if('Male'==$newpatient['pat_sex'])
                                            {
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->asArray()->one();
                                            }
                                            if('Female'==$newpatient['pat_sex']){
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
                                                ->asArray()->one();
                                            }
                                            
                                    $mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
                                    $savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
                                    $lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
                                    $normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
                                
                                
                                if($lab_testing['result_type']=="numeric"){
                            if(!empty($lab_reference_val)){
                                                $tbl_res.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;" ALIGN="CENTER">';
                                    $tbl_res.='<tbody>'; 
                                    $tbl_res.='<tr>';
                                    $tbl_res.='<td style="position:relative; text-align:left">'.$lab_testing['test_name'].'</td>';
                                        $tbl_res.='<td style="">'.$lab_report_val[$key1]['result'].'</td>'; 
                                        $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                            if('numeric'==$lab_testing['result_type']){
                                                $tbl_res.='<td style="text-align:left;width:35%;text-transform:capitalize;">'.$lab_reference_val['reference_name'].'  '.$lab_reference_val['age'].'  '. $lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';
                                            
                                        }else if('multichoice'==$lab_testing['result_type']){
                                            foreach ($normal_multext as $key => $value) {
                                                $mul.=",".$value;
                                            }
                                            $string = trim($mul,",");
                                            $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                        $mul="";
                                        }else{
                                            $tbl_res.='<td style="text-align:Center">-</td>';
                                        }
                                        $tbl_res.='</tr></tbody></table>';
                                        $i++;
                                             }
                                }else{
                                    $tbl_res.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;" ALIGN="CENTER">';
                                    $tbl_res.='<tbody>'; 
                                    $tbl_res.='<tr>';
                                    $tbl_res.='<td style="position:relative; text-align:left">'.$lab_testing['test_name'].'</td>';
                                        $tbl_res.='<td style="">'.$lab_report_val[$key1]['result'].'</td>'; 
                                        $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                            if('numeric'==$lab_testing['result_type']){
                                                $tbl_res.='<td style="text-align:left;width:35%;text-transform:capitalize;">'.$lab_reference_val['reference_name'].'   '.$lab_reference_val['age_cal'].'  '. $lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';
                                        }else if('multichoice'==$lab_testing['result_type']){
                                            foreach ($normal_multext as $key => $value) {
                                                $mul.=",".$value;
                                            }
                                            $string = trim($mul,",");
                                            $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                        $mul="";
                                        }else{
                                            $tbl_res.='<td style="text-align:Center">-</td>';
                                        }
                                        $tbl_res.='</tr></tbody></table>';
                                        $i++;
                                            }
                                        } 
                                       }                                
                                    }   
                                 }
                                }
                
            $tbl_res.='<table class="table table-bordered algincss" ALIGN="Center" style="line-height:40px;margin-bottom: -2px;background: #ffd9d9;"><tr><td style="padding: 3px 10px;text-align: Left;"></td></tr></table>';
                foreach ($lab_payment as $key => $value)  
                {   
                    $split_group=explode('_', $value['lab_common_id']);
                    
                  if($split_group[0]=='LabTesting'){ 
                            $lab_testing=LabTesting::find()->where(['autoid'=>$value['lab_testing']])->andWhere(['cat_id'=>$catvalue])->asArray()->all();
                                if(!empty($lab_testing))
                                    {
                                                
                                       foreach ($lab_testing as $key => $value1) {
                                         $lab_testing=LabTesting::find()->where(['autoid'=>$value1['autoid']])->andWhere(['cat_id'=>$catvalue['auto_id']])->asArray()->one();
                                          if(!empty($lab_testing)){
                                            
                                            $lab_unit=LabUnit::find()->where(['auto_id'=>$value1['unit_id']])->asArray()->one();
                                            $lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$value1['autoid']])->asArray()->one();
                                            $lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
                                            if('Male'==$newpatient['pat_sex'])
                                            {
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->asArray()->one();
                                            }
                                            if('Female'==$newpatient['pat_sex']){
                                                $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
                                                ->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
                                                ->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
                                                ->asArray()->one();
                                            }
                                                
                                            $mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
                                            $savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
                                            $lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
                                            $normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
                                            
                                    if($lab_testing['result_type']=="numeric"){
                                             if(!empty($lab_reference_val)){
                                                
                                            $tbl_res.='<table class="table table-bordered algincss" style="margin-bottom: -2px;" ALIGN="CENTER">';
                                            $tbl_res.='<tbody>';
                                            $tbl_res.='<tr>';
                                            $tbl_res.='<td style="text-align:left">'.$value1['test_name'].'</td>';
                                             if(!empty($lab_report_val)){
                                                $tbl_res.='<td style="">'.$lab_report_val[$key]['result'].' </td>'; 
                                            }
                                            $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                                if('numeric'==$lab_testing['result_type']){
                                                    $tbl_res.='<td style="text-align:left;width:35%;text-transform:capitalize;">'.$lab_reference_val['reference_name'].'  '. $lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';
                                                    //$tbl_res.='<td style="">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';    
                                                }else if('multichoice'==$lab_testing['result_type']){
                                                        foreach ($normal_multext as $key => $value) {
                                                            $mul.=",".$value;
                                                        }
                                                        $string = trim($mul,",");
                                                        $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                                        $mul="";
                                                }else{
                                                    $tbl_res.='<td style="text-align:Center">-</td>';
                                            }
                                            $tbl_res.='</tr></tbody></table>';
                                             }
                                    }
                                    else{
    
                                            $tbl_res.='<table class="table table-bordered algincss" style="margin-bottom: -2px;" ALIGN="CENTER">';
                                            $tbl_res.='<tbody>';
                                            $tbl_res.='<tr>';
                                            $tbl_res.='<td style="text-align:left">'.$value1['test_name'].'</td>';
                                             if(!empty($lab_report_val)){
                                                $tbl_res.='<td style="">'.$lab_report_val[$key]['result'].' </td>'; 
                                            }
                                            $tbl_res.='<td style="">'.$lab_unit['unit_name'].'</td>';
                                                if('numeric'==$lab_testing['result_type']){
                                                    $tbl_res.='<td style="text-align:left;width:35%;text-transform:capitalize;">'.$lab_reference_val['reference_name'].'  '. $lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';
                                                    //$tbl_res.='<td style="">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'</td>';    
                                                }else if('multichoice'==$lab_testing['result_type']){
                                                        foreach ($normal_multext as $key => $value) {
                                                            $mul.=",".$value;
                                                        }
                                                        $string = trim($mul,",");
                                                        $tbl_res.='<td style="text-align:left">'.$string.'</td>';
                                                        $mul="";
                                                }else{
                                                    $tbl_res.='<td style="text-align:Center">-</td>';
                                            }
                                            $tbl_res.='</tr></tbody></table>';
                                    }
                                          } 
                                        }
                                      } 
                                     }  
                             
                                }
                                $tbl_res.='<br><hr>';
                              }   
                                
            
                $pdf->writeHTML($tbl_res, true, false, false, false, '');
                
                $tbl12="";
                $tbl12.='<br><p style="font-size:14px;line-height:10px;"><b> Comments :</b> </p>';
                $tbl12.='<p >'.$lab_report_val[0]['textarea'].'</p>';
                $tbl12.='<p style="font-size:12px;line-height:00px;">  </p>';
                $tbl12.='<p style="font-size:12px;text-align:center;line-height:20px;"> *** End of the Report *** </p>';
                    $tbl12.='</body></html>';
                $pdf->writeHTML($tbl12, true, false, false, false, '');
                $labincharge='Lab Incharge';
                $verifiedby='Verified By';
                $pdf->SetXY(10,260,true);
                $pdf->Cell(100, 0, $labincharge, 0, 0);
                $pdf->SetXY(180,260,true);
                $pdf->Cell(100, 0, $verifiedby, 0, 0);
                
                $pdf->Output('labtest_print.pdf');
             
    }
    
    
    function AmtinWords($number)
    {
           $no = round($number);
           $point = round($number - $no, 2) * 100;
           $hundred = null;
           $digits_1 = strlen($no);
           $i = 0;
           $str = array();
           $words = array('0' => '', '1' => 'one', '2' => 'two',
                            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                            '7' => 'seven', '8' => 'eight', '9' => 'nine',
                            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                            '13' => 'thirteen', '14' => 'fourteen',
                            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                            '60' => 'sixty', '70' => 'seventy',
                            '80' => 'eighty', '90' => 'ninety');
           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
           while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
        :
        $words[floor($number / 10) * 10]
        . " " . $words[$number % 10] . " "
        . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $points = ($point) ?
            "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
          return $result . "Rupees  " . $points . " Paise";
    }
    
    


    protected function findModel($id)
    {
        if (($model = InLabPaymentPrime::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
