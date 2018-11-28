<?php

namespace backend\controllers;

use Yii;
use backend\models\InRegistration;
use backend\models\InRegistrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\AutoidTable;
use yii\filters\VerbFilter;
use backend\models\Patienttype;
use yii\helpers\ArrayHelper;
use backend\models\Physicianmaster;
use backend\models\InBedno;
use backend\models\InRoomtypes;
use backend\models\InRoomno;
use backend\models\InCategory;
use backend\models\InFloormaster;
use backend\models\SubVisit;
use backend\models\Insurance;
use backend\models\Newpatient;
use backend\models\InChangeroom;
use backend\models\BlockIpEntries;
use backend\models\InTreatmentOverall;
use backend\models\InTreatmentIndividual;
use backend\models\Treatment;
use backend\models\TaxgroupingLog;
use backend\models\InProcedureCancelation;
use backend\models\InProcCanIndividual;
use backend\models\InTreatmentOverallSearch;
use backend\models\BranchAdmin;
use backend\models\IpMoneyreceiptsLog;
use backend\models\IpMoneyreceipts;
use backend\models\InMedicalRecordingCharge;
use backend\models\InCategorygroup;
use backend\models\Specialistdoctor;
use yii\db\Query;
/**
 * InRegistrationController implements the CRUD actions for InRegistration model.
 */
class InRegistrationController extends Controller
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
     * Lists all InRegistration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InRegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInIndex()
    {
        $searchModel = new InTreatmentOverallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('in_treatmentindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single InRegistration model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViews($id)
    {
    	//echo "asd"; die;
    	$models = InTreatmentOverall::findOne($id);
		$treatment_list=InTreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
		//echo"<pre>";print_r($treatment_list); die;
        return $this->renderAjax('inview', [
            'model' =>$models,
            'treatment_list'=>$treatment_list,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InRegistration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	ini_set('memory_limit', '-1');
		$model = new InRegistration();
		$change_model = new InChangeroom();
		$money_log=new IpMoneyreceiptsLog();
		//$money_receipts=new IpMoneyreceiptsLog();
		//$category_group=InCategorygroup::find()->where(['is_active'=>1])->andwhere(['room_typeid'=>6])->asArray()->one();
		//print_r($category_group); die;
		
		$session = Yii::$app->session;
		$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		$medicalcharge=InMedicalRecordingCharge::find()->where(['autoid'=>1])->asArray()->one();
		$insurance=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		
		//
		$in_categorygroup=InCategorygroup::find()->where(['is_active'=>1])->all();
		$in_roomtypes_map=ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>1])->asArray()->all(),'autoid','room_types');
		$in_category_map=ArrayHelper::map(InCategory::find()->where(['is_active'=>1])->asArray()->all(),'autoid','category_name');
		
		
		if(!empty($in_categorygroup))
		{
			$room_type=array();
			foreach ($in_categorygroup as $key => $value)
			{
				$room_type[$value['autoid']]=$in_category_map[$value['category_id']].'/'.$in_roomtypes_map[$value['room_typeid']];
			}
		}
		
		if ($model->load(Yii::$app->request->post())) 
		{
			 
			$model1=InRegistration::find()->where(['mr_no'=>$_POST['InRegistration']['mr_no']])->andWhere(['is_active'=>1])->asArray()->one();
			
	    if(empty($model1))
	    {
	    	
			//print_r($_POST);die;
			$new_patient=Newpatient::find()->where(['mr_no'=>$_POST['InRegistration']['mr_no']])->asArray()->one();
		  if(!empty($new_patient))	
		  {
		  	if($new_patient['patientname'] == $_POST['InRegistration']['patient_name'])
			{
				$auto_get=AutoidTable::find()->where(['auto'=>13])->asArray()->one();
				if(!empty($auto_get))
				{
				   $inc_value=$auto_get['start_num']+1;
				   $rtno = str_pad($inc_value, 3, "0", STR_PAD_LEFT);
				   $valid_sub_number=AutoidTable::updateAll(['start_num' => $rtno,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 13]);
				}
				
				$bill_no=AutoidTable::find()->where(['auto'=>16])->asArray()->one();
				if(!empty($bill_no))
				{
				   $billinc=$bill_no['start_num']+1;
				   $bill_numval = str_pad($billinc, 8, "0", STR_PAD_LEFT);
				   $valid_sub_number=AutoidTable::updateAll(['start_num' => $bill_numval,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 16]);
				}
		
	        	$model->patient_type=$_POST['InRegistration']['patient_type'];
				$model->registered=$_POST['InRegistration']['registered'];
				$model->panel_type=$_POST['InRegistration']['panel_type'];
				$model->mr_no=$new_patient['mr_no'];
				$model->ip_no=$rtno;
				$model->bill_number=$bill_numval;
				$model->name_initial=$new_patient['pat_inital_name'];
				$model->patient_name=$new_patient['patientname'];
				$model->dob=date('Y-m-d',strtotime($new_patient['dob']));
				$model->sex	=$new_patient['pat_sex'];
				$model->marital_status=$new_patient['pat_marital_status'];
				$model->relation_suffix=$new_patient['pat_relation'];
				$model->relative_name=$new_patient['par_relationname'];
				$model->address=$new_patient['pat_address'];
				$model->city=$new_patient['pat_city'];
				$model->district=$new_patient['pat_distict'];
				$model->state=$new_patient['pat_state'];
				$model->pincode=$new_patient['pat_pincode'];
				$model->phone_no=$new_patient['pat_phone'];
				$model->mobile_no=$new_patient['pat_mobileno'];
				$model->country=$_POST['InRegistration']['country'];
				$model->religion=$_POST['InRegistration']['religion'];
				$model->type=$new_patient['pat_type'];
				
				$model->ins_type=$new_patient['insurance_type_id'];
				
				/*$model->refered_name=$_POST['InRegistration']['refered_name'];
				$model->ucil_from=$_POST['InRegistration']['ucil_from'];
				$model->ucil_to=$_POST['InRegistration']['ucil_to'];*/
				
				//$model->paytype=$_POST['InRegistration']['paytype'];
				//$model->bed_no	=$_POST['bedid'];
				
				//$model->room_no=$_POST['roomnoid'];
				//$model->floor_no=$_POST['floorid'];
				
				
				$model->category_type=$_POST['InRegistration']['category_type'];
				$model->floor_no=$_POST['InRegistration']['floor_no'];
				
				$model->room_type=$_POST['InRegistration']['room_type'];
				
				$model->consultant_dr=$_POST['InRegistration']['consultant_dr'];
				$model->dr_unit=$_POST['InRegistration']['dr_unit'];
				
				$model->speciality=$_POST['InRegistration']['speciality'];
				$model->co_consultant=$_POST['InRegistration']['co_consultant'];
				$model->diagnosis=$_POST['InRegistration']['diagnosis'];
				$model->remarks	=$_POST['InRegistration']['remarks'];
				$model->is_active=1;
				
				$model->created_date = date('Y-m-d H:i:s');
				$model->user_id = $session['user_id'];
				$model->userrole= $session['authUserRole'];
	         	$model ->ipaddress = $_SERVER['REMOTE_ADDR'];
		
			
				if($model ->save()){
					
					$money_log->mr_no=$_POST['InRegistration']['mr_no'];
					$money_log->ip_no=$rtno;
					$money_log->bill_number=$model->bill_number;
					$money_log->total_amt=$medicalcharge['amount'];
					$money_log->action="Registration";
					$money_log->created_date = date('Y-m-d H:i:s');
					$money_log->user_id = $session['user_id'];
					$money_log->ipaddress = $_SERVER['REMOTE_ADDR'];
					
					if($money_log->save()){
					}else{
						echo"<pre>"; print_r($money_log->getErrors()); die;
					}
					
					$category_group=InCategorygroup::find()->where(['is_active'=>1])->andwhere(['room_typeid'=>6])->asArray()->one();
					$moneyroom_log=new IpMoneyreceiptsLog();
					$moneyroom_log->mr_no=$_POST['InRegistration']['mr_no'];
					$moneyroom_log->ip_no=$rtno;
					$moneyroom_log->bill_number=$model->bill_number;
					$moneyroom_log->total_amt=$category_group['total'];
					$moneyroom_log->action="Room Charges";
					$moneyroom_log->created_date = date('Y-m-d H:i:s');
					$moneyroom_log->user_id = $session['user_id'];
					$moneyroom_log->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($moneyroom_log->save()){
						
					}else{
						
						echo"<pre>"; print_r($moneyroom_log->getErrors()); die;
					}
				
					
					
					$change_model->ip_no=$rtno;
					$change_model->mr_no=$_POST['InRegistration']['mr_no'];
					$change_model->paytype=$_POST['InRegistration']['paytype'];
					$change_model->roomtype	=$_POST['roomtypeid'];
					$change_model->roomno	=$_POST['roomnoid'];
					$change_model->floorno	=$_POST['floorid'];
					$change_model->unit	=$_POST['InRegistration']['dr_unit'];
					$change_model->bedno=$_POST['bedid'];
					$change_model->created_date = date('Y-m-d H:i:s');
					$change_model->user_id = $session['user_id'];
					$change_model->userrole= $session['authUserRole'];
	         		$change_model->ipaddress = $_SERVER['REMOTE_ADDR'];
					
					if($change_model->save())
					{
						$fetch_view[0]='Save';
						$fetch_view[1]=$rtno;
						$fetch_view[2]=$model->autoid;
						
						$myJSON = json_encode($fetch_view);
						return $myJSON;
					}
					else
					{
						echo"<pre>"; print_r($change_model->getErrors()); die;
					}
						
				 }
			}else{
				$fetch_view[0]='Mismatch';
				$myJSON = json_encode($fetch_view);
				return $myJSON;
			}
			}else{
				$fetch_view[0]='NotEntry';
				$myJSON = json_encode($fetch_view);
				return $myJSON;
			}
			
			}else{
				$fetch_view[0]='IPExpiry';
				$myJSON = json_encode($fetch_view);
				return $myJSON;
			}
        }
		else
		{
			//ini_set("memory_limit","128M");
			$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			//$Newpatient=Newpatient::find()->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			$ArrayHelper_patient=ArrayHelper::index($Newpatient,'patientid');
			$Newpatient_json=json_encode($ArrayHelper_patient);
			
		
			
			
			return $this->render('create', [
            'model' => $model,
            'patienttype'=>$patienttype,
            'physicianmaster' => $physicianmaster,
            'bed_list' => $bed_list,
            'Newpatient_json' => $Newpatient_json,
            'ArrayHelper_patient' => $ArrayHelper_patient,
            'specialistdoctor' => $specialistdoctor,
            'insurance' => $insurance,
            'room_type' => $room_type,
        ]);
				
		}
        
    }

    /**
     * Updates an existing InRegistration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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
	 
	 
 public function actionPatientPrint($id)
{

$modelz = new InRegistration();	
$salesdetail=$modelz->patientdetails($id);

}
    public function actionAjaxfetch()
    {
    	
		if(!empty($_POST['query']))
		{
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->andWhere(['LIKE','mr_no',$_POST['query']])->asArray()->all();
		
			if(!empty($Newpatient))
			{
				$fetch_array=array();
				foreach ($Newpatient as $key => $value) 
				{
					$fetch_array[]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
										'pat_inital_name'=>$value['pat_inital_name'],'dob' =>$value['dob'],'pat_sex'=>$value['pat_sex'],
										'pat_marital_status' => $value['pat_marital_status'],'pat_relation'=>$value['pat_relation'],
										'par_relationname'=>$value['par_relationname'],'pat_address'=>$value['pat_address'],
										'pat_city'=>$value['pat_city'],'pat_distict'=>$value['pat_distict'],'pat_state'=>$value['pat_state'],
										'pat_pincode'=>$value['pat_pincode'],'pat_phone'=>$value['pat_phone'],'pat_mobileno'=>$value['pat_mobileno'],
										'pat_email'=>$value['pat_email']);
				}
				return json_encode($fetch_array);
			}
		}
	}
	 
	  public function actionAjaxfetch1()
    {
    	
		if(!empty($_POST['query']))
		{
    		$Newpatient=InRegistration::find()->select(['autoid'=>'autoid','mr_no'=>'mr_no','patient_name'=>'patient_name',
			'name_initial'=>'name_initial','dob'=>'dob','sex'=>'sex','marital_status'=>'marital_status',
			'relative_name'=>'relative_name','address'=>'address',
			'city'=>'city','district'=>'district','state'=>'state','pincode'=>'pincode','ip_no'=>'ip_no','bed_no'=>'bed_no',
			'phone_no'=>'phone_no','mobile_no'=>'mobile_no'])
			//->where(['temporary_blocked'=>'N'])
			->where(['LIKE','mr_no',$_POST['query']])->asArray()->all();
	
			if(!empty($Newpatient))
			{
				$fetch_array=array();
				foreach ($Newpatient as $key => $value) 
				{
					$fetch_array[]=array('mr_no'=>$value['mr_no'],'patient_name'=>$value['patient_name'],
										'name_initial'=>$value['name_initial'],'dob' =>$value['dob'],'sex'=>$value['sex'],'ip_no'=>$value['ip_no'],'bed_no'=>$value['bed_no'],
										'marital_status' => $value['marital_status'],'relative_name'=>$value['relative_name'],
										'relative_name'=>$value['relative_name'],'address'=>$value['address'],
										'city'=>$value['city'],'distict'=>$value['distict'],'state'=>$value['state'],
										'pincode'=>$value['pincode'],'phone_no'=>$value['phone_no'],'mobile_no'=>$value['mobile_no']);
				}
				//echo "<pre>"; print_r($fetch_array); die;
				return json_encode($fetch_array);
			}
		}
	}
	 
	 
	
	public function actionAjaxsinglefetch($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email','insurance_type_id'=>'insurance_type_id','pat_type'=>'pat_type'])->where(['temporary_blocked'=>'N'])->andWhere(['mr_no'=>$id])->asArray()->one();
		
			if(!empty($Newpatient))
			{
				return json_encode($Newpatient);
			}
		}
	}


public function actionAjaxipnumberselect($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
		
			if(!empty($Newpatient))
			{
				return json_encode($Newpatient);
			}
		}
	}

	public function actionAjaxipnumberselectpay($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
			$ippaylog = IpMoneyreceiptsLog::find()->where(['ip_no'=>$id])->asArray()->all();
			$prev_ippay = IpMoneyreceipts::find()->where(['ip_no'=>$id])->asArray()->all();
			$amount=0;
			$prevamount=0;

			if(!empty($ippaylog)){
				foreach ($ippaylog as $key => $value) { 
					$amount += (int)$value['total_amt']; 
				}
			}
			if(!empty($prev_ippay)){
				foreach ($prev_ippay as $key => $values) { 
					$prevamount += (int)$values['amount']; 
				}//echo $amount; die;
			}
			$amounts = array('total_amount'=>$amount,'prev_amount'=>$prevamount);
			
			if(!empty($Newpatient))
			{
				$Newpatient_json[0] = $Newpatient;
				$Newpatient_json[1] = $amounts;
				return json_encode($Newpatient_json);
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
	public function actionAjaxsinglefetch1($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=InRegistration::find()->select(['autoid'=>'autoid','mr_no'=>'mr_no','patient_name'=>'patient_name',
			'name_initial'=>'name_initial','dob'=>'dob','sex'=>'sex','marital_status'=>'marital_status',
			'relative_name'=>'relative_name','address'=>'address',
			'city'=>'city','district'=>'district','state'=>'state','pincode'=>'pincode','ip_no'=>'ip_no','bed_no'=>'bed_no',
			'phone_no'=>'phone_no','mobile_no'=>'mobile_no'])
			//->where(['temporary_blocked'=>'N'])
			->where(['mr_no'=>$id])->asArray()->all();
		
			if(!empty($Newpatient))
			{
				//print_r($Newpatient); die;
				return json_encode($Newpatient[0]);
			}
		}
	}
	public function actionAjaxpatientinfo($id)
    {
    	if(!empty($id))
		{
			$mrnumber=Newpatient::find()->select(['mr_no'])->where(['patientid'=>$id])->andWhere(['temporary_blocked'=>"N"])->asArray()->one();
			$Newpatient=InRegistration::find()->select(['autoid'=>'autoid','mr_no'=>'mr_no','patient_name'=>'patient_name',
			'name_initial'=>'name_initial','dob'=>'dob','sex'=>'sex','marital_status'=>'marital_status',
			'relative_name'=>'relative_name','address'=>'address',
			'city'=>'city','district'=>'district','state'=>'state','pincode'=>'pincode','ip_no'=>'ip_no','bed_no'=>'bed_no',
			'phone_no'=>'phone_no','mobile_no'=>'mobile_no'])
			//->where(['temporary_blocked'=>'N'])
			->where(['mr_no'=>$mrnumber['mr_no']])->asArray()->all();
		
			if(!empty($Newpatient))
			{
				echo"<pre>"; print_r($Newpatient); die;
				return json_encode($Newpatient[0]);
				//print_r(json_encode($Newpatient)); die;
			}
		}
	}
	
	public function actionAjaxchangeroom($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=InRegistration::find()->select(['*'])->andWhere(['mr_no'=>$id])->asArray()->one();
//	echo"<pre>";print_r($Newpatient['created_date']); die;
		
			if(!empty($Newpatient))
			{
				return json_encode($Newpatient);
			}
		}
	}

	/*public function actionJqgrid()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid'])
    		->where(['temporary_blocked'=>'N'])
			//->andwhere(['like','patientname',$s_val])
			//->andwhere(['like','mr_nAo',$s_val])
			->andwhere(['or',
				['like','mr_no',$s_val],
				['like','patientname',$s_val],
				['like','par_relationname',$s_val]]
				)
			->limit(100000)
			->asArray()->all();
			//echo count($Newpatient); die;
			$Newpatient_da=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])
			->andwhere(['or',
				['like','mr_no',$s_val],
				['like','patientname',$s_val],
			    ['like','par_relationname',$s_val]]

				)
			->limit($length)
			->offset($sfd)->asArray()->all();

			$response='';
			
			if(!empty($Newpatient_da))
			{
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($Newpatient);
				foreach ($Newpatient_da as $key => $value) 
				{
					// $responce->rows[$i]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
													// 'par_relationname'=>$value['par_relationname'],'pat_mobileno'=>$value['pat_mobileno']);
					$responce['data'][]=array("mrno"=>$value['mr_no'],"pname"=>$value['patientname'],"rname"=>$value['par_relationname'],"mno"=>$value['pat_mobileno']);
					 										
					$i++;
				}
			
				
				
			}
			//echo"<pre>";print_r(json_encode($responce)); die;
			return json_encode($responce);
			die;
	}*/
	
	
	
	
	
	public function actionJqgrid()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid'])
    		->where(['temporary_blocked'=>'N'])
			//->andwhere(['like','patientname',$s_val])
			//->andwhere(['like','mr_nAo',$s_val])
			->andwhere(['or',
				['like','mr_no',$s_val],
				['like','patientname',$s_val],
				['like','par_relationname',$s_val]]
				)
			->limit(100000)
			->orderBy(['patientid'=>SORT_DESC])->asArray()->all();
			//echo count($Newpatient); die;
			$Newpatient_da=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])
			->andwhere(['or',
				['like','mr_no',$s_val],
				['like','patientname',$s_val],
			    ['like','par_relationname',$s_val]]

				)
			->limit($length)
			->offset($sfd)->orderBy(['patientid'=>SORT_DESC])->asArray()->all();

			$response='';
			
			if(!empty($Newpatient_da))
			{
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($Newpatient);
				foreach ($Newpatient_da as $key => $value) 
				{
					// $responce->rows[$i]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
													// 'par_relationname'=>$value['par_relationname'],'pat_mobileno'=>$value['pat_mobileno']);
					$responce['data'][]=array("DT_RowId"=>$value['patientid'],"mrno"=>$value['mr_no'],"pname"=>$value['patientname'],"rname"=>$value['par_relationname'],"mno"=>$value['pat_mobileno']);
					 										
					$i++;
				}
			
				
				
			}

			return json_encode($responce);
			die;
	}
	
	
	public function actionInjqgrid()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
    		$Newpatient=InRegistration::find()->select(['autoid'=>'autoid'])
    		//->where(['temporary_blocked'=>'N'])
			//->andwhere(['like','patientname',$s_val])
			//->andwhere(['like','mr_nAo',$s_val])
			->where(['or',
				['like','mr_no',$s_val],
				['like','ip_no',$s_val],
				['like','patient_name',$s_val],
				['like','relative_name',$s_val]]
				)
			->limit(100000)
			->orderBy(['autoid'=>SORT_DESC])->asArray()->all();
			//echo count($Newpatient); die;
			$Newpatient_da=InRegistration::find()->select(['autoid'=>'autoid','ip_no'=>'ip_no','mr_no'=>'mr_no','patient_name'=>'patient_name',
			'name_initial'=>'name_initial','dob'=>'dob','sex'=>'sex','marital_status'=>'marital_status',
			'relation_suffix'=>'relation_suffix','relative_name'=>'relative_name','address'=>'address',
			'city'=>'city','district'=>'district','state'=>'state','pincode'=>'pincode',
			'phone_no'=>'phone_no','mobile_no'=>'mobile_no'])
			//->where(['temporary_blocked'=>'N'])
			->where(['or',
				['like','ip_no',$s_val],
				['like','patient_name',$s_val],
			    ['like','relative_name',$s_val]]

				)
			->limit($length)
			->offset($sfd)->orderBy(['autoid'=>SORT_DESC])->asArray()->all();

			$response='';
			
			if(!empty($Newpatient_da))
			{
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($Newpatient);
				foreach ($Newpatient_da as $key => $value) 
				{
					// $responce->rows[$i]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
													// 'par_relationname'=>$value['par_relationname'],'pat_mobileno'=>$value['pat_mobileno']);
					$responce['data'][]=array("DT_RowId"=>$value['autoid'],"ipno"=>$value['ip_no'],"mrno"=>$value['mr_no'],"pname"=>$value['patient_name'],"rname"=>$value['relative_name'],"mno"=>$value['mobile_no']);
					 										
					$i++;
				}
			
				
				
			}

			return json_encode($responce);
			die;
	}
	/*public function actionBednofetch()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}

			//$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
			$query = new Query;
			$query	->select([
        'in_bedno.bedno'])  
        ->from('in_bedno')
        ->join('LEFT OUTER JOIN', 'in_roomno',
            'in_bedno.room_id =in_roomno.autoid')		
        ->join('LEFT OUTER JOIN', 'in_roomtypes', 
            'in_roomno.roomtypeid =in_roomtypes.autoid')
		->where(['or',
		['like','in_bedno.bedno',$s_val],
		['like','in_roomno.room_no',$s_val],
		['like','in_roomtypes.room_types',$s_val],
		['like','in_roomtypes.price',$s_val]]
		)
        ->limit(100000)->all(); 
		
		$command = $query->createCommand();
		$data = $command->queryAll();
		
		$query1 = new Query;
		$query1	->select([
        'in_bedno.autoid','in_bedno.bedno','in_roomno.room_no','in_roomtypes.room_types','in_roomtypes.price']
        )  
        ->from('in_bedno')
        ->join('LEFT OUTER JOIN', 'in_roomno',
            'in_bedno.room_id =in_roomno.autoid')		
        ->join('LEFT OUTER JOIN', 'in_roomtypes', 
            'in_roomno.roomtypeid =in_roomtypes.autoid')
		->where(['or',
		['like','in_bedno.bedno',$s_val],
		['like','in_roomno.room_no',$s_val],
		['like','in_roomtypes.room_types',$s_val],
		['like','in_roomtypes.price',$s_val]]
		)
        ->limit($length)->offset($sfd)->all(); 
		
		$command1 = $query1->createCommand();
		$data1 = $command1->queryAll();
		
		$response='';
			
		if(!empty($data1))
		{
			$fetch_array=array();
			$responce['draw']=$draw;
			$responce['recordsTotal']= $length;
			$responce['recordsFiltered']= count($data);
			foreach ($data1 as $key => $value) 
			{
				$responce['data'][]=array("DT_RowId"=>$value['autoid'],"bedno"=>$value['bedno'],"room_no"=>$value['room_no'],"room_types"=>$value['room_types'],"price"=>$value['price']);
			}
		}

		return json_encode($responce);
		die;
	}*/
	
	
	public function actionRoomtypefetch()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}

			//$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
			$query = new Query;
			$query	->select([
        'in_categorygroup.autoid','in_categorygroup.category_id','in_categorygroup.room_typeid','in_categorygroup.total'])  
        ->from('in_categorygroup')
        ->join('LEFT OUTER JOIN', 'in_category',
            'in_categorygroup.category_id =in_category.autoid')		
        ->join('LEFT OUTER JOIN', 'in_roomtypes', 
            'in_categorygroup.room_typeid =in_roomtypes.autoid')
		->where(['or',
		
		['like','in_category.category_name',$s_val],
		['like','in_roomtypes.room_types',$s_val],
		['like','in_categorygroup.total',$s_val]]
		)
        ->limit(100000)->all(); 
		
		$command = $query->createCommand();
		$data = $command->queryAll();
		
		$query1 = new Query;
		$query1	->select([
        'in_categorygroup.autoid','in_categorygroup.category_id','in_categorygroup.room_typeid','in_categorygroup.total',
        'in_category.category_name','in_roomtypes.room_types'
        ])  
        ->from('in_categorygroup')
        ->join('LEFT OUTER JOIN', 'in_category',
            'in_categorygroup.category_id =in_category.autoid')		
        ->join('LEFT OUTER JOIN', 'in_roomtypes', 
            'in_categorygroup.room_typeid =in_roomtypes.autoid')
		->where(['or',
		
		['like','in_category.category_name',$s_val],
		['like','in_roomtypes.room_types',$s_val],
		['like','in_categorygroup.total',$s_val]]
		)
        ->limit($length)->offset($sfd)->all(); 
		
		$command1 = $query1->createCommand();
		$data1 = $command1->queryAll();
		
		$response='';
			
		if(!empty($data1))
		{
			$fetch_array=array();
			$responce['draw']=$draw;
			$responce['recordsTotal']= $length;
			$responce['recordsFiltered']= count($data);
			foreach ($data1 as $key => $value) 
			{
				$responce['data'][]=array("DT_RowId"=>$value['autoid'],"category_type"=>$value['category_name'],"room_type"=>$value['room_types'],"total"=>$value['total']);
			}
		}
//echo '<pre>';
	//	print_r($data1);die;
		return json_encode($responce);
		die;
	}
	
	public function actionDoctorfetch()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0")
    	{
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!="")
		{
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!="")
		{
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search']))
		{
		  $s_val=$_POST['search']['value'];
		}

		
		$physicianmaster_count=Physicianmaster::find()->select(['id'=>'id','physician_name'=>'physician_name'])->where(['is_active'=>'1'])
		->andWhere(['or',['like','physician_name',$s_val]])
		->limit(100000)->asArray()->all();
		
		$physicianmaster=Physicianmaster::find()->select(['id'=>'id','physician_name'=>'physician_name'])->where(['is_active'=>'1'])
		->andWhere(['or',['like','physician_name',$s_val]])
		->limit($length)->offset($sfd)->asArray()->all();
		
		
		
		
		$response='';
			
		if(!empty($physicianmaster))
		{
			$fetch_array=array();
			$responce['draw']=$draw;
			$responce['recordsTotal']= $length;
			$responce['recordsFiltered']= count($physicianmaster_count);
			foreach ($physicianmaster as $key => $value) 
			{
				$responce['data'][]=array("DT_RowId"=>$value['id'],"doctorname"=>$value['physician_name']);
			}
		}

		return json_encode($responce);
		die;
	}


	public function actionUnitconsultant()
    {
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0")
    	{
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!="")
		{
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!="")
		{
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search']))
		{
		  $s_val=$_POST['search']['value'];
		}

		
		$query = new Query;
		$query	->select([
        'physicianmaster.id','physicianmaster.physician_name','specialistdoctor.s_id','specialistdoctor.specialist'])  
        ->from('physicianmaster')
        ->join('LEFT OUTER JOIN', 'specialistdoctor',
            'physicianmaster.specialist =specialistdoctor.s_id')		
        ->where(['physicianmaster.is_active'=>'1'])
        ->andWhere(['or',
		['like','physicianmaster.physician_name',$s_val],
		['like','specialistdoctor.specialist',$s_val]]
		)
        ->limit(100000)->all(); 
		
		$command = $query->createCommand();
		$data = $command->queryAll();
		
		$query1 = new Query;
		$query1	->select([
        'physicianmaster.id','physicianmaster.physician_name','specialistdoctor.s_id','specialistdoctor.specialist'])  
        ->from('physicianmaster')
        ->join('LEFT OUTER JOIN', 'specialistdoctor',
            'physicianmaster.specialist =specialistdoctor.s_id')		
        ->where(['physicianmaster.is_active'=>'1'])
        ->andWhere(['or',
		['like','physicianmaster.physician_name',$s_val],
		['like','specialistdoctor.specialist',$s_val]]
		)
       ->limit($length)->offset($sfd)->all(); 
		
		$command1 = $query1->createCommand();
		$data1 = $command1->queryAll();
		
		
		
		$response='';
			
		if(!empty($data1))
		{
			$fetch_array=array();
			$responce['draw']=$draw;
			$responce['recordsTotal']= $length;
			$responce['recordsFiltered']= count($data);
			foreach ($data1 as $key => $value) 
			{
				$responce['data'][]=array("DT_RowId"=>$value['id'].'_'.$value['s_id'],"doctorname"=>$value['physician_name'],"specialist"=>$value['specialist']);
			}
		}

		return json_encode($responce);
		die;
	}
	
	
	public function actionUnitdoctorfetch($id)
	{
		
		return json_encode($fetch_array);
	}
	
	
	/*public function actionBednogrid($id)
	{
		$in_bedno=InBedno::find()->where(['autoid'=>$id])->asArray()->one();
		
		$in_roomno=InRoomno::find()->where(['autoid'=>$in_bedno['room_id']])->asArray()->one();
		
		$in_roomno_types=InRoomtypes::find()->where(['autoid'=>$in_roomno['roomtypeid']])->asArray()->one();
		
		$in_floormaster=InFloormaster::find()->where(['autoid'=>$in_roomno['floorid']])->asArray()->one();
		
		$fetch_array=array();
		$fetch_array[0]=$in_bedno;
		$fetch_array[1]=$in_roomno;
		$fetch_array[2]=$in_roomno_types;
		$fetch_array[3]=$in_floormaster;
		
		return json_encode($fetch_array);
	}*/
	
	public function actionCategorygrid($id)
	{
		
		$in_roomtypes_map=ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>1])->asArray()->all(),'autoid','room_types');
		$in_category_map=ArrayHelper::map(InCategory::find()->where(['is_active'=>1])->asArray()->all(),'autoid','category_name');
		
		$in_categorygroup= InCategorygroup::find()->where(['autoid'=>$id])->asArray()->one();
		
		$fetch_array=array();
		$fetch_array[0]=$id;
		$fetch_array[1]=$in_roomtypes_map[$in_categorygroup['room_typeid']];
		$fetch_array[2]='FIRST FLOOR';
		
		
		return json_encode($fetch_array,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
	
	
	
	public function actionCrbednogrid($id)
	{
		$in_bedno=InBedno::find()->where(['autoid'=>$id])->asArray()->one();
		
		$in_roomno=InRoomno::find()->where(['autoid'=>$in_bedno['room_id']])->asArray()->one();
		
		$in_roomno_types=InRoomtypes::find()->where(['autoid'=>$in_roomno['roomtypeid']])->asArray()->one();
		
		$in_floormaster=InFloormaster::find()->where(['autoid'=>$in_roomno['floorid']])->asArray()->one();
		
		$fetch_array=array();
		$fetch_array[0]=$in_bedno;
		$fetch_array[1]=$in_roomno;
		$fetch_array[2]=$in_roomno_types;
		$fetch_array[3]=$in_floormaster;
		
		return json_encode($fetch_array);
		
		
	}
	public function actionIpgrid()
    {
    	
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
    		$inpatient=InRegistration::find()->select(['autoid'=>'autoid'])
    		->where(['is_active'=>'1'])
			->andwhere(['or',
				['like','ip_no',$s_val],			
				['like','mr_no',$s_val],
				['like','patient_name',$s_val],
				['like','relative_name',$s_val]]
				)
			->limit(100000)
			->asArray()->all();
			//echo count($Newpatient); die;
			$inpatient_da=InRegistration::find()->select(['*'])->where(['is_active'=>'1'])
			->andwhere(['or',
				['like','ip_no',$s_val],
				['like','mr_no',$s_val],
				['like','patient_name',$s_val],
			    ['like','relative_name',$s_val]]
				)
			->limit($length)
			->offset($sfd)->asArray()->all();
			$response='';
			
			if(!empty($inpatient_da))
			{
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($inpatient);
				foreach ($inpatient_da as $key => $value) 
				{
					$responce['data'][]=array("ipno"=>$value['ip_no'],"mrno"=>$value['mr_no'],"pname"=>$value['patient_name'],"rname"=>$value['relative_name'],"mno"=>$value['mobile_no']);
					 										
					$i++;
				}
			}
		//	echo"<pre>";print_r(json_encode($responce)); die;
			return json_encode($responce);
			die;
	}
	
	
	 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$session = Yii::$app->session;
		$patienttype=ArrayHelper::map(PatientType::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		 
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		$medicalcharge=InMedicalRecordingCharge::find()->where(['autoid'=>1])->asArray()->one();
		

        if ($model->load(Yii::$app->request->post())) {
        	$model->patient_type=$_POST['InRegistration']['patient_type'];
			$model->registered=$_POST['InRegistration']['registered'];
			$model->panel_type=$_POST['InRegistration']['panel_type'];
			$model->mr_no=$_POST['InRegistration']['mr_no'];
			$model->ip_no=$_POST['InRegistration']['ip_no'];
			$model->name_initial=$_POST['InRegistration']['name_initial'];
			$model->patient_name=$_POST['InRegistration']['patient_name'];
			$model->dob=$_POST['InRegistration']['dob'];
			$model->sex	=$_POST['InRegistration']['sex'];
			$model->marital_status=$_POST['InRegistration']['marital_status'];
			$model->relation_suffix=$_POST['InRegistration']['relation_suffix'];
			$model->relative_name=$_POST['InRegistration']['relative_name'];
			$model->address=$_POST['InRegistration']['address'];
			$model->city=$_POST['InRegistration']['city'];
			$model->district=$_POST['InRegistration']['district'];
			$model->state=$_POST['InRegistration']['state'];
			$model->pincode=$_POST['InRegistration']['pincode'];
			$model->phone_no=$_POST['InRegistration']['phone_no'];
			$model->mobile_no=$_POST['InRegistration']['mobile_no'];
			$model->country=$_POST['InRegistration']['country'];
			$model->religion=$_POST['InRegistration']['religion'];
			$model->type=$_POST['InRegistration']['type'];
			$model->paytype=$_POST['InRegistration']['paytype'];
			$model->bed_no	=$_POST['InRegistration']['bed_no'];
			$model->room_no=$_POST['InRegistration']['room_no'];
			$model->floor_no=$_POST['InRegistration']['floor_no'];
			$model->room_type=$_POST['InRegistration']['room_type'];
			$model->consultant_dr=$_POST['InRegistration']['consultant_dr'];
			$model->dr_unit=$_POST['InRegistration']['dr_unit'];
			$model->speciality=$_POST['InRegistration']['speciality'];
			$model->co_consultant=$_POST['InRegistration']['co_consultant'];
			$model->diagnosis=$_POST['InRegistration']['diagnosis'];
			$model->remarks	=$_POST['InRegistration']['remarks'];
			$model->is_active=$_POST['InRegistration']['is_active'];
			
			$model->updated_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> userrole= $session['authUserRole'];
         	$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			
            return $this->redirect(['view', 'id' => $model->autoid]);
        }

        return $this->render('update', [
          
             'model' => $model,
            'patienttype'=>$patienttype,
            'physicianmaster' => $physicianmaster,
            'bed_list' => $bed_list,
            'Newpatient_json' => $Newpatient_json,
            'ArrayHelper_patient' => $ArrayHelper_patient,
        ]);
    }

    /**
     * Deletes an existing InRegistration model.
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
     * Finds the InRegistration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InRegistration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InRegistration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionMrNumberFetch($id)
    {
        
		$last_visiting=SubVisit::find()->where(['mr_number'=>$id])->andWhere(['refund_status'=>'NO'])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
		$insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		
		$fetch_array=array();
		if(!empty($last_visiting))
		{
			//New Patient
			$new_patient=Newpatient::find()->where(['patientid'=>$last_visiting['pat_id']])->asArray()->one();
			$fetch_array[0]='Set';
			$fetch_array[1]=$last_visiting;
			$fetch_array[2]=$new_patient;
			$fetch_array[3]=date('d-m-Y',strtotime($last_visiting['created_at']));
			
			$myJSON = json_encode($fetch_array);
		}
		else
		{
			$fetch_array[0]='Empty';
			$myJSON = json_encode($fetch_array);
		}
		
		return $myJSON;
    }
	
	
	public function actionIpfetchmrnumber($id)
    {
    	$new_patient=Newpatient::find()->where(['patientid'=>$id])->asArray()->one();
		if(!empty($new_patient))
		{
			$fetch_array=array();
			$fetch_array[0]=$new_patient;
			
			return json_encode($fetch_array);
		}
	}

	public function actionLabipfetchmrnumber($id)
    {
    	$new_patient=Newpatient::find()->where(['patientid'=>$id])->asArray()->one();
		if(!empty($new_patient))
		{
			$phy = Physicianmaster::find()->where(['id'=>$new_patient['doctor_name']])->asArray()->one();
			if($phy){
				$ins['doctor']=$phy['physician_name'];
			}
			$Insurance = Insurance::find()->where(['insurance_typeid'=>$new_patient['insurance_type_id']])->asArray()->one();
			if($Insurance){
				$ins['insurancetype']=$Insurance['insurance_type'];
			}
			echo "<pre>"; 
			$fetch_array=array();
			$fetch_array[0]=$new_patient;
			$fetch_array[1]=$ins['doctor'];
			$fetch_array[2]=$ins['insurancetype'];
			 print_r($fetch_array); die;
			return json_encode($fetch_array);
		}
	}
	
	public function actionInipfetchmrnumber($id)
    {
    	$new_patient=InRegistration::find()->where(['autoid'=>$id])->asArray()->one();
		if(!empty($new_patient))
		{
			//echo"<pre>";
			$insurance=Insurance::find()->where(['insurance_typeid'=>$new_patient['type']])->andWhere(['is_active'=>1])->one();
			
			$fetch_array=array();
			$fetch_array[0]=$new_patient;
			$fetch_array[1]=$insurance['insurance_type'];
			//print_r($fetch_array);die;
			return json_encode($fetch_array);
		}
	}
	
	
	
	public function actionChangeroomupdate($id){
		$regmodel =InRegistration::find()->where(['mr_no'=>$id])->one();
		$change_model = new InChangeroom();
        $session = Yii::$app->session;
		
		if (Yii::$app->request->post()) {
			// echo"<pre>"; // print_r($regmodel['paytype']); die;  
			$change_model->ip_no=$_POST['InRegistration']['ip_no'];
			$change_model->paytype=$_POST['current_paytype'];
			$change_model->mr_no=$_POST['InRegistration']['mr_no'];
			$change_model->roomtype	=$_POST['current_room_type'];
			$change_model->roomno=$_POST['current_room_no'];
			$change_model->floorno=$_POST['current_floor_no'];
			$change_model->unit	=$_POST['current_dr_unit'];
			$change_model->bedno=$_POST['current_bed_no'];
			
			$change_model->created_date = date('Y-m-d H:i:s');
			$change_model->user_id = $session['user_id'];
			$change_model->userrole= $session['authUserRole'];
         	$change_model ->ipaddress = $_SERVER['REMOTE_ADDR'];
			
			if($change_model ->save()){
				$regmodel->paytype=$_POST['current_paytype'];
				$regmodel->bed_no=$_POST['current_bed_no'];
				$regmodel->room_no=$_POST['current_room_no'];
				$regmodel->floor_no=$_POST['current_floor_no'];
				$regmodel->room_type=$_POST['current_room_type'];
				$regmodel->dr_unit=$_POST['current_dr_unit'];
			if($regmodel->save()){
				  print_r("1");
				}else{
					print_r("0");
				} 
			
			}				
			else{
				echo"0";
			}	
		}
	}
	
	public function actionChangeRoom()
    {
    	$model = new InRegistration();
        $session = Yii::$app->session;
		$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		$inregistration_det=InRegistration::find()->where(['is_active'=>1])->asArray()->all();
		
		
		if ($model->load(Yii::$app->request->post())) {
			echo"<pre>"; print_r($inregistration_det); die;		
			
		}
		else{
			$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->asArray()->all();

			$ArrayHelper_patient=ArrayHelper::index($Newpatient,'patientid');
			$Newpatient_json=json_encode($ArrayHelper_patient);
		
			
		return $this->render('changeroom', [
            	'model' => $model,
            	'patienttype'=>$patienttype,
            	'physicianmaster' => $physicianmaster,
            	'bed_list' => $bed_list,
            	'Newpatient_json' => $Newpatient_json,
            	'ArrayHelper_patient' => $ArrayHelper_patient,
        	]);	
			
		}	
	       //print_r('CHANGE ROOM STD PENDING');	die;
    }
	
	public function actionIpprocedurecancel()
    {
        print_r('IP Procedure Cancellation STD Pending');
		die;
    }

	/*public function actionIpprocedure()
    {
        $model = new InTreatmentOverall();
		$newpatient= new Newpatient();
		$treatmentindividual= new InTreatmentIndividual();
		
		 $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post())) 
        {
        	// /echo"<pre>";  print_r($_POST); die;
			$total_cgst_pre=array_sum($_POST['InTreatmentIndividual']['cgst_percent']);
			$total_sgst_pre=array_sum($_POST['InTreatmentIndividual']['sgst_percent']);
			$total_cgst=array_sum($_POST['InTreatmentIndividual']['cgst_value']);
			$total_sgst=array_sum($_POST['InTreatmentIndividual']['sgst_value']);
			//$subvisit_post=SubVisit::find()->where(['sub_id'=>Yii::$app->request->post('SUBVISITID')])->asArray()->one();
			$in_registration=InRegistration::find()->where(['ip_no'=>Yii::$app->request->post(['InTreatmentOverall']['ip_no'])])->asArray()->one();
			$newpatient_post=Newpatient::find()->where(['patientid'=>$subvisit_post['pat_id']])->asArray()->one();
			$auto_get_sub=AutoidTable::find()->where(['auto'=>12])->asArray()->one();
			$inc_value_sub=$auto_get_sub['start_num']+1;
		   	$sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);

		   	//Cancel No Auto Increment
		   	$auto_get_op=AutoidTable::find()->where(['auto'=>14])->asArray()->one();
			$inc_value_op=$auto_get_op['start_num']+1;
		   	$sub_op = str_pad($inc_value_op, 6, "0", STR_PAD_LEFT);
			//print_r($newpatient_post);
			//print_r($in_registration); die;
			if(!empty($in_registration))
			{  
				$model->refund_status='NO';
				$model->name=$newpatient_post['patientname'];
				$model->dob=date('Y-m-d',strtotime($newpatient_post['dob']));
				$model->gender=$newpatient_post['sex'];
				$model->physicianname=$in_registration['consultant_dr'];
				$model->mrnumber=$in_registration['mr_no'];
				$model->patient_id=$in_registration['pat_id'];
				$model->subvisit_id=$in_registration['autoid'];
				$model->subvisit_num=$in_registration['ip_no'];
				//$model->insurancetype=$in_registration['insurance_type'];
				$model->address=$newpatient_post['pat_address'];
				$model->phonenumber=$newpatient_post['pat_phone'];
				$model->billnumber=$auto_get_sub['start_num'];
				$model->invoicedate=date('Y-m-d H:i:s');
				//$model->total=0;
				$model->total=Yii::$app->request->post('InTreatmentOverall')['overall_sub_total'];
				$model->tot_no_of_items=count(Yii::$app->request->post('treatmentprimeid'));
				$model->tot_quantity=Yii::$app->request->post('InTreatmentOverall')['tot_quantity'];
				$model->total_gst_percent=Yii::$app->request->post('InTreatmentOverall')['total_gst_percent'];
				$model->total_cgst_percent=$total_cgst_pre;
				$model->total_sgst_percent=$total_sgst_pre;
				$model->totalgstvalue=Yii::$app->request->post('InTreatmentOverall')['totalgstvalue'];
				$model->totalcgstvalue=$total_cgst;
				$model->totalsgstvalue=$total_sgst;
				$model->subtotval=$_POST['total_subvalue'];
				$model->overalldiscountpercent=Yii::$app->request->post('InTreatmentOverall')['overalldiscountpercent'];
				$model->overalldiscountamount=Yii::$app->request->post('InTreatmentOverall')['overalldiscountamount'];
				$model->overall_due_amount=Yii::$app->request->post('InTreatmentOverall')['overall_due_amount'];
				$model->overall_sub_total=(Yii::$app->request->post('InTreatmentOverall')['overall_sub_total'] );
				$model->overall_net_amount=Yii::$app->request->post('InTreatmentOverall')['overall_net_amount'];
				$model->overalltotal=Yii::$app->request->post('InTreatmentOverall')['overalltotal'];
				$model->remarks=Yii::$app->request->post('InTreatmentOverall')['remarks'];
				$model->discount_authority=Yii::$app->request->post('InTreatmentOverall')['discount_authority'];
				$model->user_id=$session['user_id'];
				$model->user_role=$session['authUserRole'];
				$model->created_at=date('Y-m-d H:i:s');
				$model->ipaddress=$_SERVER['REMOTE_ADDR'];
				//print_r($model); die;
				if($model->save())
				{
					AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 12]);

					AutoidTable::updateAll(['start_num' => $sub_op,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 14]);
					
					$data=array();
					foreach ($_POST['treatmentprimeid'] as $key => $value) 
					{
						$data[]=[$model->id,'NO',$_POST['treatmentprimeid'][$key],$_POST['InTreatmentIndividual']['qty'][$key],$_POST['InTreatmentIndividual']['rate'][$key],$_POST['InTreatmentIndividual']['rate'][$key],($_POST['InTreatmentIndividual']['cgst_percent'][$key]+$_POST['InTreatmentIndividual']['sgst_percent'][$key]),($_POST['InTreatmentIndividual']['cgst_value'][$key]+$_POST['InTreatmentIndividual']['sgst_value'][$key]),$_POST['InTreatmentIndividual']['cgst_percent'][$key],$_POST['InTreatmentIndividual']['sgst_percent'][$key],$_POST['InTreatmentIndividual']['cgst_value'][$key],$_POST['InTreatmentIndividual']['sgst_value'][$key],$_POST['InTreatmentIndividual']['discountvalue'][$key],$_POST['InTreatmentIndividual']['discount_percent'][$key],$_POST['InTreatmentIndividual']['total_price'][$key],$session['user_id'],$session['authUserRole'],$_SERVER['REMOTE_ADDR'],date('Y-m-d H:i:s')];
					}
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('in_treatment_individual', ['treat_ove_id','return_status', 'treatment_id','qty','rate','mrp','gstpercent','gstvalue','cgst_percent','cgst_value','sgst_percent','sgst_value','discountvalue','discount_percent','total_price','user_id','user_role','ipaddress','created_at'],$data)->execute();
					return 'S';
				}
				else {
						print_r($model->getErrors());die;	
				}
				
			} 
        } 
        else 
        {
        	
			//Sub Visit
			$today_visiting=SubVisit::find()->where(['date(created_at)'=>date('Y-m-d')])->andWhere(['refund_status'=>'NO'])->asArray()->all();
			$insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
			$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
			if(!empty($today_visiting))
			{
				$subvisit_map=ArrayHelper::map($today_visiting,'sub_id','mr_number');
				$subvisit_index=ArrayHelper::index($today_visiting,'sub_id');
				$subvisit_json=json_encode($subvisit_index);
				//New Patient
				$new_patient=Newpatient::find()->where(['IN','mr_no',$subvisit_map])->asArray()->all();
				$new_patient_index=ArrayHelper::index($new_patient,'mr_no');
				$new_patient_json=json_encode($new_patient_index);
			}
			
			$treatment=Treatment::find()->where(['is_active'=>1])->all();
			$hsn_code_map=ArrayHelper::map($treatment,'hsn_code','hsn_code');
			$tax_grouping_log=TaxgroupingLog::find()->where(['IN','taxgroupid',$hsn_code_map])->andWhere(['is_active'=>1])->asArray()->all();
			$tax_grouping_log_index=ArrayHelper::index($tax_grouping_log,'taxgroupid');
			$tax_grouping_log_index_json=json_encode($tax_grouping_log_index);
			
			
            return $this->render('ipprocedure_overall', [
                'model' => $model,
                'newpatient' => $newpatient,
                'new_patient_json' => $new_patient_json,
                'subvisit_json' => $subvisit_json,
                'subvisit_map' => $subvisit_map,
                'insurancelist' => $insurancelist,
                'today_visiting' => $today_visiting,
                'new_patient_index' => $new_patient_index,
                'physicianmaster' => $physicianmaster,
                'treatmentindividual' => $treatmentindividual,
                'treatment' => $treatment,
                'tax_grouping_log_index_json' => $tax_grouping_log_index_json,
            ]);
        }
    }
	*/

    public function actionProcedureRefunds($id="")
    {
    	
		  $id=base64_decode(urldecode($id));
		
    	  $procedure_cancelation=new  InProcedureCancelation();
		  $treatment_overall=InTreatmentOverall::find()->where(['id'=>$id])->one();
		 
		  $treatment_overall_array[$treatment_overall['id']]=ArrayHelper::toArray($treatment_overall);	
		  $treatment_ind_obj=new InTreatmentIndividual();
		  $treatment_individual=InTreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
		  $treatment_individual_index=ArrayHelper::index($treatment_individual,'ind_id');
		  
		  $treat_map_indiv=ArrayHelper::map($treatment_individual,'ind_id','treatment_id');	   	
	  	  $procedure=Treatment::find()->where(['IN','id',$treat_map_indiv])->asArray()->all();
		  $procedure_index=ArrayHelper::index($procedure,'id');	
		  
		  //Procedure Map
		  $procedure_map=ArrayHelper::map($procedure,'id','treatment_name');	
	
		$insurancelist=ArrayHelper::map(Insurance::find()->asArray()->all(), 'insurance_typeid','insurance_type');
		$session = Yii::$app->session;
	if($_POST)
	{
		  
		  $pro_can_insert=new InProcedureCancelation();
		  $pro_can_indv_insert=new InProcCanIndividual();
		  
		   //TreatmentOverall Fetch Value
		  $previous_tot_quantity=$treatment_overall['tot_quantity'];
		  $previous_total_gst_percent=$treatment_overall['total_gst_percent'];
		  $previous_total_cgst_percent=$treatment_overall['total_cgst_percent'];
		  $previous_total_sgst_percent=$treatment_overall['total_sgst_percent'];
		  $previous_totalgstvalue=$treatment_overall['totalgstvalue'];
		  $previous_totalcgstvalue=$treatment_overall['totalcgstvalue'];
		  $previous_totalsgstvalue=$treatment_overall['totalsgstvalue'];
		  $previous_overall_sub_total=$treatment_overall['overall_sub_total'];
		  $previous_overall_net_amount=$treatment_overall['overall_net_amount'];
		  $previous_overalltotal=$treatment_overall['overalltotal'];
		  $previous_overall_due_amount=$treatment_overall['overall_due_amount'];
		  
		
		   $subtotl=$treatment_overall['subtotval']-$_POST['total_subvalue'];
		   
		   $due_amt=$previous_overall_due_amount-$_POST['InProcedureCancelation']['can_total'];
	
		  if($due_amt<=0){
			   	$update_paid_amount=$previous_overall_net_amount-$_POST['InProcedureCancelation']['can_total'];
				
			}else{
				$update_paid_amount=$previous_overalltotal;
			}
	
		  
		  if($treatment_overall['overalldiscountpercent'] != '' || $treatment_overall['overalldiscountpercent'] != 0)
		  {
		  	$previous_overalldiscountpercent=$treatment_overall['overalldiscountpercent'];
		  }
		  else 
		  {
			  $previous_overalldiscountpercent=0;
		  }
		  
		  if($treatment_overall['overalldiscountamount'] != '' || $treatment_overall['overalldiscountamount'] != 0)
		  {
		  	$previous_overalldiscountamount=$treatment_overall['overalldiscountamount'];
		  }
		  else 
		  {
			 $previous_overalldiscountamount=0;
		  }
		  
		  
		  //POST VALUE
		  $can_qty=$_POST['InProcedureCancelation']['can_qty'];
		  $can_gst_percent=$_POST['InProcedureCancelation']['can_gst_percent'];
		  $can_cgst_percent=$_POST['InProcedureCancelation']['can_gst_percent']/2;
		  $can_sgst_percent=$_POST['InProcedureCancelation']['can_gst_percent']/2;
		  $can_gst_amt=$_POST['InProcedureCancelation']['can_gst_amt'];
		  $can_cgst_amt=$_POST['InProcedureCancelation']['can_gst_amt']/2;
		  $can_sgst_amt=$_POST['InProcedureCancelation']['can_gst_amt']/2;
		  $can_net_amount=$_POST['InProcedureCancelation']['can_total'];
		  $can_unit_price=$_POST['InProcedureCancelation']['cancel_unitprice'];
		  
		  $balance_amount=$_POST['InProcedureCancelation']['balance_amt'];
		  
		  
		 if($_POST['InProcedureCancelation']['can_due_amt'] != '' || $_POST['InProcedureCancelation']['can_due_amt'] != 0)
		 {
		 	 $can_due_amount=$_POST['InProcedureCancelation']['can_due_amt'];	
		 } 
		 else 
		 {
			  $can_due_amount=0;	
		 }
		 
		 if($_POST['InProcedureCancelation']['can_dis_percent'] != '' || $_POST['InProcedureCancelation']['can_dis_percent'] != 0)
		 {
		 	$can_dis_percent=$_POST['InProcedureCancelation']['can_dis_percent'];
		 } 
		 else
		 {
			$can_dis_percent=0;
		 }
		 
		 if($_POST['InProcedureCancelation']['can_dis_value'] != '' || $_POST['InProcedureCancelation']['can_dis_value'] != 0)
		 {
		 	 $can_dis_value=$_POST['InProcedureCancelation']['can_dis_value'];
		 } 
		 else
		 {
			$can_dis_value=0;
		 }
		
		 if($_POST['InProcedureCancelation']['return_amt'] != '' || $_POST['InProcedureCancelation']['return_amt'] != 0)
		 {
		 	$return_amount=$_POST['InProcedureCancelation']['return_amt']; 
		 }
		 else {
			 $return_amount=0; 
		 }
		    $auto_get_op=AutoidTable::find()->where(['auto'=>14])->asArray()->one();
			$inc_value_op=$auto_get_op['start_num'];
		   	$sub_op = str_pad($inc_value_op, 6, "0", STR_PAD_LEFT);
		
			  $pro_can_insert->treat_id=$treatment_overall['id'];
			  $pro_can_insert->name=$_POST['InTreatmentOverall']['name'];
			  $pro_can_insert->dob=date('Y-m-d',strtotime($_POST['InTreatmentOverall']['dob']));
			  $pro_can_insert->gender=$_POST['InTreatmentOverall']['gender'];
			  $pro_can_insert->physician_name=$treatment_overall['physicianname'];
		      $pro_can_insert->mr_number=$treatment_overall['mrnumber'];
	          $pro_can_insert->pat_id=$treatment_overall['patient_id'];
	          $pro_can_insert->subvisit_id=$treatment_overall['subvisit_id'];
	          $pro_can_insert->subvisit_num=$treatment_overall['subvisit_num'];
	          $pro_can_insert->ins_type=$treatment_overall['insurancetype'];
	          $pro_can_insert->treat_bill=$treatment_overall['billnumber'];
	          $pro_can_insert->can_bill=$sub_op;
	          $pro_can_insert->treat_invoice_date=$treatment_overall['invoicedate'];		  	  	  	  	  
	          $pro_can_insert->cancel_invoice_date=date('Y-m-d H:i:s');
	          $pro_can_insert->cancel_unitprice=$_POST['InProcedureCancelation']['cancel_unitprice'];
	          //$pro_can_insert->can_tot_items=$_POST['TreatmentOverall']['dob'];
	          $pro_can_insert->can_qty=$_POST['InProcedureCancelation']['can_qty'];
	          $pro_can_insert->can_gst_percent=$can_gst_percent;
	          $pro_can_insert->can_cgst_percent=$can_cgst_percent;	 
	     	  $pro_can_insert->can_sgst_percent=$can_sgst_percent;	 
	          $pro_can_insert->can_gst_amt=$can_gst_amt;	 
	          $pro_can_insert->can_cgst_amt=$can_cgst_amt;	 
	          $pro_can_insert->can_sgst_amt=$can_sgst_amt;	 
	          $pro_can_insert->can_dis_percent=$can_dis_percent;	 
	          $pro_can_insert->can_dis_value=$can_dis_value;	 
	          $pro_can_insert->can_due_amt=$can_due_amount;	 
	          $pro_can_insert->can_total=$can_net_amount;	 
	          $pro_can_insert->return_amt=$return_amount;	 
	     	  $pro_can_insert->balance_amt=$balance_amount;	 
	          $pro_can_insert->reason_cancel=$_POST['InProcedureCancelation']['reason_cancel'];	 
	          $pro_can_insert->authority=$_POST['InProcedureCancelation']['authority'];	 
	          $pro_can_insert->user_id=$session['user_id']; 
	          $pro_can_insert->user_role=$session['authUserRole']; 
	          $pro_can_insert->created_at=date('Y-m-d H:i:s');  
	          $pro_can_insert->ipaddress=$_SERVER['REMOTE_ADDR'];
			  if($pro_can_insert->save())
			  {
			$auto_get_op2=AutoidTable::find()->where(['auto'=>14])->asArray()->one();
			$inc_value_op2=$auto_get_op2['start_num']+1;
		   	$sub_op2 = str_pad($inc_value_op2, 6, "0", STR_PAD_LEFT);

			  	$valid_update=AutoidTable::updateAll(['start_num' => $sub_op2,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 14]);
			  	
					if(!empty($_POST['procedureindividual']))
					{
						$data=array();
						$date_id=date('Y-m-d H:i:s');
						$session = Yii::$app -> session;
						foreach ($_POST['procedureindividual'] as $key => $value) 
						{
							$data[]=[$pro_can_insert->can_id,$value,$_POST['treatmentprimeid'][$key],
							$_POST['InTreatmentIndividual']['qty'][$key],
							$_POST['InTreatmentIndividual']['rate'][$key],
							$_POST['InTreatmentIndividual']['total_price'][$key],
							$_POST['InTreatmentIndividual']['cgst_percent'][$key]+$_POST['InTreatmentIndividual']['sgst_percent'][$key],
							$_POST['InTreatmentIndividual']['cgst_percent'][$key],
							$_POST['InTreatmentIndividual']['sgst_percent'][$key],
							$_POST['InTreatmentIndividual']['cgst_value'][$key]+$_POST['InTreatmentIndividual']['sgst_value'][$key],
							$_POST['InTreatmentIndividual']['cgst_value'][$key],
							$_POST['InTreatmentIndividual']['sgst_value'][$key],
							$_POST['InTreatmentIndividual']['discountvalue'][$key],
							$_POST['InTreatmentIndividual']['discount_percent'][$key],
							$_POST['InTreatmentIndividual']['total_price'][$key],
							$session['user_id'],$_SERVER['REMOTE_ADDR'],$date_id];
							
						
							
							$TreatmentIndividual=InTreatmentIndividual::updateAll([
							
							'qty' =>$_POST['TreatmentIssueIndividual']['qty'][$key]-$_POST['InTreatmentIndividual']['qty'][$key],
							'gstvalue' =>$treatment_individual_index[$value]['gstvalue'] - ($_POST['InTreatmentIndividual']['cgst_value'][$key]+$_POST['InTreatmentIndividual']['sgst_value'][$key]),
							'cgst_value' =>$treatment_individual_index[$value]['cgst_value'] -$_POST['InTreatmentIndividual']['cgst_value'][$key],
							'sgst_value' =>$treatment_individual_index[$value]['sgst_value'] -$_POST['InTreatmentIndividual']['sgst_value'][$key],
							'discountvalue'=>$treatment_individual_index[$value]['discountvalue'] -$_POST['InTreatmentIndividual']['discountvalue'][$key],
							'discount_percent'=>$treatment_individual_index[$value]['discount_percent'] -$_POST['InTreatmentIndividual']['discount_percent'][$key],
							'total_price' =>$treatment_individual_index[$value]['total_price'] -$_POST['InTreatmentIndividual']['total_price'][$key]],
							['ind_id' => $value]);
						}

						Yii::$app->db->createCommand()->batchInsert('proc_can_individual', ['can_treat_id',
						'can_proc_ind_id', 'treat_id','qty','unit_price','mrp',
						'gst_percent','cgst_percent','sgst_percent','gst_value','cgst_value','sgst_value',
						'dis_value','dis_percent','total_price','user_id','ipaddress','created_at'],$data)->execute();
					}
				
			  		$TreatmentOverall=InTreatmentOverall::updateAll(['tot_quantity' =>$previous_tot_quantity-$can_qty ,
					'total_gst_percent'=> $previous_total_gst_percent-$can_gst_percent,
					'total_cgst_percent'=>$previous_total_cgst_percent-$can_cgst_percent ,
					'total_sgst_percent'=>$previous_total_sgst_percent-$can_sgst_percent,
					'totalgstvalue' =>$previous_totalgstvalue-$can_gst_amt,
					'totalcgstvalue' =>$previous_totalcgstvalue-$can_cgst_amt  ,
					'subtotval'=>$subtotl, 
					'totalsgstvalue' =>$previous_totalsgstvalue - $can_sgst_amt ,
					'overalldiscountpercent'=>$previous_overalldiscountpercent - $can_dis_percent ,
					'overalldiscountamount' =>$previous_overalldiscountamount - $can_dis_percent ,
					'overall_due_amount' => $balance_amount,
					'overall_sub_total'=>$previous_overall_sub_total - ($cancel_unitprice),
					'overall_net_amount'=>$previous_overall_net_amount - $can_net_amount,
					'overalltotal'=>$update_paid_amount],
					['id' => $id]);

                return $sub_op;
                
					
			  }
			  else 
			  {
				  print_r($pro_can_insert->getErrors());die;
			  }
		
              
	}
	else{
		
    	  return $this->render('cancelrefunds',[
    	  		'procedure_cancelation'=>$procedure_cancelation,
    	  		'treatment_overall'=>$treatment_overall,
    	  		'treatment_individual' => $treatment_individual,
    	  		'procedure_map' => $procedure_map,
    	  		'treatment_ind_obj' => $treatment_ind_obj,
    	  		'procedure_index' => $procedure_index,
    	  		'treatment_individual_index' => $treatment_individual_index,
    	  		'treatment_overall_array' =>$treatment_overall_array,
    	  		'insurancelist' => $insurancelist,
    	  ]); 
    	}
	}
	

	public function actionMrNumberFetch1($id)
    {
        //Sub Visit
		$last_visiting=SubVisit::find()->where(['mr_number'=>$id])->andWhere(['refund_status'=>'NO'])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
		$insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		
		$fetch_array=array();
		if(!empty($last_visiting))
		{
			//New Patient
			$new_patient=Newpatient::find()->where(['patientid'=>$last_visiting['pat_id']])->asArray()->one();
			$fetch_array[0]='Set';
			$fetch_array[1]=$last_visiting;
			$fetch_array[2]=$new_patient;
			$fetch_array[3]=date('d-m-Y',strtotime($last_visiting['created_at']));
			
			$myJSON = json_encode($fetch_array);
		}
		else
		{
			$fetch_array[0]='Empty';
			$myJSON = json_encode($fetch_array);
		}
		
		return $myJSON;
    }

	public function actionBlockipentries()
    {
         ini_set('memory_limit', '-1');
		$model = new BlockIpEntries();
	//	$change_model = new InChangeroom();
		
		$session = Yii::$app->session;
		$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		if($_POST){
				//echo "<pre>"; print_r($_POST); die;

				$model->ip_no= $_POST['BlockIpEntries']['ip_no'];
				$model->patient_name= $_POST['BlockIpEntries']['patient_name'];
				$model->mr_no= $_POST['BlockIpEntries']['mr_no'];
				$model->discharge_date= date('Y-m-d H:i:s');
				$model->address= $_POST['BlockIpEntries']['address'];
				$model->age= $_POST['BlockIpEntries']['age'];
				$model->sex= $_POST['BlockIpEntries']['sex'];
				$model->admit_date= date('Y-m-d H:i:s', strtotime($_POST['BlockIpEntries']['admit_date']));
				$model->admit_time= date('Y-m-d H:i:s', strtotime($_POST['BlockIpEntries']['admit_time']));
				$model->phone_no= $_POST['BlockIpEntries']['phone_no'];
				$model->patient_type= $_POST['BlockIpEntries']['patient_type'];
				$model->hospital= $_POST['BlockIpEntries']['hospital'];
				$model->created_at= date('Y-m-d H:i:s');
				$model->doctor_name= $_POST['BlockIpEntries']['doctor_name'];
				$model->doctor_name_2= $_POST['BlockIpEntries']['doctor_name_2'];
				$model->mlc_no= $_POST['BlockIpEntries']['mlc_no']; 
				$model->bed_no= $_POST['BlockIpEntries']['bed_no'];
				$model->remarks= $_POST['BlockIpEntries']['remarks'];
				$model->ip_address= $_SERVER['REMOTE_ADDR'];
				$model->user_id = $session['user_id'];
				$model->user_name= $session['authUserRole'];

				if($model->save()){ 
					$reg = InRegistration::find()->where(['ip_no'=>$model->ip_no])
					//->andWhere(['is_active'=>1])
					->one();
					if (!empty($reg)) {
						$reg->is_active=0;
						$reg->save();
						//echo "asd"; die;
				$models= BlockIpEntries::find()->select(['ip_no'=>'ip_no','mr_no'=>'mr_no','patient_name'=>'patient_name','sex'=>'sex','address'=>'address','age'=>'age','phone_no'=>'phone_no','doctor_name'=>'doctor_name','doctor_name_2'=>'doctor_name_2','hospital'=>'hospital','admit_date'=>'admit_date','admit_time'=>'admit_time','discharge_date'=>'discharge_date','bed_no'=>'bed_no','remarks'=>'remarks'])->where(['auto_id'=>$model->auto_id])->asArray()->one();
						//echo "<pre>"; print_r($models); die;
						return json_encode($models);
					}
				}else{
					echo "<pre>"; print_r($model->getErrors()); die;
				}

		}else{

		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			//$Newpatient=Newpatient::find()->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			$ArrayHelper_patient=ArrayHelper::index($Newpatient,'patientid');
			$Newpatient_json=json_encode($ArrayHelper_patient);
			
			
			return $this->render('blockipentries_create', [
            'model' => $model,
            'patienttype'=>$patienttype,
            'physicianmaster' => $physicianmaster,
            'bed_list' => $bed_list,
            'Newpatient_json' => $Newpatient_json,
            'ArrayHelper_patient' => $ArrayHelper_patient,
        ]);
		}

    }
	
	public function actionEnquiry()
    {
        print_r('Enquiry Pending');
		die;
    }
	
	public function actionFinalBill()
    {
        print_r('FinalBill Pending');
		die;
    }

	public function actionIpAdmission()
    {
       $model = new InRegistration();
		$change_model = new InChangeroom();
		
		$session = Yii::$app->session;
		$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		//$model =InRegistration::find()->where(['is_active'=>1])->where(['ip_no'=>'100'])->asArray()->one();
		
		if ($model->load(Yii::$app->request->post())) 
		{
			// $auto_get=AutoidTable::find()->where(['auto'=>13])->asArray()->one();
			// $inc_value=$autoget+1;
			// $rtno = str_pad($autoget, 5, "0", STR_PAD_LEFT);
			$model =InRegistration::find()->where(['is_active'=>1])->where(['ip_no'=>$_POST['InRegistration']['ip_no']])->one();
			$model->patient_type=$_POST['InRegistration']['patient_type'];
			$model->registered=$_POST['InRegistration']['registered'];
			$model->panel_type=$_POST['InRegistration']['panel_type'];
			$model->name_initial=$_POST['InRegistration']['name_initial'];
			$model->patient_name=$_POST['InRegistration']['patient_name'];
			$model->dob=$_POST['InRegistration']['dob'];
			$model->sex	=$_POST['InRegistration']['sex'];
			$model->marital_status=$_POST['InRegistration']['marital_status'];
			$model->relation_suffix=$_POST['InRegistration']['relation_suffix'];
			$model->relative_name=$_POST['InRegistration']['relative_name'];
			$model->address=$_POST['InRegistration']['address'];
			$model->city=$_POST['InRegistration']['city'];
			$model->district=$_POST['InRegistration']['district'];
			$model->state=$_POST['InRegistration']['state'];
			$model->pincode=$_POST['InRegistration']['pincode'];
			$model->phone_no=$_POST['InRegistration']['phone_no'];
			$model->mobile_no=$_POST['InRegistration']['mobile_no'];
			$model->country=$_POST['InRegistration']['country'];
			$model->religion=$_POST['InRegistration']['religion'];
			$model->type=$_POST['InRegistration']['type'];
			
			$model->refered_name=$_POST['InRegistration']['refered_name'];
			$model->ucil_from=$_POST['InRegistration']['ucil_from'];
			$model->ucil_to=$_POST['InRegistration']['ucil_to'];
			
			$model->paytype=$_POST['InRegistration']['paytype'];
			$model->bed_no	=$_POST['bedid'];
			$model->room_no=$_POST['roomnoid'];
			$model->floor_no=$_POST['floorid'];
			$model->room_type=$_POST['roomtypeid'];
			$model->consultant_dr=$_POST['InRegistration']['consultant_dr'];
			$model->dr_unit=$_POST['InRegistration']['dr_unit'];
			
			$model->speciality=$_POST['InRegistration']['speciality'];
			$model->co_consultant=$_POST['InRegistration']['co_consultant'];
			$model->diagnosis=$_POST['InRegistration']['diagnosis'];
			$model->remarks	=$_POST['InRegistration']['remarks'];
 			$model->updated_date=$_POST['InRegistration']['remarks'];
			
			
			if($model->save()){
						echo "1";
			}else{
				echo "<pre>";  print_r($model->getErrors()); die;
			}
            
        }
		else
		{
			
			$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->asArray()->all();
			$ArrayHelper_patient=ArrayHelper::index($Newpatient,'patientid');
			$Newpatient_json=json_encode($ArrayHelper_patient);
			
			return $this->render('ipadminssion', [
            'model' => $model,
            'patienttype'=>$patienttype,
            'physicianmaster' => $physicianmaster,
            'bed_list' => $bed_list,
            'Newpatient_json' => $Newpatient_json,
            'ArrayHelper_patient' => $ArrayHelper_patient,
        ]);
				
		}
		
    }
	
	public function actionIpInformation()
    {
        print_r('IpInformation Pending');
		die;
    }
	
	public function actionMoneyReceipt()
    {
        print_r('Money Receipt Pending');
		die;
    }
	
	public function actionPatientInfo()
    {
        ini_set('memory_limit', '-1');
		$model = new InRegistration();
		$change_model = new InChangeroom();
		
		$session = Yii::$app->session;
		$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$bed_list1=ArrayHelper::map(InBedno::find()->where(['is_active'=>1])->asArray()->all(), 'bedno', 'room_id');
		$bed_list=InBedno::find()->where(['is_active'=>1])->asArray()->all();
		$room_list=InRoomno::find()->where(['is_active'=>1])->asArray()->all();
		
		
		
		if ($model->load(Yii::$app->request->post())) {
			 
			$auto_get=AutoidTable::find()->where(['auto'=>13])->asArray()->one();
			$inc_value=$autoget+1;
			$rtno = str_pad($autoget, 5, "0", STR_PAD_LEFT);
					
			//echo"<pre>";print_r($inc_value); die;
		
        	$model->patient_type=$_POST['InRegistration']['patient_type'];
			$model->registered=$_POST['InRegistration']['registered'];
			$model->panel_type=$_POST['InRegistration']['panel_type'];
			$model->mr_no=$_POST['InRegistration']['mr_no'];
			$model->ip_no=$rtno;
			$model->name_initial=$_POST['InRegistration']['name_initial'];
			$model->patient_name=$_POST['InRegistration']['patient_name'];
			$model->dob=$_POST['InRegistration']['dob'];
			$model->sex	=$_POST['InRegistration']['sex'];
			$model->marital_status=$_POST['InRegistration']['marital_status'];
			$model->relation_suffix=$_POST['InRegistration']['relation_suffix'];
			$model->relative_name=$_POST['InRegistration']['relative_name'];
			$model->address=$_POST['InRegistration']['address'];
			$model->city=$_POST['InRegistration']['city'];
			$model->district=$_POST['InRegistration']['district'];
			$model->state=$_POST['InRegistration']['state'];
			$model->pincode=$_POST['InRegistration']['pincode'];
			$model->phone_no=$_POST['InRegistration']['phone_no'];
			$model->mobile_no=$_POST['InRegistration']['mobile_no'];
			$model->country=$_POST['InRegistration']['country'];
			$model->religion=$_POST['InRegistration']['religion'];
			$model->type=$_POST['InRegistration']['type'];
			
			$model->refered_name=$_POST['InRegistration']['refered_name'];
			$model->ucil_from=$_POST['InRegistration']['ucil_from'];
			$model->ucil_to=$_POST['InRegistration']['ucil_to'];
			
			$model->paytype=$_POST['InRegistration']['paytype'];
			$model->bed_no	=$_POST['bedid'];
			$model->room_no=$_POST['roomnoid'];
			$model->floor_no=$_POST['floorid'];
			$model->room_type=$_POST['roomtypeid'];
			$model->consultant_dr=$_POST['InRegistration']['consultant_dr'];
			$model->dr_unit=$_POST['InRegistration']['dr_unit'];
			
			$model->speciality=$_POST['InRegistration']['speciality'];
			$model->co_consultant=$_POST['InRegistration']['co_consultant'];
			$model->diagnosis=$_POST['InRegistration']['diagnosis'];
			$model->remarks	=$_POST['InRegistration']['remarks'];
			$model->is_active=$_POST['InRegistration']['is_active'];
			
			$model->created_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model->userrole= $session['authUserRole'];
         	$model ->ipaddress = $_SERVER['REMOTE_ADDR'];
			
				$change_model->ip_no=$rtno;
				$change_model->paytype=$_POST['InRegistration']['paytype'];
				$change_model->mr_no=$_POST['InRegistration']['mr_no'];
				$change_model->roomtype	=$_POST['roomtypeid'];
				$change_model->roomno	=$_POST['roomnoid'];
				$change_model->floorno	=$_POST['floorid'];
				$change_model->unit	=$_POST['InRegistration']['dr_unit'];
				$change_model->bedno=$_POST['bedid'];

			
			if($model ->save()){
				
				$change_model->ip_no=$rtno;
				$change_model->paytype=$_POST['InRegistration']['paytype'];
				$change_model->roomtype	=$_POST['roomtypeid'];
				$change_model->roomno	=$_POST['roomnoid'];
				$change_model->floorno	=$_POST['floorid'];
				$change_model->unit	=$_POST['InRegistration']['dr_unit'];
				$change_model->bedno=$_POST['bedid'];
				$change_model->save();
						echo "1";
			}else{
				echo "0";
			}
            //return $this->redirect(['view', 'id' => $model->autoid]);
        }
		else
		{
			//ini_set("memory_limit","128M");
			$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_marital_status'=>'pat_marital_status',
			'pat_relation'=>'pat_relation','par_relationname'=>'par_relationname','pat_address'=>'pat_address',
			'pat_city'=>'pat_city','pat_distict'=>'pat_distict','pat_state'=>'pat_state','pat_pincode'=>'pat_pincode',
			'pat_phone'=>'pat_phone','pat_mobileno'=>'pat_mobileno','pat_email'=>'pat_email'])->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			//$Newpatient=Newpatient::find()->where(['temporary_blocked'=>'N'])->asArray()->all();
			
			$ArrayHelper_patient=ArrayHelper::index($Newpatient,'patientid');
			$Newpatient_json=json_encode($ArrayHelper_patient);
			
			$insurance=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
			
			return $this->render('patient_info', [
            'model' => $model,
            'patienttype'=>$patienttype,
            'physicianmaster' => $physicianmaster,
            'bed_list' => $bed_list,
            'Newpatient_json' => $Newpatient_json,
            'ArrayHelper_patient' => $ArrayHelper_patient,
            'insurance' => $insurance,
        ]);
				
		}
    }
	
	public function actionRequistionsip()
    {
        print_r('Requistions IP Pending');
		die;
    }
	
	/*public function actionRequistionsopd()
    {
        print_r('Requistions OPD Pending');
		die;
    }*/
	
	public function actionDgcancelRefunds()
    {
        print_r('Requistions Cancel Pending');
		die;
    }
	public function actionPdf($id)
	{

		$reg_list=InRegistration::find()->where(['is_active'=>1])->andWhere(['autoid'=>$id])->asArray()->one();
		
		$new_patient=Newpatient::find()->where(['mr_no'=>$reg_list['mr_no']])->asArray()->one();
		
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		
		$insurance=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		
		$session = Yii::$app->session;
		$userid=$session['user_id'];
		
		if(!empty($userid))
		{
			$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$userid])->asArray()->one();
			$user_name=strtoupper($branch_det['ba_name']);
		}
		else 
		{
			$user_name='';
		}
		
		$patient_type=ArrayHelper::map(PatientType::find()->asArray()->all(), 'type_id', 'patient_type');
		
		$insurance=ArrayHelper::map(Insurance::find()->asArray()->all(), 'insurance_typeid', 'insurance_type');
		
		if(!empty($reg_list['type']))
		{
			$pat_type=$patient_type[$reg_list['type']];
			$ins_type='';
			
			if($reg_list['type'] == '3')
			{
				$ins_type=$insurance[$reg_list['ins_type']];
			}
		}
		else 
		{
			$pat_type='';
			$ins_type='';
		}

		if(!empty($reg_list['category_type']))
		{
			$in_categorygroup=InCategorygroup::find()->where(['autoid'=>$reg_list['category_type']])->one();
			
			$in_roomtypes_map=ArrayHelper::map(InRoomtypes::find()->asArray()->all(),'autoid','room_types');
			$in_category_map=ArrayHelper::map(InCategory::find()->asArray()->all(),'autoid','category_name');
			
			$category=$in_category_map[$in_categorygroup['category_id']];
			$roomtype=$in_roomtypes_map[$in_categorygroup['room_typeid']];	
		}
		
		$floor=$reg_list['floor_no'];
		
		
		
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
				<style>
				.department{
					float:left;
					text-align:left;
				}
				.department tr td{
					border:1px solid #000;height: 73px;	
				}
				.department_date tr td{
						border:1px solid #000;
				}
				.department_date{
					position:relative;
					left:-8px;
				}
				</style>
				<body>	<div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
				// $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
				// $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
				$tbl1.='<p style="border-top:1px solid #000;"></p>';
				$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;line-height:2px;"><u>IN PATIENT MEDICAL RECORD</u></p>';
				$tbl1.='<table cellpadding="4" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr><td style="width:15%;"> <B> MR NUMBER </B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.$reg_list['mr_no'].'</td><td style="width:18%;"> <B> IP NO </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.$reg_list['ip_no'].'</td> </tr>
				<tr><td style="width:15%;"> <B> Patient Name </B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($reg_list['name_initial'].'.'.$reg_list['patient_name']).' </td><td style="width:18%;"> <B> Admission Date </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($reg_list['created_date'])).'</td> </tr>
				<tr><td style="width:15%;"> <B> Relative Name </B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($reg_list['relative_name']).' </td><td style="width:18%;"> <B> Admission Time </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.date('h:i A',strtotime($reg_list['created_date'])).'</td> </tr>
				<tr><td style="width:15%;"> <B> Age</B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.$this->Getagebrief($new_patient['dob']).'</td><td style="width:18%;"> <B> Gender </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.$new_patient['pat_sex'].'</td> </tr>
				<tr>
				<td style="width:15%;"> <B> Address </B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($reg_list['address']).' <br>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($reg_list['city']).' <br>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($reg_list['district']).'</td><td style="width:18%;"> <B> Floor </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($floor).'</td>
				<td style="width:15%;">  </td><td style="width:35%;"></td> </tr>
				<tr>
				<td style="width:15%;"> <B> Mobile No </B> </td><td style="width:35%;">:&nbsp;&nbsp; '.$reg_list['mobile_no'].'</td><td style="width:18%;"> <B> Category </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($category).'</td>
				<td style="width:15%;">  </td><td style="width:35%;"></td> </tr>
				<tr>
				<td style="width:15%;"> <B> Consulant </B> </td><td style="width:35%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($physicianmaster[$reg_list['consultant_dr']]).'</td><td style="width:18%;"> <B> Room Type </B> </td><td style="width:32%;">:&nbsp;&nbsp;&nbsp;'.strtoupper($roomtype).'</td>
				<td style="width:15%;">  </td><td style="width:35%;"></td> </tr>
				</table>';	
				$tbl1.='<table  style="border-left:1px solid #000;border-right:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
				  <td style="font-weight:bold;"><u>Patient / Insurance Details </u></td> <td > </td></tr></table>
				 <table  style="border-left:1px solid #000;border-right:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
				  	<td style="width:16%;" > <B> Patient Type </B></td> <td  style="width:34%;">:&nbsp;&nbsp;'.strtoupper($pat_type).' </td>
				  	<td style="width:15%;" > <B> Contact No </B> </td> <td  style="width:35%;">: '.$reg_list['mobile_no'].'</td>
				  </tr>
				  <tr>
				  <td style="width:16%;"> <B> Insurance </B> </td> <td style="width:35%;">:&nbsp;&nbsp;'.strtoupper($ins_type).' </td>
				</tr>
			</table>';	
				$tbl1.='<table  style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
				  <td style="font-weight:bold;"><u>Advance Details</u></td> <td > </td> <td> </td><td> </td></tr>
				  <tr>
				  <td style="width:20%;"> Advance Received </td> <td >: </td>
				  
				  </tr>
			</table>';	
			$tbl1.='<table  style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
				  <td style="font-weight:bold;"><u>Data Entry Details</u></td> <td > </td> <td> </td><td> </td></tr>
				  <tr>
				  <td style="width:15%;"> Admitted by </td> <td >:&nbsp;&nbsp;'.$user_name.'</td>
				  <td style="width:15%;">  </td> <td > </td>
				  </tr>
				  <tr>
				  <td> Date & Time</td> <td>:&nbsp;&nbsp;'.date('d-m-Y h:i A').'</td>
				  <td> </td> <td style="text-align:right;float:right;width:40%;"><b>Signature</b></td>
				</tr>
			</table>';	

			$tbl1.='<p></p><table style="width:100%;"><tr><td style="width:70%;"><table  cellpadding="10" class="department" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
				<td> Department </td>
				<td> Date / Signature </td>
				<td> Remarks </td>
				</tr>
				<tr>
				<td> Nursing Department </td>
				<td>  </td>
				<td>  </td>
				</tr>
				<tr>
				<td> Receiption Department </td>
				<td>  </td>
				<td>  </td>
				</tr>
				<tr>
				<td> Pharmacy Department </td>
				<td>  </td>
				<td>  </td>
				</tr>
				<tr>
				<td>  </td>
				<td>  </td>
				<td>  </td>
				</tr>
				
			</table></td><td style="width:30%;" >	
			<table  cellpadding="10" class="department_date" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr>
					<td> Date </td> <td> CateGDR1 </td>
				</tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				<tr> <td>  </td> <td>  </td></tr>
				
			</table></td></tr></table>';	

				$pdf->writeHTML($tbl1, true, false, false, false, '');
				$pdf->Output('treatment_overall.pdf');	
		
	}
	public function actionReport($id)
	{
	
		$treatmentoverall_list=InTreatmentOverall::find()->where(['id'=>$id])->asArray()->one();	
		$treatment_list=InTreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
		$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$treatmentoverall_list['user_id']])->asArray()->one();
		//echo"<pre>";print_r($treatmentoverall_list); die;
		
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
				</head>
				<body>	<div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
				$tbl1.='<p style="border-top:1px solid #000;"></p>';
				$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;line-height:2px;"><u> PROCEDURE / SERVICES RECEIPT </u></p>';
				
				$tbl1.='<table cellpadding="4" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr><td style="width:15%;"> MR NUMBER </td><td style="width:35%;">: '.$treatmentoverall_list['mrnumber'].'</td>
					<td style="width:15%;"> Bill Number </td><td style="width:35%;">:</td> </tr>
				<tr><td style="width:15%;"> Patient Name </td><td style="width:35%;">: '.$treatmentoverall_list['name'].'</td>
					<td style="width:15%;"> Bill Date</td> <td style="width:35%;">: </td> </tr>
				<tr><td style="width:15%;"> Age / Gender </td><td style="width:35%;">: '.$this->Getage(date('Y-m-d',strtotime($treatmentoverall_list['dob']))).' Year(s) / '.$treatmentoverall_list['gender'].' </td></tr>
				</table>';
				$tbl1.='<table cellpadding="1" style="border-bottom:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="Center" border=1 >
				<thead ><tr ><td style="width:10%;border-bottom:1px solid #000;text-align:left;font-weight:bold;">S.NO</td>
							 <td style="width:45%;border-bottom:1px solid #000;text-align:left;font-weight:bold;">SERVICES NAME</td>
							 <td style="width:15%;border-bottom:1px solid #000;font-weight:bold;">QTY</td>
							 <td style="width:15%;border-bottom:1px solid #000;text-align:right;font-weight:bold;">RATE</td>
							 <td style="width:15%;border-bottom:1px solid #000;text-align:right;font-weight:bold;">AMount</td></tr></thead>
				<tbody>'; 
				
				if(!empty($treatment_list)){  $i=1; $total_price=0;
					foreach($treatment_list as $val){
						$treatment_list=Treatment::find()->where(['is_active'=>1])->andWhere(['id'=>$val['treatment_id']])->asArray()->one();
						$total_price+=$val['total_price'];
						if(!empty($treatmentoverall_list['overall_due_amount'])){
							$treatment_due=$treatmentoverall_list['overall_due_amount'];
						}else{
							$treatment_due=0;
						}
				$tbl1.='<tr><td style="width:10%;text-align:left;">'. $i++.'</td>
					<td style="width:45%;text-align:left;">'.$treatment_list['treatment_name'].'</td>
					<td style="width:15%;">'. $val['qty'].'</td>
					<td style="width:15%;text-align:right;">'. $val['rate'].'</td>
					<td style="width:15%;text-align:right;">'. $val['total_price'] .'</td>
					</tr>';
				}
				$tbl1.='<tr>
					<td style="width:70%;border-top:1px solid #000;text-align:left;"></td>
					<td style="width:15%;border-top:1px solid #000;text-align:left;">TOTAL</td>
					<td style="width:15%;border-top:1px solid #000;text-align:right;">  '.$treatmentoverall_list['overall_net_amount'] .'</td>
					</tr><tr>
					<td style="width:70%;text-align:left;"></td>
					<td style="width:15%;text-align:left;">CONCESSIO</td>
					<td style="width:15%;text-align:right;">  '.$treatmentoverall_list['totalgstvalue'] .'</td>
					</tr><tr>
					<td style="width:70%;text-align:left;"></td>
					<td style="width:15%;text-align:left;">PAID</td>
					<td style="width:15%;text-align:right;">  '.$treatmentoverall_list['overalltotal'] .'</td>
					</tr>
					<tr>
					<td style="width:70%;text-align:left;"></td>
					<td style="width:15%;text-align:left;">DUE AMOUNT</td>
					<td style="width:15%;text-align:right;">  '.$treatment_due .'</td>
					</tr>';
				}
				$tbl1.='
				</tbody>
				</table>';
				$tbl1.='<p></p><p></p><table><tr><td style="text-align:left;text-transform: uppercase;font-weight:bold;"> USER '. $branch_det['ba_name'].'</td><td style="text-align:right;text-transform: uppercase;font-weight:bold;">'.$branch_det['authUserRole'].' </td></tr></table>';
				$pdf->writeHTML($tbl1, true, false, false, false, '');
				$pdf->Output('treatment_overall.pdf');	      
	
	}

	public function Getage($userDob)
	{
		
		$dob = new \DateTime($userDob);
		$now = new \DateTime();
		$difference = $now->diff($dob);
		$age = $difference->y;
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
	
	 }
