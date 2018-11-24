<?php

namespace backend\controllers;

use Yii;
use backend\models\Newpatient;
use backend\models\NewpatientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Insurance;
use backend\models\AutoidTable;
use yii\widgets\ActiveForm;
use backend\models\Physicianmaster;
use backend\models\Specialistdoctor;
use backend\models\PaymentType;
use backend\models\Patienttype;
use backend\models\Ucil;
use backend\models\ConsultantAmt;
use backend\models\SubVisit;
use backend\models\BranchAdmin;
use backend\models\CancelLogTable;
use yii\db\Query;
use yii\web\UploadedFile;
/**
 * NewpatientController implements the CRUD actions for Newpatient model.
 */
class NewpatientController extends Controller
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
     * Lists all Newpatient models.
     * @return mixed
     */
    public function actionIndex()
    {
      
        $searchModel = new NewpatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Newpatient model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Newpatient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  /*  public function actionCreate()
    {
      
    
    
        $model = new Newpatient();
    
    
    //$patientmax = Newpatient::find() -> max('patientid');
    //$patientmax=$patientmax+1;
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
        if ($model->load(Yii::$app->request->post()) ) 
        {
          
           $model->patientname =$_POST['Newpatient']['patientname'];
           $model->pat_inital_name =$_POST['Newpatient']['pat_inital_name'];
           $model->pat_age =$_POST['Newpatient']['pat_age'];
           $model-> pat_sex =$_POST['Newpatient']['pat_sex'];
           $model-> pat_marital_status =$_POST['Newpatient']['pat_marital_status'];
           $model-> pat_relation = $_POST['Newpatient']['pat_relation'];
           $model-> par_relationname = $_POST['Newpatient']['par_relationname'];
       $model-> dob = date('Y-m-d',strtotime($_POST['Newpatient']['dob']));
       $model-> insurance_type_id = $_POST['Newpatient']['insurance_type_id'];
           $model-> pat_address = $_POST['Newpatient']['pat_address'];
           $model-> pat_city = $_POST['Newpatient']['pat_city'];
           $model-> pat_distict = $_POST['Newpatient']['pat_distict'];
           $model-> pat_state = $_POST['Newpatient']['pat_state'];
           $model-> pat_pincode = $_POST['Newpatient']['pat_pincode'];
           $model-> pat_phone = $_POST['Newpatient']['pat_phone'];
           $model-> pat_mobileno = $_POST['Newpatient']['pat_mobileno'];
           $model-> pat_email = $_POST['Newpatient']['pat_email'];
           $model-> pat_source = $_POST['Newpatient']['pat_source'];
           $model-> pat_occupation = $_POST['Newpatient']['pat_occupation'];
           $model-> pat_education = $_POST['Newpatient']['pat_education'];
           $model-> pat_nationality = $_POST['Newpatient']['pat_nationality'];
           $model-> pat_religion = $_POST['Newpatient']['pat_religion'];
           $model-> pat_type = $_POST['Newpatient']['pat_type'];
           $model-> rel_dob = date('Y-m-d',strtotime($_POST['Newpatient']['rel_dob']));
           $model-> rel_mobile = $_POST['Newpatient']['rel_mobile'];
           $model-> rel_email = $_POST['Newpatient']['rel_email'];
           $model-> rel_qualify = $_POST['Newpatient']['rel_qualify'];
           $model-> rel_occupation = $_POST['Newpatient']['rel_occupation'];
           $model-> rel_religion = $_POST['Newpatient']['rel_religion'];
           $model-> rel_annual = $_POST['Newpatient']['rel_annual'];
           $model-> con_timing =  $_POST['Newpatient']['con_timing'];
           $model-> con_consultant = $_POST['Newpatient']['con_consultant'];
           $model-> con_department = $_POST['Newpatient']['con_department'];
           $model-> con_turn = $_POST['Newpatient']['con_turn'];
           $model-> fin_total = $_POST['Newpatient']['fin_total'];
           $model-> fin_lessdisc_percent = $_POST['Newpatient']['fin_lessdisc_percent'];
           $model-> fin_less_discount = $_POST['Newpatient']['fin_less_discount'];
           $model-> fin_net_amount =  $_POST['Newpatient']['fin_net_amount'];
           $model-> fin_paid_amount =  $_POST['Newpatient']['fin_paid_amount'];
           $model-> fin_due_amount = $_POST['Newpatient']['fin_due_amount'];
           $model-> fin_pay_mode = $_POST['Newpatient']['fin_pay_mode'];
           $model-> fin_emergency = $_POST['Newpatient']['fin_emergency'];
           $model-> fin_discountby = $_POST['Newpatient']['fin_discountby'];
           $model-> fin_remarks = $_POST['Newpatient']['fin_remarks'];
           $model-> fin_paycategory  = $_POST['Newpatient']['fin_paycategory'];
           $model-> fin_cardial  = $_POST['Newpatient']['fin_cardial'];
           $model-> fin_pancardno  = $_POST['Newpatient']['fin_pancardno'];
           $model-> fin_aadhar_card    = $_POST['Newpatient']['fin_aadhar_card'];
           $session = Yii::$app->session;
       $branch_id=$session['branch_id'];
          
           
           $model-> user_role = $session['user_id'];
           $model-> branch_id = $companybranchid;
           
           $model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
           $model-> create_at = date('Y-m-d');
       if($model->save())
       {
          return $this->redirect(['index']);
       }
       else {
         print_r($model->getErrors());die;
       }
       
        }

        return $this->render('create', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
        ]);
    }*/


  /*public function actionCreate1()
    {
      $model = new Newpatient();
    //$patientmax = Newpatient::find() -> max('patientid');
    //$patientmax=$patientmax+1;
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
        if ($model->load(Yii::$app->request->post()) ) 
        {
          
           $model->patientname =$_POST['Newpatient']['patientname'];
           $model->pat_inital_name =$_POST['Newpatient']['pat_inital_name'];
           $model->pat_age =$_POST['Newpatient']['pat_age'];
           $model-> pat_sex =$_POST['Newpatient']['pat_sex'];
           $model-> pat_marital_status =$_POST['Newpatient']['pat_marital_status'];
           $model-> pat_relation = $_POST['Newpatient']['pat_relation'];
           $model-> par_relationname = $_POST['Newpatient']['par_relationname'];
       $model-> dob = date('Y-m-d',strtotime($_POST['Newpatient']['dob']));
       $model-> insurance_type_id = $_POST['Newpatient']['insurance_type_id'];
           $model-> pat_address = $_POST['Newpatient']['pat_address'];
           $model-> pat_city = $_POST['Newpatient']['pat_city'];
           $model-> pat_distict = $_POST['Newpatient']['pat_distict'];
           $model-> pat_state = $_POST['Newpatient']['pat_state'];
           $model-> pat_pincode = $_POST['Newpatient']['pat_pincode'];
           $model-> pat_phone = $_POST['Newpatient']['pat_phone'];
           $model-> pat_mobileno = $_POST['Newpatient']['pat_mobileno'];
           $model-> pat_email = $_POST['Newpatient']['pat_email'];
           $model-> pat_source = $_POST['Newpatient']['pat_source'];
           $model-> pat_occupation = $_POST['Newpatient']['pat_occupation'];
           $model-> pat_education = $_POST['Newpatient']['pat_education'];
           $model-> pat_nationality = $_POST['Newpatient']['pat_nationality'];
           $model-> pat_religion = $_POST['Newpatient']['pat_religion'];
           $model-> pat_type = $_POST['Newpatient']['pat_type'];
           $model-> rel_dob = date('Y-m-d',strtotime($_POST['Newpatient']['rel_dob']));
           $model-> rel_mobile = $_POST['Newpatient']['rel_mobile'];
           $model-> rel_email = $_POST['Newpatient']['rel_email'];
           $model-> rel_qualify = $_POST['Newpatient']['rel_qualify'];
           $model-> rel_occupation = $_POST['Newpatient']['rel_occupation'];
           $model-> rel_religion = $_POST['Newpatient']['rel_religion'];
           $model-> rel_annual = $_POST['Newpatient']['rel_annual'];
           $model-> con_timing =  $_POST['Newpatient']['con_timing'];
           $model-> con_consultant = $_POST['Newpatient']['con_consultant'];
           $model-> con_department = $_POST['Newpatient']['con_department'];
           $model-> con_turn = $_POST['Newpatient']['con_turn'];
           $model-> fin_total = $_POST['Newpatient']['fin_total'];
           $model-> fin_lessdisc_percent = $_POST['Newpatient']['fin_lessdisc_percent'];
           $model-> fin_less_discount = $_POST['Newpatient']['fin_less_discount'];
           $model-> fin_net_amount =  $_POST['Newpatient']['fin_net_amount'];
           $model-> fin_paid_amount =  $_POST['Newpatient']['fin_paid_amount'];
           $model-> fin_due_amount = $_POST['Newpatient']['fin_due_amount'];
           $model-> fin_pay_mode = $_POST['Newpatient']['fin_pay_mode'];
           $model-> fin_emergency = $_POST['Newpatient']['fin_emergency'];
           $model-> fin_discountby = $_POST['Newpatient']['fin_discountby'];
           $model-> fin_remarks = $_POST['Newpatient']['fin_remarks'];
           $model-> fin_paycategory  = $_POST['Newpatient']['fin_paycategory'];
           $model-> fin_cardial  = $_POST['Newpatient']['fin_cardial'];
           $model-> fin_pancardno  = $_POST['Newpatient']['fin_pancardno'];
           $model-> fin_aadhar_card    = $_POST['Newpatient']['fin_aadhar_card'];
           $session = Yii::$app->session;
       $branch_id=$session['branch_id'];
          
           
           $model-> user_role = $session['user_id'];
           $model-> branch_id = $companybranchid;
           
           $model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
           $model-> create_at = date('Y-m-d');
       if($model->save())
       {
          return $this->redirect(['index']);
       }
       else {
         print_r($model->getErrors());die;
       }
       
        }

        return $this->render('create1', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
        ]);
    }
*/

  public function actionCreateshort()
    {
        $model = new Newpatient();
    
    $ucil = new Ucil();
    
    $consamt = new ConsultantAmt();
    
    $subvisit = new SubVisit();
    
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
    
    
        if ($model->load(Yii::$app->request->post())) 
        {
        
      //echo "<pre>"; print_r($_POST); die;
      $auto_get=AutoidTable::find()->where(['auto'=>1])->asArray()->one();
      
      if(!empty($auto_get))
      {
           $autoget=$auto_get['start_num'];
           $inc_value=$autoget+1;
           $rtno = str_pad($autoget, 6, "0", STR_PAD_LEFT);
          
           
               $session = Yii::$app->session;
           $branch_id=$session['branch_id'];
           
           $model-> mr_no = $rtno;
           $model-> pat_inital_name = $_POST['Newpatient']['pat_inital_name'];
           $model-> temporary_blocked = 'N';
           
           $model-> patientname = $_POST['Newpatient']['patientname'];
           $model-> dob = date('Y-m-d',strtotime($_POST['Newpatient']['dob']));
           $model-> pat_age = $_POST['Newpatient']['pat_age'];
           $model-> pat_relation = $_POST['Newpatient']['pat_relation'];
           $model-> par_relationname = $_POST['Newpatient']['par_relationname'];
           $model-> pat_marital_status = $_POST['Newpatient']['pat_marital_status'];
           $model-> pat_sex = $_POST['Newpatient']['pat_sex'];
           $model-> pat_city = $_POST['Newpatient']['pat_city'];
           $model-> pat_distict = $_POST['Newpatient']['pat_distict'];
           $model-> pat_state = $_POST['Newpatient']['pat_state'];
           $model-> pat_pincode = $_POST['Newpatient']['pat_pincode'];
           $model-> pat_phone = $_POST['Newpatient']['pat_phone'];
           $model-> pat_mobileno = $_POST['Newpatient']['pat_mobileno'];
           $model-> pat_email = $_POST['Newpatient']['pat_email'];
           $model-> pat_source = $_POST['Newpatient']['pat_source'];
           $model-> pat_education = $_POST['Newpatient']['pat_education'];
           $model-> pat_occupation = $_POST['Newpatient']['pat_occupation'];
           $model-> pat_religion = $_POST['Newpatient']['pat_religion'];
           $model-> pat_nationality = $_POST['Newpatient']['pat_nationality'];
           $model-> pat_address = $_POST['Newpatient']['pat_address'];
           $model-> rel_dob = date('Y-m-d',strtotime($_POST['Newpatient']['rel_dob']));
           $model-> rel_mobile = $_POST['Newpatient']['rel_mobile'];
           $model-> rel_email = $_POST['Newpatient']['rel_email'];
           $model-> rel_annual = $_POST['Newpatient']['rel_annual'];
           $model-> fin_paycategory = $_POST['Newpatient']['fin_paycategory'];
           $model-> fin_cardial = $_POST['Newpatient']['fin_cardial'];
           $model-> fin_pancardno = $_POST['Newpatient']['fin_pancardno'];
           $model-> fin_aadhar_card = $_POST['Newpatient']['fin_aadhar_card'];
           $model-> ucil_emp_id = $_POST['Newpatient']['hide_ucil_id'];
           $model-> pat_type = $_POST['Newpatient']['pat_type'];
           $model-> user_role = $session['authUserRole'];
           $model-> user_id = $session['user_id'];
               $model-> branch_id =$session['branch_id'];
             
               $model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
               $model-> create_at = date('Y-m-d H:i:s ');
          
          
          if($model->save())
          {
            
            //Sub_number Getting
            $auto_get_sub=AutoidTable::find()->where(['auto'=>2])->asArray()->one();
            
            $inc_value_sub=$auto_get_sub['start_num']+1;
              $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
            
            //Insert Primary Key
            $subvisit->pat_id = $model-> patientid;
            
            $subvisit->cons_status='N';
            $subvisit->refund_status='NO';
            $subvisit->mr_number = $rtno;
            $subvisit-> sub_visit = $auto_get_sub['start_num'];
            $subvisit-> consultant_time = $_POST['Newpatient']['con_timing'];
            $subvisit-> consultant_doctor = $_POST['Newpatient']['con_consultant'];
            
            $subvisit-> department = $_POST['Newpatient']['con_department'];
            $subvisit-> patient_type = $_POST['Newpatient']['pat_type'];
            $subvisit-> insurance_type = $_POST['Newpatient']['insurance_type_id'];
            $subvisit-> con_turn = $_POST['Newpatient']['con_turn'];
            
            $subvisit-> ucil_letter_status = $_POST['Newpatient']['hide_radio_value'];
            
            $subvisit-> ucil_emp_id = $_POST['Newpatient']['hide_ucil_id'];
            $subvisit-> patient_date = date('Y-m-d',strtotime($_POST['Newpatient']['hide_curr_date']));
            $subvisit-> ucil_date = date('Y-m-d',strtotime($_POST['Newpatient']['hide_ucil_issue_date']));
            
            if($_POST['Newpatient']['hide_radio_value'] == 'YES')
            {
              $subvisit-> status_given = 'Y';
              $subvisit-> claim_status = 'N';
            }
            else if($_POST['Newpatient']['hide_radio_value'] == 'NO')
            {
              $subvisit-> status_given = 'N';
              $subvisit-> claim_status = 'N';
            }
            
            
            //Consultant Amount
            $subvisit-> total_amount = $_POST['Newpatient']['fin_total'];
            $subvisit-> less_disc_percent = $_POST['Newpatient']['fin_lessdisc_percent'];
            $subvisit-> less_disc_flat = $_POST['Newpatient']['fin_less_discount'];
            $subvisit-> net_amt = $_POST['Newpatient']['fin_net_amount'];
            $subvisit-> paid_amt = $_POST['Newpatient']['fin_paid_amount'];
            $subvisit-> due_amt = $_POST['Newpatient']['fin_due_amount'];
            $subvisit-> pay_mode = $_POST['Newpatient']['fin_pay_mode'];
            $subvisit-> disc_by = $_POST['Newpatient']['fin_discountby'];
            $subvisit-> remarks = $_POST['Newpatient']['fin_remarks'];
            
            $subvisit-> authority = $model-> fin_paycategory;
            $subvisit-> reason = $model-> fin_cardial;
            
            $subvisit->created_at = date('Y-m-d H:i:s');
            $subvisit->user_id =$session['user_id'];
            $subvisit->user_role =$session['authUserRole'];
            $subvisit->branch_id =$session['branch_id'];
            $subvisit->updated_ipaddress =$_SERVER['REMOTE_ADDR'];
            
            if($subvisit->save())
            {
              if($_POST['Newpatient']['hide_radio_value'] == 'YES')
              {
                $header='Refferal Latter Not Given Reg';
                $body='Hai UCIL,   This Patient Give the Refferal Letter "'.$model-> patientname.'" on "'.date('d-m-Y H:i:s').'"';
                //$this->actionMailer($header,$body);
              }
              else if($_POST['Newpatient']['hide_radio_value'] == 'NO')
              {
                $header='Refferal Latter Not Given Reg';
                $body='Hai UCIL,   This Patient Not Give the Refferal Letter "'.$model-> patientname.'" on "'.date('d-m-Y H:i:s').'"';
              //  $this->actionMailer($header,$body);
              }
              
              $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 2]);
              if($valid_sub_number == 1)
              {
                $valid_update=AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 1]);
                if($valid_update == 1)
                {
                  $data = ArrayHelper::toArray($model);
                  $data_sub = ArrayHelper::toArray($subvisit);
                  
                  $fetch_view[0]='Save';
                  $fetch_view[1]=$data;
                  $fetch_view[2]=$data_sub;
                  
                  $myJSON = json_encode($fetch_view);
                  return $myJSON;
                } 
              }
            }
            else 
            {
              print_r($subvisit->getErrors());die;
            }
              
              
            
          }
          else 
          {
            echo "<pre>";
            print_r($model->getErrors());die;
            echo "N";
          }
      }
      
       
        } 
    else {
      
       return $this->render('createshort', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'physicianmaster' => $physicianmaster,
            'specialistdoctor' => $specialistdoctor,
            'paymenttype' =>$paymenttype,
            'patienttype' => $patienttype,
        ]); 
    }

        
    }


/*if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $image = UploadedFile::getInstance($model,'image');

            $imagepath='upload/jobs/';

            $rand_name=rand(10,100);

            if ($image)
            {
                $model->image = "category_{$rand_name}-{$image}"; 
            }

                if($model->save()):
                    if($image):
                     $image->saveAs($imagepath.$model->image);
                    endif;
                endif;             
                return $this->redirect(['view', 'id' => $model->id]);
            }  
*/
  
  
  
  
  
  public function actionImages($id)
    {
      $model=$this->findModel($id);
    $newpatient =Newpatient::find()->where(['patientid'=>$id])->one();
      if ($model->load(Yii::$app->request->post()) ) 
        {
          if (Yii::$app->request->isPost) 
          {
                $model->patient_file = UploadedFile::getInstance($model, 'patient_file');
          $rand_name=rand(10,100);  
        if ($model->patient_file && $model->validate()) 
        {
          $filepath= 'uploads/' . $rand_name.$model->patient_file->baseName . '.' . $model->patient_file->extension;               
                  
                  if($model->patient_file->saveAs($filepath))
          {
            
            $validated=Newpatient::updateAll(['image' => $filepath,'updated_at' => date('Y-m-d H:i:s'),'updated_ipaddress'=> $_SERVER['REMOTE_ADDR']], ['patientid' => $id]);
            if($validated == 1)
            {
              Yii::$app->getSession()->setFlash('success', 'File has been Updated successfully.'); 
               return $this -> redirect(['index']);
            }
          }
          
        }
           
          }
      
    }
    else 
    {
      return $this->renderAjax('images', [
            'model' => $model,
            'newpatient' => $newpatient,
          ]);
    }
  }

  public function actionCreateshort1()
    {
        $model = new Newpatient();
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    
    
        if ($model->load(Yii::$app->request->post()) ) 
        {
      if(Yii::$app->request->isAjax)
      {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              return ActiveForm::validate($model);
          }
        
      $model->mr_no=$_POST['Newpatient']['mr_no'];
      $model->patientname=$_POST['Newpatient']['patientname'];
      $model->pat_age=$_POST['Newpatient']['pat_age'];
      $model->pat_sex=$_POST['Newpatient']['pat_sex'];
      $model->insurance_type_id=$_POST['Newpatient']['insurance_type_id'];
      $model->pat_mobileno=$_POST['Newpatient']['pat_mobileno'];
      $model->doctor_name=$_POST['Newpatient']['doctor_name'];
      $model->dob=date('Y-m-d',strtotime($_POST['Newpatient']['dob']));
      
      if($model->save())
      {
        return $this -> redirect(['index']);
      }
      else 
      {
        print_r($model->getErrors());die; 
      }
       
        }
    else {
      return $this->render('createshort1', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'specialistdoctor' => $specialistdoctor,
        ]); 
    }

        
    }
  

    /**
     * Updates an existing Newpatient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
    $subvisit = SubVisit::find()->where(['pat_id'=>$model->patientid])->orderBy(['sub_id'=>SORT_DESC])->one();
    if(empty($subvisit))
    {
      $subvisit = new SubVisit();
    }
    
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
  
        if ($model->load(Yii::$app->request->post())) 
        {
           $model->pat_inital_name = $_POST['Newpatient']['pat_inital_name'];
       $model-> temporary_blocked = 'N';
       $model->patientname = $_POST['Newpatient']['patientname'];
       $model->dob = date('Y-m-d',strtotime($_POST['Newpatient']['dob']));
       $model->pat_age = $_POST['Newpatient']['pat_age'];
       $model->pat_relation = $_POST['Newpatient']['pat_relation'];
       $model->par_relationname = $_POST['Newpatient']['par_relationname'];
       $model->pat_marital_status = $_POST['Newpatient']['pat_marital_status'];
       $model->pat_sex = $_POST['Newpatient']['pat_sex'];
       $model->pat_city = $_POST['Newpatient']['pat_city'];
       $model->pat_distict = $_POST['Newpatient']['pat_distict'];
       $model->pat_state = $_POST['Newpatient']['pat_state'];
       $model->pat_pincode = $_POST['Newpatient']['pat_pincode'];
       $model->pat_phone = $_POST['Newpatient']['pat_phone'];
       $model->pat_mobileno = $_POST['Newpatient']['pat_mobileno'];
       $model->pat_email = $_POST['Newpatient']['pat_email'];
       $model->pat_source = $_POST['Newpatient']['pat_source'];
       $model->pat_education = $_POST['Newpatient']['pat_education'];
       $model->pat_occupation = $_POST['Newpatient']['pat_occupation'];
       $model->pat_religion = $_POST['Newpatient']['pat_religion'];
       $model->pat_nationality = $_POST['Newpatient']['pat_nationality'];
       $model->pat_address = $_POST['Newpatient']['pat_address'];
       $model->rel_dob = date('Y-m-d',strtotime($_POST['Newpatient']['rel_dob']));
       $model->rel_mobile = $_POST['Newpatient']['rel_mobile'];
       $model->rel_email = $_POST['Newpatient']['rel_email'];
       $model->rel_annual = $_POST['Newpatient']['rel_annual'];
       $model->con_timing = $_POST['Newpatient']['con_timing'];
       $model->con_turn = $_POST['Newpatient']['con_turn'];
       $model->fin_paycategory = $_POST['Newpatient']['fin_paycategory'];
       $model->fin_cardial = $_POST['Newpatient']['fin_cardial'];
       $model->fin_pancardno = $_POST['Newpatient']['fin_pancardno'];
       $model->fin_aadhar_card = $_POST['Newpatient']['fin_aadhar_card'];
      
       $model-> user_role = $session['user_id'];
         $model-> branch_id = $companybranchid;
        
       if($model->save())
       {
          echo 'S';
       }
    }
    else 
    { 
           return $this->render('update', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'physicianmaster' => $physicianmaster,
            'specialistdoctor' => $specialistdoctor,
            'paymenttype' =>$paymenttype,
            'patienttype' => $patienttype,
            'subvisit' => $subvisit,
               
          ]);       
    }


    }

  
  //Sub Visit
  public function actionSubVisit($id)
    {
       if(is_numeric($id))
     {
        $id=$id;
     }
     else
     {
        $id=base64_decode(urldecode($id));
     }
       
      
     $model = $this->findModel($id);
     
      $subvisit = new SubVisit();
            
    
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');   
    
       if ($model->load(Yii::$app->request->post()))
     {
      
      //Sub_number Getting
      $auto_get_sub=AutoidTable::find()->where(['auto'=>2])->asArray()->one();
      
      $inc_value_sub=$auto_get_sub['start_num']+1;
        $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
    
    
      $subvisit->pat_id =$id;
        $subvisit->cons_status =$_POST['SubVisit']['cons_status'];
      $subvisit->mr_number =$_POST['Newpatient']['mr_no'];
      $subvisit->sub_visit =$auto_get_sub['start_num'];
      $subvisit->consultant_time =$_POST['SubVisit']['consultant_time'];
      $subvisit->refund_status='NO';
      
      $subvisit->consultant_doctor =$_POST['SubVisit']['consultant_doctor'];
      $subvisit->department =$_POST['SubVisit']['department'];
      $subvisit-> con_turn =$_POST['SubVisit']['con_turn'];
      $subvisit-> patient_type =$_POST['SubVisit']['patient_type'];
      $subvisit-> insurance_type =$_POST['SubVisit']['insurance_type'];
      
      $subvisit-> ucil_letter_status =$_POST['Newpatient']['hide_radio_value'];
      $subvisit-> ucil_emp_id =$_POST['Newpatient']['hide_ucil_id'];
      $subvisit-> patient_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_curr_date']));
      $subvisit-> ucil_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_ucil_issue_date']));
      if($_POST['Newpatient']['hide_radio_value'] == 'YES')
      {
        $subvisit-> status_given ='Y';
        $subvisit-> claim_status ='N';
      }
      else if ($_POST['Newpatient']['hide_radio_value'] == 'NO') 
      {
        $subvisit-> status_given ='N';
        $subvisit-> claim_status ='N';
      }
      
      $subvisit-> total_amount =$_POST['SubVisit']['total_amount'];
      $subvisit-> less_disc_percent =$_POST['SubVisit']['less_disc_percent'];
      $subvisit-> less_disc_flat =$_POST['SubVisit']['less_disc_flat'];
      $subvisit-> net_amt =$_POST['SubVisit']['net_amt'];
      $subvisit-> paid_amt =$_POST['SubVisit']['paid_amt'];
      $subvisit-> due_amt =$_POST['SubVisit']['due_amt'];
      $subvisit-> pay_mode =$_POST['SubVisit']['pay_mode'];
      $subvisit-> disc_by =$_POST['SubVisit']['disc_by'];
      $subvisit-> remarks =$_POST['SubVisit']['remarks'];
      $subvisit-> authority =$_POST['Newpatient']['fin_paycategory'];
      $subvisit-> reason =$_POST['Newpatient']['fin_cardial'];
      $subvisit-> created_at =date('Y-m-d H:i:s');
      $subvisit-> updated_at =date('Y-m-d H:i:s');
      $subvisit->user_id =$session['user_id'];
      $subvisit->user_role =$session['authUserRole'];
      $subvisit->branch_id =$session['branch_id'];
      $subvisit->updated_ipaddress =$_SERVER['REMOTE_ADDR'];
      
      
      if($subvisit->save())
      {
        $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 2]);
        if($valid_sub_number == 1)
        {
          $data = ArrayHelper::toArray($subvisit);
          
          $fetch_view[0]='Save';
          $fetch_view[1]=$data;
          
          $myJSON = json_encode($fetch_view);
          
          return $myJSON;
        }     
      }
      
     }
     else 
     {
      
      
        $subvisit_last_date = SubVisit::find()->where(['pat_id'=>$model->patientid])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
      
    
      $date_up_to=date('Y-m-d',strtotime($subvisit_last_date['created_at']));
      $date=date_create($date_up_to);
      date_add($date,date_interval_create_from_date_string("7 days"));
      
      $date_up_to_free=date_format($date,"Y-m-d");  
      
      
      
       return $this->render('sub-visit', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'physicianmaster' => $physicianmaster,
            'specialistdoctor' => $specialistdoctor,
            'paymenttype' =>$paymenttype,
            'patienttype' => $patienttype,
            'subvisit' => $subvisit,
            'subvisit_last_date' =>$subvisit_last_date,
            'date_up_to' => $date_up_to,
            'free_up_to' =>$date_up_to_free,
          ]);   
     } 
    }
  
  //Sub Visit
  public function actionSubVisitNew()
    {
      /* if(is_numeric($id))
     {
        $id=$id;
     }
     else
     {
        $id=base64_decode(urldecode($id));
     }
       
      
     $model = $this->findModel($id);
     
      $subvisit = new SubVisit();
        */    
    
    $model = new Newpatient();
     
      $subvisit = new SubVisit();
    
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');   
    
       if ($model->load(Yii::$app->request->post()))
     {
    
      //Sub_number Getting
      $auto_get_sub=AutoidTable::find()->where(['auto'=>2])->asArray()->one();
      
      $inc_value_sub=$auto_get_sub['start_num']+1;
        $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
    
    
      $subvisit->pat_id =$id;
        $subvisit->cons_status =$_POST['SubVisit']['cons_status'];
      $subvisit->mr_number =$_POST['Newpatient']['mr_no'];
      $subvisit->sub_visit =$auto_get_sub['start_num'];
      $subvisit->consultant_time =$_POST['SubVisit']['consultant_time'];
      
      $subvisit->consultant_doctor =$_POST['SubVisit']['consultant_doctor'];
      $subvisit->department =$_POST['SubVisit']['department'];
      $subvisit-> con_turn =$_POST['SubVisit']['con_turn'];
      $subvisit-> patient_type =$_POST['SubVisit']['patient_type'];
      $subvisit-> insurance_type =$_POST['SubVisit']['insurance_type'];
      
      $subvisit-> ucil_letter_status =$_POST['Newpatient']['hide_radio_value'];
      $subvisit-> ucil_emp_id =$_POST['Newpatient']['hide_ucil_id'];
      $subvisit-> patient_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_curr_date']));
      $subvisit-> ucil_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_ucil_issue_date']));
      if($_POST['Newpatient']['hide_radio_value'] == 'YES')
      {
        $subvisit-> status_given ='Y';
        $subvisit-> claim_status ='N';
      }
      else if ($_POST['Newpatient']['hide_radio_value'] == 'NO') 
      {
        $subvisit-> status_given ='N';
        $subvisit-> claim_status ='N';
      }
      
      $subvisit-> total_amount =$_POST['SubVisit']['total_amount'];
      $subvisit-> less_disc_percent =$_POST['SubVisit']['less_disc_percent'];
      $subvisit-> less_disc_flat =$_POST['SubVisit']['less_disc_flat'];
      $subvisit-> net_amt =$_POST['SubVisit']['net_amt'];
      $subvisit-> paid_amt =$_POST['SubVisit']['paid_amt'];
      $subvisit-> due_amt =$_POST['SubVisit']['due_amt'];
      $subvisit-> pay_mode =$_POST['SubVisit']['pay_mode'];
      $subvisit-> disc_by =$_POST['SubVisit']['disc_by'];
      $subvisit-> remarks =$_POST['SubVisit']['remarks'];
      $subvisit-> created_at =date('Y-m-d H:i:s');
      $subvisit-> updated_at =date('Y-m-d H:i:s');
      $subvisit-> user_id =$session['user_id'];
      $subvisit-> updated_ipaddress =$_SERVER['REMOTE_ADDR'];
      if($subvisit->save())
      {
        $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 2]);
        if($valid_sub_number == 1)
        {
          $data = ArrayHelper::toArray($subvisit);
          
          $fetch_view[0]='Save';
          $fetch_view[1]=$data;
          
          $myJSON = json_encode($fetch_view);
          
          return $myJSON;
        }     
      }
      
     }
     else 
     {
          //$subvisit_last_date = SubVisit::find()->where(['mr_number'=>$model->mr_no])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
      $subvisit_last_date = new SubVisit();
    
      $date_up_to=date('Y-m-d',strtotime($subvisit_last_date['created_at']));
      $date=date_create($date_up_to);
      date_add($date,date_interval_create_from_date_string("7 days"));
      
      $date_up_to_free=date_format($date,"Y-m-d");  
     return $this->render('sub-visit', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'physicianmaster' => $physicianmaster,
            'specialistdoctor' => $specialistdoctor,
            'paymenttype' =>$paymenttype,
            'patienttype' => $patienttype,
            'subvisit' => $subvisit,
            'subvisit_last_date' =>$subvisit_last_date,
            //  'date_up_to' => $date_up_to,
            //'free_up_to' =>$date_up_to_free,
          ]);   
     } 
    }

//Sub Visit
  public function actionSubVisitNew1()
    {
      
    
    $model = new Newpatient();
     
      $subvisit = new SubVisit();
    
    $session = Yii::$app->session;
    $role=$session['authUserRole'];
    $companybranchid=$session['branch_id'];
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');   
    
       if ($model->load(Yii::$app->request->post()))
     {
    
      //Sub_number Getting
      $auto_get_sub=AutoidTable::find()->where(['auto'=>2])->asArray()->one();
      
      $inc_value_sub=$auto_get_sub['start_num']+1;
        $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
    
    
      $subvisit->pat_id =$id;
        $subvisit->cons_status =$_POST['SubVisit']['cons_status'];
      $subvisit->mr_number =$_POST['Newpatient']['mr_no'];
      $subvisit->sub_visit =$auto_get_sub['start_num'];
      $subvisit->consultant_time =$_POST['SubVisit']['consultant_time'];
      
      $subvisit->consultant_doctor =$_POST['SubVisit']['consultant_doctor'];
      $subvisit->department =$_POST['SubVisit']['department'];
      $subvisit-> con_turn =$_POST['SubVisit']['con_turn'];
      $subvisit-> patient_type =$_POST['SubVisit']['patient_type'];
      $subvisit-> insurance_type =$_POST['SubVisit']['insurance_type'];
      
      $subvisit-> ucil_letter_status =$_POST['Newpatient']['hide_radio_value'];
      $subvisit-> ucil_emp_id =$_POST['Newpatient']['hide_ucil_id'];
      $subvisit-> patient_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_curr_date']));
      $subvisit-> ucil_date =date('Y-m-d',strtotime($_POST['Newpatient']['hide_ucil_issue_date']));
      if($_POST['Newpatient']['hide_radio_value'] == 'YES')
      {
        $subvisit-> status_given ='Y';
        $subvisit-> claim_status ='N';
      }
      else if ($_POST['Newpatient']['hide_radio_value'] == 'NO') 
      {
        $subvisit-> status_given ='N';
        $subvisit-> claim_status ='N';
      }
      
      $subvisit-> total_amount =$_POST['SubVisit']['total_amount'];
      $subvisit-> less_disc_percent =$_POST['SubVisit']['less_disc_percent'];
      $subvisit-> less_disc_flat =$_POST['SubVisit']['less_disc_flat'];
      $subvisit-> net_amt =$_POST['SubVisit']['net_amt'];
      $subvisit-> paid_amt =$_POST['SubVisit']['paid_amt'];
      $subvisit-> due_amt =$_POST['SubVisit']['due_amt'];
      $subvisit-> pay_mode =$_POST['SubVisit']['pay_mode'];
      $subvisit-> disc_by =$_POST['SubVisit']['disc_by'];
      $subvisit-> remarks =$_POST['SubVisit']['remarks'];
      $subvisit-> created_at =date('Y-m-d H:i:s');
      $subvisit-> updated_at =date('Y-m-d H:i:s');
      $subvisit-> user_id =$session['user_id'];
      $subvisit-> updated_ipaddress =$_SERVER['REMOTE_ADDR'];
      if($subvisit->save())
      {
        $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 2]);
        if($valid_sub_number == 1)
        {
          $data = ArrayHelper::toArray($subvisit);
          
          $fetch_view[0]='Save';
          $fetch_view[1]=$data;
          
          $myJSON = json_encode($fetch_view);
          
          return $myJSON;
        }     
      }
      
     }
     else 
     {
          
      
      
        return $this->render('new-sub-visit', [
              'model' => $model,
              'insurancelist' => $insurancelist,
              'physicianmaster' => $physicianmaster,
              'specialistdoctor' => $specialistdoctor,
              'paymenttype' =>$paymenttype,
              'patienttype' => $patienttype,
              'subvisit' => $subvisit,
             ]);    
     } 
    }

  

    /**
     * Deletes an existing Newpatient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
  
  
  public function actionGetspecialization($id)
    {
        $physicianmaster=Physicianmaster::find()->where(['is_active'=>1])->andWhere(['id'=>$id])->asArray()->one();
      $sp=array();
      if(!empty($physicianmaster))
      {
        $specialistdoctor=Specialistdoctor::find()->where(['is_active'=>1])->andWhere(['s_id'=>$physicianmaster['specialist']])->asArray()->one();
        
        
        
        if(!empty($specialistdoctor))
        {
          //return '<option value='.$specialistdoctor['s_id'].'>'.$specialistdoctor['specialist'].'</option>';
          $sp[0]='<option value='.$specialistdoctor['s_id'].'>'.$specialistdoctor['specialist'].'</option>';
          $sp[1]=$specialistdoctor['s_id'];
          $sp[2]=$specialistdoctor['consult_amount'];
          
           return json_encode($sp);
        }
      }
      
        
  }
  
  public function actionValidateddate()
    {
      if($_POST)
    {
      $curr_date=$_POST['curr_date'];
      $issue_date=$_POST['issue_date'];
      
      if($curr_date != '' && $issue_date != '')
      {
        $curr_date1=date('Y-m-d',strtotime($curr_date));  
        $issue_date1=date('Y-m-d',strtotime($issue_date));
      
        $date1=date_create($curr_date1);
        $date2=date_create($issue_date1);
        
        $diff=date_diff($date1,$date2);
        
        $corrected_date=$diff->format("%a");
        if($date1 <= $date2)
        {
          if($corrected_date <= 10)
          {
            echo 'OK';
          }
          else 
          {
            echo 'EXP'; 
          }
        }
        else if($date1 >= $date2)
        {
          //print_r($corrected_date);die;
          if($corrected_date <= 10)
          {
            echo 'OK';
          }
          else 
          {
            echo 'INV'; 
          }
          
        }
      }
    }
  }
  
  
  public function actionFetchmrnumber($mrnumber)
  {
    $mrnumber = json_decode($mrnumber);
    $patientdata=Newpatient::find()->where(['mr_no'=>$mrnumber])->one();
    
    $fetch_element=array();
    $insurance_id='';$insurances_name='';$id='';$name='';
    if(!empty($patientdata))
    {
      $subvisit=SubVisit::find()->where(['mr_number'=>$patientdata->mr_no])->orderBy(['sub_id' => SORT_DESC])->one();
      if(!empty($subvisit))
      {
        $patient_name=$patientdata->patientname;
        $patient_mobile_number=$patientdata->pat_mobileno;
        $consultant_doctor=$subvisit->consultant_doctor;
        $doctor_name=Physicianmaster::find()->where(['id'=>$consultant_doctor])->one();
        if(!empty($doctor_name))
        {
          $doctor_name_fetch=$doctor_name->physician_name;
        }
        $insurance_type=$subvisit->insurance_type;
        if($insurance_type != '')
        {
          $insurance=Insurance::find()->where(['insurance_typeid'=>$insurance_type])->andWhere(['is_active'=>1])->one();
          $insurance_id=$insurance->insurance_typeid;
          $insurances_name=$insurance->insurance_type;
        }
        
        $dob=date('d-m-Y',strtotime($patientdata->dob));
        
        $fetch_element[0]=$patient_name;
        $fetch_element[1]=$patient_mobile_number;
        $fetch_element[2]=$doctor_name_fetch;
        $fetch_element[3]=$dob;
        $fetch_element[4]="<option value='$insurance_id'>$insurances_name</option>";
        $fetch_element[5]=$patientdata->patientid;
        $fetch_element[6]=$patientdata->temporary_blocked;
      }
    }
        return json_encode($fetch_element);
  }
  
  
  
  
  
  

    /**
     * Finds the Newpatient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newpatient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newpatient::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
  
  
  //Report
  public function actionReport($id)
  {
    
     if(is_numeric($id))
     {
        $id=$id;
     }
     else
     {
        $id=base64_decode(urldecode($id));
     }
    
    
    $patientdata=Newpatient::find()->where(['patientid'=>$id])->one();
    
    if(!empty($patientdata))
    {
      $subvisit=SubVisit::find()->where(['mr_number'=>$patientdata->mr_no])->orderBy(['sub_id' => SORT_ASC])->one();
    //  print_r($subvisit);die;
      $insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
      $physicianmaster=ArrayHelper::index(Physicianmaster::find()->asArray()->all(), 'id');
      $specialistdoctor=ArrayHelper::index(Specialistdoctor::find()->asArray()->all(), 's_id');
      $paymenttype=ArrayHelper::index(PaymentType::find()->asArray()->all(), 'payment_type_id');
      $patienttype=ArrayHelper::index(Patienttype::find()->asArray()->all(), 'type_id');  
      $userdata=BranchAdmin::find()->where(['ba_autoid'=>$subvisit->user_id])->one();
      
      if(!empty($subvisit))
      {
        
        //Bill_number Getting
        $auto_get_sub=AutoidTable::find()->where(['auto'=>3])->asArray()->one();
        
        $inc_value_sub=$auto_get_sub['start_num']+1;
          $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
        $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 3]);
        $amount=($subvisit['insurance_type'])==1 ? $subvisit['due_amt'] : $subvisit['paid_amt'];
        $paidamount=($subvisit['insurance_type'])==1 ? 0 : $subvisit['paid_amt'];
        
        
        require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
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
        <body>  <div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
        $tbl1.='<p style="border-top:1px solid #000;"></p>';
        $tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;"><u>OPD REGISTERATION & CONSULTATION RECEIPT</u></p>';
        
        
        $tbl1.='<table class="tablestyle" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" >';
        $tbl1.='<tr><table style="border:1px solid #000;padding:5px 10px;" ALIGN="left"><tr><td style="width:20%;"><b>MR NUMBER</b></td>';
        $tbl1.='<td style="width:20%;">'.$patientdata['mr_no'].'</td>';
        $tbl1.='<td style="width:10%;"></td>';
        $tbl1.='<td style="width:10%;"></td>';
        $tbl1.='<td style="width:20%;"><b>BILL DATE</b></td>';
        $tbl1.='<td style="width:20%;">'.date('d-m-Y H:i:s A').'</td>';
        $tbl1.='</tr>';
        $tbl1.='<tr><td><b>PATIENT NAME</b></td>';
        $tbl1.='<td>'.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].'</td>';
        $tbl1.='<td></td>';
        $tbl1.='<td></td>';
        $tbl1.='<td><b>BILL NO</b></td>';
        $tbl1.='<td>'.$auto_get_sub['start_num'].'</td>';
        $tbl1.='</tr>';
        $tbl1.='<tr><td><b>AGE/GENDER</b></td>';
        $tbl1.='<td>'.$this->Getage(date('Y-m-d',strtotime($patientdata['dob']))).' Year(s) / '.$patientdata['pat_sex'].'</td>';
        $tbl1.='<td></td>';
        $tbl1.='<td></td>';
        $tbl1.='<td><b>MOBILE NO</b></td>';
        $tbl1.='<td>'.$patientdata['pat_mobileno'].'</td>';
        $tbl1.='</tr>';
        $tbl1.='<tr><td><b>CONSULTANT</b></td>';
        $tbl1.='<td>'.$physicianmaster[$subvisit['consultant_doctor']]['qualification'].'  '.$physicianmaster[$subvisit['consultant_doctor']]['physician_name'].'</td>';
        $tbl1.='<td></td>';
        $tbl1.='<td></td>';
        $tbl1.='<td><b>DEPARTMENT</b></td>';
        $tbl1.='<td>'.$specialistdoctor[$subvisit['department']]['specialist'].'</td>';
        $tbl1.='</tr>';
        
        
        if($subvisit['insurance_type'] == 1)
        {
          $tbl1.='<tr><td><b>UCIL EMPID / STATUS</b></td>';
          if($subvisit['ucil_letter_status'] == 'YES')
          {
            
            $tbl1.='<td>'.$subvisit['ucil_emp_id'] .' / '.$subvisit['ucil_letter_status'] .'</td>';
          }
          else if($subvisit['ucil_letter_status'] == 'NO')
          {
            $tbl1.='<td>'.$subvisit['ucil_emp_id'] .' / '.$subvisit['ucil_letter_status'].'</td>';
          }
          $tbl1.='<td></td>';
          $tbl1.='<td></td>';
          $tbl1.='<td><b>ISSUE / EXP DATE</b></td>';
          if($subvisit['ucil_letter_status'] == 'YES')
          {
            $issue_date=date_create(date('Y-m-d',strtotime($subvisit['created_at'])));
              date_add($issue_date,date_interval_create_from_date_string("10 days"));
            $issue_date=date_format($issue_date,"d-m-Y");
            $tbl1.='<td>'.date('d-m-Y',strtotime($subvisit['ucil_date'])).' / '.$issue_date.'</td>';
          }
          else if($subvisit['ucil_letter_status'] == 'NO'){
            $tbl1.='<td>'.$subvisit['ucil_letter_status'].' / NIL'.'</td>';
          }
          
          $tbl1.='</tr>';
        
        }
      
        $tbl1.='</table>';
       /* $tbl1.='</table></tr></table>';*/
        
        $tbl1.='<table style="border:1px solid #000; padding:5px 10px;" align="left"><tr><td style="width:25%;"><b>REGISTERATION FEES</b></td>';
        
        $tbl1.='<td style="width:10%;">'.number_format($subvisit['net_amt']).'</td><td></td><td></td>';
        $tbl1.='<td style="width:25%;"><b>CONSULTATION FEES</b></td>';
        $tbl1.='<td style="width:10%;">'.number_format($subvisit['net_amt']).'</td>
        <td style="width:2.5%;"></td><td style="width:2.5%;"></td></tr></table>';
        
        $tbl1.='<table Align="LEFT" style="border:1px solid #000;padding:5px 10px;"><tr><td style="width:25%;">Received with Thanks from</td>';
        
        $tbl1.='<td style="width:20%;">'.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].'</td>';
        $tbl1.='<td style="width:18%;">Sum of Rs.</td>';
        $tbl1.='<td style="width:10%;">'.number_format($amount).'</td>';
        $tbl1.='<td style="width:17%;">Total Amount</td>';
        $tbl1.='<td style="width:10%;">'.number_format($amount).'</td></tr>';
         
        $tbl1.='<tr><td style="width:50%;text-align:left;"><b>Towards OPD Registeration and Consultation</b></td></tr>'; 
        $tbl1.='<tr><td style="width:10%;text-align:left;"><b>In Words</b></td>';
        $tbl1.='<td style="width:50%;">'.ucwords($this->Numberwords(number_format($amount))).'</td>';
        $tbl1.='<td style="width:5%;"></td>';
        $tbl1.='<td style="width:20%;text-align:right;position:relative;right:20px;">Paid Amount:</td>';
        $tbl1.='<td style="width:10%;">'.number_format($paidamount).'</td></tr>';
        
        $tbl1.='<tr><td style="width:20%;">BILL USER</td>';
        $tbl1.='<td  style="width:20%;">'.$userdata['ba_name'].'</td>';
        $tbl1.='<td></td>';
        $tbl1.='<td  style="width:20%;">CASHIER</td>';
        $tbl1.='<td></td>';
        $tbl1.='<td></td></tr></table>';
        $tbl1.='</div>';
        $tbl1.='</body></html>';
        
        $pdf->writeHTML($tbl1, true, false, false, false, '');

        if($subvisit['insurance_type'] == 1 && $subvisit['ucil_letter_status'] == 'YES')
        { 
          
          $issue_date=date_create(date('Y-m-d',strtotime($subvisit['created_at'])));
            date_add($issue_date,date_interval_create_from_date_string("10 days"));
          $expired_date=date_format($issue_date,"Y-m-d");
          
          $pdf->AddPage();
          
          
          $tbl1='<html>
          <head>
          </head>
          <body>  <div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
          $tbl1.='<p style="border-top:1px solid #000;"></p>';
          $tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;"><u>ACKNOWLEDGEMENT SLIP</u></p>';
          $tbl1.='<table style="border:none;padding:2px 10px;font-size:12px;margin-top:250px;" ALIGN="left" ><tr><td style="width:15%;"><b>MR Number</b></td>';
          $tbl1.='<td style="width:35%;"> : '.$patientdata['mr_no'].' </td>';
          $tbl1.='<td style="width:23%;"><b> Register Date </b></td>';
          $tbl1.='<td style="width:35%;"> : '.date('d-m-Y H:i:A',strtotime($subvisit['created_at'])).'</td>';
          $tbl1.='</tr>';
          $tbl1.='<tr><td><b>Patient Name </b></td>';
          $tbl1.='<td> : '.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].' </td>';
          $tbl1.='<td><b> Reffer Issue</b></td>';
          $tbl1.='<td> : '.date('d-m-Y',strtotime($subvisit['ucil_date'])).'</td>';
          $tbl1.='</tr>';
          $tbl1.='<tr><td><b> UCIL ID</b></td>';
          $tbl1.='<td> : '.$subvisit['ucil_emp_id'].' </td>';
          $tbl1.='<td><b> Reffer Expired </b></td>';
          $tbl1.='<td> : '.date('d-m-Y',strtotime($expired_date)).'</td>';
          $tbl1.='</tr></table>';
          
          $tbl1.='<p></p><div style="text-align:center;font-size:16px;line-height:30px;text-transform: uppercase;"><span style="background-color: #aaa;border:1px solid #000;border:1px solid #000;padding:0 15px"><b>Valid for 10 Days</b></span></div>';
          
          $pdf->writeHTML($tbl1, true, false, false, false, '');
          $labincharge='Patient Signature';
          $verifiedby='Collection User Name';
          $pdf->SetXY(10,90,true);
          $pdf->Cell(100, 0, $labincharge, 0, 0);
            $pdf->SetXY(160,90,true);
          $pdf->Cell(100, 0, $verifiedby, 0, 0);
    
          $tbl1.='</body></html>';
        }
        
        $pdf->Output('OPD Registeration.pdf');
        
        
      }
    }
  }


  public function actionSubVisitReport($id)
    {
        $id=base64_decode(urldecode($id));
    
  
    $new_patient=Newpatient::find()->where(['patientid'=>$id])->asArray()->one();
    $patient_details=SubVisit::find()->where(['pat_id'=>$id])->orderBy(['sub_id'=>SORT_DESC])->asArray()->all(); 
    
    $insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
    $physicianmaster=ArrayHelper::index(Physicianmaster::find()->asArray()->all(), 'id');
    $specialistdoctor=ArrayHelper::index(Specialistdoctor::find()->asArray()->all(), 's_id');
    $paymenttype=ArrayHelper::index(PaymentType::find()->asArray()->all(), 'payment_type_id');
    $patienttype=ArrayHelper::index(Patienttype::find()->asArray()->all(), 'type_id');
    
    if(!empty($patient_details))
    {
      //DMC Sub-Visit Report
      $result_string='';
      $result_string.='<table class="table table-bordered">';
      $result_string.='<thead>
                  <tr>
                    <th>MR Number</th>
                    <th>Patient Name</th>
                    <th>Mobile No</th>
                   
                    <th>Gender/Age</th>
                   
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead><tbody>';
      $consultant_id=$patient_details;
      $patient_type=$patient_details;
      
      $result_string.='<tr><td>'.$new_patient['mr_no'].'</td>';
      $result_string.='<td>'.$new_patient['pat_inital_name']. ". " .$new_patient['patientname'].'</td>';
      
      $result_string.='<td>'.$new_patient['pat_mobileno'].'</td>';
      //$result_string.='<td>'.$patienttype[$patient_details[0]['patient_type']]['patient_type'].'</td>';
      $result_string.='<td>'.$new_patient['pat_sex']."/".$this->Getage($new_patient['dob']).'</td>';
      //$result_string.='<td>'.$physicianmaster[$consultant_id[0]['consultant_doctor']]['physician_name']."/".date('d-m-Y h:i A',strtotime($patient_details[0]['created_at'])).'</td>';
      $result_string.='<td>'.$patient_details[0]['pat_address'].'</td>';
      
      $result_string.='<td><a href="'.Yii::$app->homeUrl .'?r=newpatient/report&id='.urlencode(base64_encode($new_patient['patientid'])).'" target="_blank" class="btn  btn-xs btn-success mb1 view"  data-toggle="tooltip", data-placement="left", title="OPD-PDF"><i class="fa fa-print"></i></a></td></tr>';
      $result_string.='</tbody></table>';
      
      $result_string.='<table class="table table-bordered">';
      $result_string.='<thead>
                  <tr>
                    <th>SUB-VISIT</th>
                    <th>CONSULTANT</th>
                    <th>DEPARTMENT</th>
                    <th>DATE OF VISIT</th>
                    <th>ACTION</th></tr></thead><tbody>';
      
      
      foreach ($patient_details as $key => $value) 
      {
        
          $result_string.='<tr><td>'.$value['sub_visit'].'</td>';
          $result_string.='<td>'.$physicianmaster[$value['consultant_doctor']]['physician_name'].'</td>';
          $result_string.='<td>'.$specialistdoctor[$value['department']]['specialist'].'</td>';
          $result_string.='<td>'.date('d-m-y h:i A',strtotime($value['created_at'])).'</td>';
          $result_string.='<td><a href="'.Yii::$app->homeUrl .'?r=newpatient/subvistreportpdf&id='.urlencode(base64_encode($value['sub_id'])).'" target="_blank" class="btn  btn-xs btn-danger "  data-toggle="tooltip", data-placement="left", title="SubVisit-PDF"><i class="fa fa-print"></i></a></td></tr>';
        
      }
      $result_string.='</tbody></table>';
      return json_encode($result_string);
    }
    }



  /*public function actionSubVisitReport($id)
    {
        $id=base64_decode(urldecode($id));
    
  //  $query = new Query;       
    //$query  ->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.patientid = sub_visit.pat_id')->where(['sub_visit.pat_id'=>$id])->orderBy(['sub_visit.sub_id'=>SORT_DESC])->all(); 
    //$command = $query->createCommand();
    //$patient_details = $command->queryAll();
    $new_patient=Newpatient::find()->where(['patientid'=>$id])->one();
    $patient_details=SubVisit::find()->where(['pat_id'=>$id])->all();
    
    $insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
    $physicianmaster=ArrayHelper::index(Physicianmaster::find()->asArray()->all(), 'id');
    $specialistdoctor=ArrayHelper::index(Specialistdoctor::find()->asArray()->all(), 's_id');
    $paymenttype=ArrayHelper::index(PaymentType::find()->asArray()->all(), 'payment_type_id');
    $patienttype=ArrayHelper::index(Patienttype::find()->asArray()->all(), 'type_id');
    
    if(!empty($patient_details))
    {
      //DMC Sub-Visit Report
      $result_string='';
      $result_string.='<table class="table table-bordered">';
      $result_string.='<thead>
                  <tr>
                    <th>MR Number</th>
                    <th>Patient Name</th>
                    <th>Mobile No</th>
                    <th>Last Patient Type</th>
                    <th>Gender/Age</th>
                    <th>Last Consultant</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead><tbody>';
      $consultant_id=$patient_details;
      $patient_type=$patient_details;
      
      $result_string.='<tr><td>'.$patient_details[0]['mr_no'].'</td>';
      $result_string.='<td>'.$patient_details[0]['pat_inital_name']. ". " .$patient_details[0]['patientname'].'</td>';
      
      $result_string.='<td>'.$patient_details[0]['pat_mobileno'].'</td>';
      $result_string.='<td>'.$patienttype[$patient_details[0]['patient_type']]['patient_type'].'</td>';
      $result_string.='<td>'.$patient_details[0]['pat_sex']."/".$this->Getage($patient_details[0]['dob']).'</td>';
      $result_string.='<td>'.$physicianmaster[$consultant_id[0]['consultant_doctor']]['physician_name']."/".date('d-m-Y h:i A',strtotime($patient_details[0]['created_at'])).'</td>';
      $result_string.='<td>'.$patient_details[0]['pat_address'].'</td>';
      
      $result_string.='<td><a href="'.Yii::$app->homeUrl .'?r=newpatient/report&id='.urlencode(base64_encode($patient_details[0]['patientid'])).'" target="_blank" class="btn  btn-xs btn-success mb1 view"  data-toggle="tooltip", data-placement="left", title="OPD-PDF"><i class="fa fa-print"></i></a></td></tr>';
      $result_string.='</tbody></table>';
      
      $result_string.='<table class="table table-bordered">';
      $result_string.='<thead>
                  <tr>
                    <th>SUB-VISIT</th>
                    <th>CONSULTANT</th>
                    <th>DEPARTMENT</th>
                    <th>DATE OF VISIT</th>
                    <th>ACTION</th></tr></thead><tbody>';
      
      
      foreach ($patient_details as $key => $value) 
      {
        
          $result_string.='<tr><td>'.$value['sub_visit'].'</td>';
          $result_string.='<td>'.$physicianmaster[$value['consultant_doctor']]['physician_name'].'</td>';
          $result_string.='<td>'.$specialistdoctor[$value['department']]['specialist'].'</td>';
          $result_string.='<td>'.date('d-m-y h:i A',strtotime($value['created_at'])).'</td>';
          $result_string.='<td><a href="'.Yii::$app->homeUrl .'?r=newpatient/subvistreportpdf&id='.urlencode(base64_encode($value['sub_id'])).'" target="_blank" class="btn  btn-xs btn-danger "  data-toggle="tooltip", data-placement="left", title="SubVisit-PDF"><i class="fa fa-print"></i></a></td></tr>';
        
      }
      $result_string.='</tbody></table>';
      return json_encode($result_string);
    }
    }*/


  public function Getage($userDob)
  {
    
    //Create a DateTime object using the user's date of birth.
    $dob = new \DateTime($userDob);
    //We need to compare the user's date of birth with today's date.
    $now = new \DateTime();
    //Calculate the time difference between the two dates.
    $difference = $now->diff($dob);
    //Get the difference in years, as we are looking for the user's age.
    $age = $difference->y;
    //Print it out.
    return $age;
  }

  public function Getagebrief($userDob)
  {
    
    //Create a DateTime object using the user's date of birth.
    $dob = new \DateTime($userDob);
    //We need to compare the user's date of birth with today's date.
    $now = new \DateTime();
    //Calculate the time difference between the two dates.
    $difference = $now->diff($dob);
    
    //Get the difference in years, as we are looking for the user's age.
    $year = $difference->y;
    $month = $difference->m;
    $day = $difference->d;
    
    
    //Print it out.
    return $year." Years ".$month." Months ".$day." Days";
  }
  
  public function Numberwords($number)
  {
       //$number = 190908100.25;
       $no = round($number);
       $point = round($number - $no, 2) * 100;
       $hundred = null;
       $digits_1 = strlen($no);
       $i = 0;
       $str = array();
       $words = array('0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
       $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
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
    
    if($points == '')
    {
       return $result . "Rupees  " . $points;
    }     
    else
    {
      return $result . "Rupees  " . $points . "Paise";
    } 
    
  }

  //Ajax Calling
  public function actionAmtinwords($number)
  {
       //$number = 190908100.25;
       $no = round($number);
       $point = round($number - $no, 2) * 100;
       $hundred = null;
       $digits_1 = strlen($no);
       $i = 0;
       $str = array();
       $words = array('0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
       $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
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
    
    if($points == '')
    {
       return $result . "Rupees  " . $points;
    }     
    else
    {
      return $result . "Rupees  " . $points . "Paise";
    } 
    
  }

  

  public function actionSubvistreportpdf($id)
  {
    //$id=base64_decode(urldecode($id));
    
       if(is_numeric($id))
       {
          $id=$id;
       }
       else
       {
          $id=base64_decode(urldecode($id));
       }
    
    
    $subvisit=SubVisit::find()->where(['sub_id'=>$id])->one();
    //print_r($subvisit);die;
    if(!empty($subvisit))
    {
    
      
      $patientdata=Newpatient::find()->where(['patientid'=>$subvisit->pat_id])->one();
      
      $insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
      $physicianmaster=ArrayHelper::index(Physicianmaster::find()->asArray()->all(), 'id');
      $specialistdoctor=ArrayHelper::index(Specialistdoctor::find()->asArray()->all(), 's_id');
      $paymenttype=ArrayHelper::index(PaymentType::find()->asArray()->all(), 'payment_type_id');
      $patienttype=ArrayHelper::index(Patienttype::find()->asArray()->all(), 'type_id');  
      $userdata=BranchAdmin::find()->where(['ba_autoid'=>$subvisit->user_id])->one();
      
      if($subvisit['insurance_type'] == 1 && $subvisit['ucil_letter_status'] == 'YES')
      {
        $consultant_amount = (!empty($subvisit['due_amt'])) ? $subvisit['due_amt'] : '--NIL--';
      }
      else 
      {
        $consultant_amount = (!empty($subvisit['paid_amt'])) ? $subvisit['paid_amt'] : '--NIL--';
      }
      if(!empty($subvisit))
      {
        
        //Bill_number Getting
        $auto_get_sub=AutoidTable::find()->where(['auto'=>4])->asArray()->one();
        
        $inc_value_sub=$auto_get_sub['start_num']+1;
          $sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
        $valid_sub_number=AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 4]);
        
        
        require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
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
        <body>  <div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h2>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
        $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
        $tbl1.='<p style="border-top:1px solid #000;"></p>';
        $tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;"><u>SUB VIST RECEIPT</u></p>';
        
        
        
        $tbl1.='<table class="tablestyle" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" >';
        $tbl1.='<tr><table style="border:1px solid #000;padding:5px 10px;" ALIGN="left"><tr><td style="width:25%;"><b>BILL NO</b></td>';
        $tbl1.='<td style="width:25%;">'.$auto_get_sub['start_num'].'</td>';
        $tbl1.='<td style="width:25%;"><b>BILL DATE</b></td>';
        $tbl1.='<td style="width:25%;">'.date('d-m-Y H:i:s A').'</td>';
        $tbl1.='</tr>';
        
        $tbl1.='<tr><td><b>MR Number</b></td>';
        $tbl1.='<td>'.$patientdata['mr_no'].'</td>';
        $tbl1.='<td><b>SEX</b></td>';
        $tbl1.='<td>'.$patientdata['pat_sex'].'</td>';
        $tbl1.='</tr>';
        
        $tbl1.='<tr><td><b>SV NO</b></td>';
        $tbl1.='<td>'.$subvisit['sub_visit'].'</td>';
        $tbl1.='<td><b>AGE</b></td>';
        $tbl1.='<td>'.$this->Getagebrief($patientdata['dob']).'</td>';
        $tbl1.='</tr>';
        
        $tbl1.='<tr><td><b>PATIENT</b></td>';
        $tbl1.='<td>'.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].'</td>';
        $tbl1.='<td><b>PATIENT TYPE</b></td>';
        $tbl1.='<td>'.$patienttype[$subvisit['patient_type']]['patient_type'].'</td>';  
        $tbl1.='</tr>';
        
        
        
        $tbl1.='<tr><table style="border:1px solid #000; padding:5px 10px;" align="left">
        <tr>
        <td style="width:35%;"></td> 
        <td style="width:15%;"><b>DOCTOR :</b></td>
        <td style="width:35%;">'.$physicianmaster[$subvisit['consultant_doctor']]['physician_name'].'</td>
        <td style="width:15%;"></td></tr>
        <tr>
        <td style="width:35%;"></td> 
        <td style="width:15%;"><b>DEPARTMENT :</b></td>
        <td style="width:35%;"> '.$specialistdoctor[$subvisit['department']]['specialist'].'</td>
        <td style="width:15%;"></td></tr>
        </table>
        </tr>';
        
        
        $tbl1.='<tr><table Align="LEFT" style="border:1px solid #000;padding:5px 10px;">
          <tr><td style="width:50%;text-align:center">'.$userdata['ba_name'].'</td><td style="width:50%;text-align:center"><b>CONSULTATION :</b> '.$consultant_amount.'</td></tr>
          <tr><td style="width:50%;text-align:center"><b>Authorised</b></td><td style="width:50%;text-align:center"><b>TOTAL AMOUNT :</b> '.$consultant_amount.'</td></tr></table></tr></table>';
        $tbl1.='</div>';
        $tbl1.='</body></html>';
        $pdf->writeHTML($tbl1, true, false, false, false, '');
        
        
        if($subvisit['insurance_type'] == 1 && $subvisit['ucil_letter_status'] == 'YES')
        {
          
          $issue_date=date_create(date('Y-m-d',strtotime($subvisit['created_at'])));
            date_add($issue_date,date_interval_create_from_date_string("10 days"));
          $expired_date=date_format($issue_date,"Y-m-d");
          
          $pdf->AddPage();
          
          
          $tbl1='<html>
          <head>
          </head>
          <body>  <div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
          $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
          $tbl1.='<p style="border-top:1px solid #000;"></p>';
          $tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;"><u>ACKNOWLEDGEMENT SLIP</u></p>';
          $tbl1.='<table style="border:none;padding:2px 10px;font-size:12px;margin-top:250px;" ALIGN="left" ><tr><td style="width:15%;"><b>MR Number</b></td>';
          $tbl1.='<td style="width:35%;"> : '.$patientdata['mr_no'].' </td>';
          $tbl1.='<td style="width:23%;"><b> Register Date </b></td>';
          $tbl1.='<td style="width:35%;"> : '.date('d-m-Y H:i:A',strtotime($subvisit['created_at'])).'</td>';
          $tbl1.='</tr>';
          $tbl1.='<tr><td><b>Patient Name </b></td>';
          $tbl1.='<td> : '.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].' </td>';
          $tbl1.='<td><b> Reffer Issue</b></td>';
          $tbl1.='<td> : '.date('d-m-Y',strtotime($subvisit['ucil_date'])).'</td>';
          $tbl1.='</tr>';
          $tbl1.='<tr><td><b> UCIL ID</b></td>';
          $tbl1.='<td> : '.$subvisit['ucil_emp_id'].' </td>';
          $tbl1.='<td><b> Reffer Expired </b></td>';
          $tbl1.='<td> : '.date('d-m-Y',strtotime($expired_date)).'</td>';
          $tbl1.='</tr></table>';
          
          $tbl1.='<p></p><div style="text-align:center;font-size:16px;line-height:30px;text-transform: uppercase;"><span style="background-color: #aaa;border:1px solid #000;border:1px solid #000;padding:0 15px"><b>Valid for 10 Days</b></span></div>';
          
          $pdf->writeHTML($tbl1, true, false, false, false, '');
          $labincharge='Patient Signature';
          $verifiedby='Collection User Name';
          $pdf->SetXY(10,90,true);
          $pdf->Cell(100, 0, $labincharge, 0, 0);
            $pdf->SetXY(160,90,true);
          $pdf->Cell(100, 0, $verifiedby, 0, 0);
    
          $tbl1.='</body></html>';
        }
        
        
        
        
        
        
        $pdf->Output('SubVisit-Registeration.pdf');
        
        
      }
    }
  }


  //Refund Cancel Type
  public function actionCancelopd()
  {
    $newpatient=new Newpatient();
    $subvisit=new SubVisit();
    $cancellog=new CancelLogTable();
    
    if($_POST)
    {
      $session = Yii::$app->session;
      $role=$session['authUserRole'];
      $companybranchid=$session['branch_id'];  
      
      $auto_get_cancel=AutoidTable::find()->where(['auto'=>5])->asArray()->one();
      $inc_value_sub=$auto_get_cancel['start_num']+1;
        $can_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);
      $valid_cancel_number=AutoidTable::updateAll(['start_num' => $can_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 5]);
      
      
      $sub_visit=$_POST['subVisit_sub_visit'];
      $mr_number=$_POST['subVisit_mr_number'];
      $patient_name=$_POST['newpatient_patientname'];
      $patient_age=$_POST['newpatient_pat_age'];
      $patient_sex=$_POST['newpatient_pat_sex'];
      $physican_name=$_POST['subVisit_consultant_doctor'];
      $opd_type=$_POST['cancelLogTable_opd_type'];
      $new_amount=$_POST['subVisit_net_amt'];
      $cancel_amount=$_POST['cancelLogTable_cancel_amt'];
      $amt_in_words=$_POST['cancelLogTable_amt_words'];
      $paid_amount=$_POST['cancelLogTable_paid'];
      $cancelled_reason=$_POST['cancelLogTable_reason_cancelled'];
      $payment_mode=$_POST['SubVisit']['pay_mode'];
      
      //Cancel Type
      $cancelled_trans_type=$_POST['CancelLogTable']['cancel_trans_type'];
      $cancelled_cancel_type=$_POST['CancelLogTable']['cancel_type'];
      $cancelled_towards=$_POST['CancelLogTable']['towards'];
      $cancelled_refund_type=$_POST['CancelLogTable']['refund_type'];
      
      
      $subvisit_query=SubVisit::find()->where(['sub_visit'=>$sub_visit])->one();
      
      if(!empty($subvisit_query))
      {
        $subvisit_query->refund_status = 'YES';
        if($subvisit_query->save())
        {
          
          
          $cancellog->cancel_ran_id = $can_number;
          $cancellog->cancel_trans_type = $cancelled_trans_type;
          $cancellog->cancel_type = $cancelled_cancel_type;
          $cancellog->subvisitno = $sub_visit;
          $cancellog->mrnumber = $mr_number;
          $cancellog->opd_type = $opd_type;
          $cancellog->towards = $cancelled_towards;
          $cancellog->refund_type = $cancelled_refund_type;
          $cancellog->payment_mode = $payment_mode;
          $cancellog->doctor_fees = $new_amount;
          $cancellog->cancel_amt = $new_amount;
          $cancellog->amt_words = $amt_in_words;
          $cancellog->paid = $paid_amount;
          $cancellog->reason_cancelled = $cancelled_reason;
          $cancellog->created_at =date('Y-m-d H:i:s');
          $cancellog->ip_address =$_SERVER['REMOTE_ADDR'];
          $cancellog->user_id =$session['user_id'];
          if($cancellog->save())
          {
            
          }
          else 
          {
            print_r($cancellog->getErrors());die;
          } 
        }
      }
    }
    else 
    {
      $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
      $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
      
      $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
      
      $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
      
      $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
      
      return $this->render('cancelopd', [
              'subvisit' => $subvisit,
              'cancellog' => $cancellog,
              'newpatient' => $newpatient,
              'paymenttype' => $paymenttype,
              'physicianmaster' => $physicianmaster,
          ]);
    }
    
  }

  public function actionCancelkey($id) 
  {
    $query = new Query;
    $query  ->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.mr_no =sub_visit.mr_number')->where(['LIKE','newpatient.patientname',$id])->orWhere(['like','newpatient.pat_mobileno',$id])->orWhere(['LIKE','newpatient.mr_no',$id])->groupBy(['sub_visit.sub_id'])->orderBy(['sub_id'=>SORT_DESC])->limit(10)->all(); 
          
    $command = $query->createCommand();
    $un_send_data = $command->queryAll();
    
    $physicianmaster=ArrayHelper::map($un_send_data, 'sub_id', 'consultant_doctor');
    $doctor_name=Physicianmaster::find()->where(['IN','id',$physicianmaster])->asArray()->all();
    $physicianmaster_index=ArrayHelper::index($doctor_name, 'id');
    
    if(!empty($un_send_data))
    {
      $result_string='';
      foreach ($un_send_data as $key => $value) 
      {
        $result_string.='<tr><td>'.$value['sub_visit'].'</td>';
        $result_string.='<td>'.$value['pat_inital_name'].' '.$value['patientname'].'</td>';
        $result_string.='<td>'.$value['pat_mobileno'].'</td>';
        $result_string.='<td>'.$physicianmaster_index[$value['consultant_doctor']]['qualification'].'.'.$physicianmaster_index[$value['consultant_doctor']]['physician_name'].'</td>';
        $result_string.='<td>'.date('d-F-Y h:i A',strtotime($value['created_at'])).'</td>';
        if($value['refund_status'] == 'YES')
        {
            $result_string.='<td><button type="button" id="patient_data'.$value['sub_id'].'"  class="btn btn-xs btn-success" disabled title="Already Refund">Refunded</button></td><tr>';
        }
        else 
        {
             if($value['cons_status'] == 'N')
             {
              $result_string.='<td><button type="button" id="patient_data'.$value['sub_id'].'" onclick="Select_Patient('.$value['sub_id'].')" class="btn btn-xs btn-danger" title="Select">Select</button></td><tr>'; 
             }
             else 
             {
              $result_string.='<td><button type="button" id="patient_data'.$value['sub_id'].'" class="btn btn-xs btn-default" disabled title="Select">Free-Visit</button></td><tr>';
             }        
        }
      }
    }
    else 
    {
        $result_string.='<div class="text-center" style="color:red;font-size:20px;">No Records Found</div>';
    }
      
      return json_encode($result_string);
  }
  
  
  /*public function actionCancelsubvisit($subvisit) 
  {
    $query = new Query;
    $query  ->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.mr_no =sub_visit.mr_number')->where(['sub_visit.sub_visit'=>$subvisit])->andWhere(['sub_visit.cons_status'=>'N'])->andWhere(['sub_visit.refund_status'=>'NO'])->one(); 
          
    $command = $query->createCommand();
    $un_send_data = $command->queryAll();
    //print_r($un_send_data);die;
    $physicianmaster=ArrayHelper::map($un_send_data, 'sub_id', 'consultant_doctor');
    $doctor_name=Physicianmaster::find()->where(['IN','id',$physicianmaster])->asArray()->all();
    $physicianmaster_index=ArrayHelper::index($doctor_name, 'id');
    
    $fetch_array=array();
    if(!empty($un_send_data))
    {
      $fetch_array[0]=$un_send_data;
      $fetch_array[1]=$this->Getage($un_send_data[0]['dob']);
    }
    else 
    {
      $fetch_array[0]='F';  
    }
    
    $fetcharray[2]=$this->actionAmtinwords($un_send_data[0]['paid_amt']);
      
    return json_encode($fetch_array);
  }*/
  
  
  
  
  
  
  
  public function actionCancelpatientvalueset($id) 
  {
    $query = new Query;
    $query  ->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.mr_no =sub_visit.mr_number')->where(['sub_visit.sub_id'=>$id])->one(); 
          
    $command = $query->createCommand();
    $un_send_data = $command->queryAll();
    
    
    $insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
    
    $physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
    
    $specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
    
    $paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
    
    $patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
    
    if(!empty($un_send_data))
    {
      $sent_array=array();
      $sent_array[0]=$un_send_data;
      $sent_array[1]=$this->Getage($un_send_data[0]['dob']);
    
      return json_encode($sent_array);
    }
  }

  public function actionMailer($header,$body)
    {
     if( Yii::$app->mailer->compose()
          ->setFrom('albanbensam.istrides@gmail.com')
          ->setTo('kumarakalvas@gmail.com')  
          ->setSubject($header)
          ->setHtmlBody($body)      
          ->send())
        {
          
        }
     else {
       
     }
    
  }
}
