<?php

namespace backend\controllers;

use Yii;
use backend\models\TreatmentOverall;
use backend\models\Newpatient;
use backend\models\SubVisit;
use backend\models\Insurance;

use backend\models\TreatmentOverallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Physicianmaster;
use backend\models\TreatmentIndividual;
use backend\models\Treatment;
use backend\models\AutoidTable;
use backend\models\TaxgroupingLog;
use backend\models\BranchAdmin;
use backend\models\ProcedureCancelation;
use backend\models\ProcCanIndividual;
use backend\models\OpMoneyreceipt;
use backend\models\AuthorityMaster;

/**
 * TreatmentOverallController implements the CRUD actions for TreatmentOverall model.
 */
class TreatmentOverallController extends Controller
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
     * Lists all TreatmentOverall models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreatmentOverallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TreatmentOverall model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	
		$treatment_list=TreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
		//echo"<pre>";print_r($treatment_list); die;
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'treatment_list'=>$treatment_list,
        ]);
    }

    /**
     * Creates a new TreatmentOverall model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TreatmentOverall();
		$newpatient= new Newpatient();
		$treatmentindividual= new TreatmentIndividual();
		$op_money_receipt=new OpMoneyreceipt();
		$session = Yii::$app->session;
		
        if ($model->load(Yii::$app->request->post())) 
        {
        	//echo"<pre>";  print_r($_POST); die;
			$total_cgst_pre=array_sum($_POST['TreatmentIndividual']['cgst_percent']);
			$total_sgst_pre=array_sum($_POST['TreatmentIndividual']['sgst_percent']);
			$total_cgst=array_sum($_POST['TreatmentIndividual']['cgst_value']);
			$total_sgst=array_sum($_POST['TreatmentIndividual']['sgst_value']);
			$subvisit_post=SubVisit::find()->where(['sub_id'=>Yii::$app->request->post('SUBVISITID')])->asArray()->one();
			$newpatient_post=Newpatient::find()->where(['patientid'=>$subvisit_post['pat_id']])->asArray()->one();
			$auto_get_sub=AutoidTable::find()->where(['auto'=>12])->asArray()->one();
			$inc_value_sub=$auto_get_sub['start_num']+1;
		   	$sub_number = str_pad($inc_value_sub, 6, "0", STR_PAD_LEFT);

		   	//Cancel No Auto Increment
		   	$auto_get_op=AutoidTable::find()->where(['auto'=>14])->asArray()->one();
			$inc_value_op=$auto_get_op['start_num']+1;
		   	$sub_op = str_pad($inc_value_op, 6, "0", STR_PAD_LEFT);
	//	print_r(Yii::$app->request->post('SUBVISITID')); die;
			if(!empty($subvisit_post))
			{
				$model->refund_status='NO';
				$model->name=$newpatient_post['patientname'];
				$model->dob=date('Y-m-d',strtotime($newpatient_post['dob']));
				$model->gender=$newpatient_post['pat_sex'];
				$model->physicianname=$subvisit_post['consultant_doctor'];
				$model->mrnumber=$subvisit_post['mr_number'];
				$model->patient_id=$subvisit_post['pat_id'];
				$model->subvisit_id=$subvisit_post['sub_id'];
				$model->subvisit_num=$subvisit_post['sub_visit'];
				$model->insurancetype=$subvisit_post['insurance_type'];
				$model->address=$newpatient_post['pat_address'];
				$model->phonenumber=$newpatient_post['pat_phone'];
				$model->billnumber=$auto_get_sub['start_num'];
				$model->invoicedate=date('Y-m-d H:i:s');
				//$model->total=0;
				$model->total=Yii::$app->request->post('TreatmentOverall')['overall_sub_total'];
				$model->tot_no_of_items=count(Yii::$app->request->post('treatmentprimeid'));
				$model->tot_quantity=Yii::$app->request->post('TreatmentOverall')['tot_quantity'];
				$model->total_gst_percent=Yii::$app->request->post('TreatmentOverall')['total_gst_percent'];
				$model->total_cgst_percent=$total_cgst_pre;
				$model->total_sgst_percent=$total_sgst_pre;
				$model->totalgstvalue=Yii::$app->request->post('TreatmentOverall')['totalgstvalue'];
				$model->totalcgstvalue=$total_cgst;
				$model->totalsgstvalue=$total_sgst;
				$model->subtotval=$_POST['total_subvalue'];
				$model->netamount=Yii::$app->request->post('TreatmentOverall')['overall_net_amount'];
				$model->over_totalval=Yii::$app->request->post('TreatmentOverall')['overalltotal'];
				$model->overalldiscountpercent=Yii::$app->request->post('TreatmentOverall')['overalldiscountpercent'];
				$model->overalldiscountamount=Yii::$app->request->post('TreatmentOverall')['overalldiscountamount'];
				if(Yii::$app->request->post('TreatmentOverall')['overall_due_amount']==""){
					$model->overall_due_amount="0";	
				}else{
					$model->overall_due_amount=Yii::$app->request->post('TreatmentOverall')['overall_due_amount'];
				}
				$model->overall_sub_total=(Yii::$app->request->post('TreatmentOverall')['overall_sub_total'] );
				$model->overall_net_amount=Yii::$app->request->post('TreatmentOverall')['overall_net_amount'];
				$model->overalltotal=Yii::$app->request->post('TreatmentOverall')['overalltotal'];
				$model->remarks=Yii::$app->request->post('TreatmentOverall')['remarks'];
				$model->discount_authority=Yii::$app->request->post('TreatmentOverall')['discount_authority'];
				$model->user_id=$session['user_id'];
				$model->user_role=$session['authUserRole'];
				$model->created_at=date('Y-m-d H:i:s');
				$model->ipaddress=$_SERVER['REMOTE_ADDR'];
				
				
				if($model->save())
				{
					AutoidTable::updateAll(['start_num' => $sub_number,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 12]);

					AutoidTable::updateAll(['start_num' => $sub_op,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 14]);
					
					$data=array();
					foreach ($_POST['treatmentprimeid'] as $key => $value) 
					{
						$data[]=[$model->id,'NO',$_POST['treatmentprimeid'][$key],$_POST['TreatmentIndividual']['qty'][$key],$_POST['TreatmentIndividual']['rate'][$key],$_POST['TreatmentIndividual']['rate'][$key],($_POST['TreatmentIndividual']['cgst_percent'][$key]+$_POST['TreatmentIndividual']['sgst_percent'][$key]),($_POST['TreatmentIndividual']['cgst_value'][$key]+$_POST['TreatmentIndividual']['sgst_value'][$key]),$_POST['TreatmentIndividual']['cgst_percent'][$key],$_POST['TreatmentIndividual']['sgst_percent'][$key],$_POST['TreatmentIndividual']['cgst_value'][$key],$_POST['TreatmentIndividual']['sgst_value'][$key],$_POST['TreatmentIndividual']['discountvalue'][$key],$_POST['TreatmentIndividual']['discount_percent'][$key],$_POST['TreatmentIndividual']['total_price'][$key],$session['user_id'],$session['authUserRole'],$_SERVER['REMOTE_ADDR'],date('Y-m-d H:i:s')];
					}
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('treatment_individual', ['treat_ove_id','return_status', 'treatment_id','qty','rate','mrp','gstpercent','gstvalue','cgst_percent','cgst_value','sgst_percent','sgst_value','discountvalue','discount_percent','total_price','user_id','user_role','ipaddress','created_at'],$data)->execute();
					
					$op_money_receipt->	mr_type = 'P';
					$op_money_receipt->	pat_id = $model->patient_id;
					$op_money_receipt->	mr_number = $model->mrnumber;
					$op_money_receipt->	sub_id = $model->subvisit_id;
					$op_money_receipt->	common_id = $model->id;
					$op_money_receipt->	subvisit_id = $model->subvisit_num;
					$op_money_receipt->	default_amount = $model->overall_net_amount;  //Patient Net Amount This Not Editable and Not Update
					$op_money_receipt->	amount = $model->overall_net_amount;          //Patient Net Amount
					$op_money_receipt->	paid_amount = $model->overalltotal;		//Patient Paid Amount This Not Editable and Not Update
					$op_money_receipt->	request_date = date('Y-m-d H:i:s');
					$op_money_receipt->	paid_by = $model->billnumber;                //Patient Bill Number
					$op_money_receipt->	patient_name = $model->name;
					$op_money_receipt->	total_amt = $model->overalltotal;    //Patient Paid Amount
					$op_money_receipt->	org_disc_amt = $model->overall_due_amount;  //Patient Due Amount
					$op_money_receipt->	amount_words = $this->AmtinWords($model->overall_due_amount);   //Due Amount In Words
					$op_money_receipt->	created_at = date('Y-m-d H:i:s');   
					$op_money_receipt->	user_id = $session['user_id'];   
					$op_money_receipt->	updated_ipaddress = $_SERVER['REMOTE_ADDR'];  
					if($op_money_receipt->save())
					{
						$res[]="";
							$res[0]=$model->billnumber;
							$res[1]=$model->id; 
							$res[2]="2";
							return json_encode($res); 
					}
					else{
						
						echo"<pre>";print_r($op_money_receipt->getErrors());die;
					}
					
					//return 'S';
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
			
			//Treatment
			//$treatment=ArrayHelper::map(Treatment::find()->where(['is_active'=>1])->all(), 'id', 'treatment_name');
			
			$treatment=Treatment::find()->where(['is_active'=>1])->all();
			$hsn_code_map=ArrayHelper::map($treatment,'hsn_code','hsn_code');
			$tax_grouping_log=TaxgroupingLog::find()->where(['IN','taxgroupid',$hsn_code_map])->andWhere(['is_active'=>1])->asArray()->all();
			$tax_grouping_log_index=ArrayHelper::index($tax_grouping_log,'taxgroupid');
			$tax_grouping_log_index_json=json_encode($tax_grouping_log_index);
			
			//echo"<pre>"; 		  print_r($treatment); die;
			
			$authority_master=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname');
			
            return $this->render('create', [
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
                'authority_master' => $authority_master,
            ]);
        }
    }

  function AmtinWords($number)
	{
		//print_r($number); die;
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
public function actionMrNumberFetch($id)
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


    /**
     * Updates an existing TreatmentOverall model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TreatmentOverall model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TreatmentOverall model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TreatmentOverall the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TreatmentOverall::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	
	
	
	public function actionProcedureRefunds($id="")
    {
    	
		  $id=base64_decode(urldecode($id));
		
    	  $procedure_cancelation=new  ProcedureCancelation();
		  $treatment_overall=TreatmentOverall::find()->where(['id'=>$id])->one();
		 
		  $treatment_overall_array[$treatment_overall['id']]=ArrayHelper::toArray($treatment_overall);	
		  $treatment_ind_obj=new TreatmentIndividual();
		  $treatment_individual=TreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
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
		  $pro_can_insert=new ProcedureCancelation();
		  $pro_can_indv_insert=new ProcCanIndividual();
		  
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
		   $due_amt=$previous_overall_due_amount-$_POST['ProcedureCancelation']['can_total'];
		  if($due_amt<=0){
			   	$update_paid_amount=$previous_overall_net_amount-$_POST['ProcedureCancelation']['can_total'];
				
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
		  $can_qty=$_POST['ProcedureCancelation']['can_qty'];
		  $can_gst_percent=$_POST['ProcedureCancelation']['can_gst_percent'];
		  $can_cgst_percent=$_POST['ProcedureCancelation']['can_gst_percent']/2;
		  $can_sgst_percent=$_POST['ProcedureCancelation']['can_gst_percent']/2;
		  $can_gst_amt=$_POST['ProcedureCancelation']['can_gst_amt'];
		  $can_cgst_amt=$_POST['ProcedureCancelation']['can_gst_amt']/2;
		  $can_sgst_amt=$_POST['ProcedureCancelation']['can_gst_amt']/2;
		  $can_net_amount=$_POST['ProcedureCancelation']['can_total'];
		  $can_unit_price=$_POST['ProcedureCancelation']['cancel_unitprice'];
		  $balance_amount=$_POST['ProcedureCancelation']['balance_amt'];
		  
		  
		 if($_POST['ProcedureCancelation']['can_due_amt'] != '' || $_POST['ProcedureCancelation']['can_due_amt'] != 0)
		 {
		 	 $can_due_amount=$_POST['ProcedureCancelation']['can_due_amt'];	
		 } 
		 else 
		 {
			  $can_due_amount=0;	
		 }
		 
		 if($_POST['ProcedureCancelation']['can_dis_percent'] != '' || $_POST['ProcedureCancelation']['can_dis_percent'] != 0)
		 {
		 	$can_dis_percent=$_POST['ProcedureCancelation']['can_dis_percent'];
		 } 
		 else
		 {
			$can_dis_percent=0;
		 }
		 
		 if($_POST['ProcedureCancelation']['can_dis_value'] != '' || $_POST['ProcedureCancelation']['can_dis_value'] != 0)
		 {
		 	 $can_dis_value=$_POST['ProcedureCancelation']['can_dis_value'];
		 } 
		 else
		 {
			$can_dis_value=0;
		 }
		
		 if($_POST['ProcedureCancelation']['return_amt'] != '' || $_POST['ProcedureCancelation']['return_amt'] != 0)
		 {
		 	$return_amount=$_POST['ProcedureCancelation']['return_amt']; 
		 }
		 else {
			 $return_amount=0; 
		 }
		    $auto_get_op=AutoidTable::find()->where(['auto'=>14])->asArray()->one();
			$inc_value_op=$auto_get_op['start_num'];
		   	$sub_op = str_pad($inc_value_op, 6, "0", STR_PAD_LEFT);
		
			  $pro_can_insert->treat_id=$treatment_overall['id'];
			  $pro_can_insert->name=$_POST['TreatmentOverall']['name'];
			  $pro_can_insert->dob=date('Y-m-d',strtotime($_POST['TreatmentOverall']['dob']));
			  $pro_can_insert->gender=$_POST['TreatmentOverall']['gender'];
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
	          $pro_can_insert->cancel_unitprice=$_POST['ProcedureCancelation']['cancel_unitprice'];
	          //$pro_can_insert->can_tot_items=$_POST['TreatmentOverall']['dob'];
	          $pro_can_insert->can_qty=$_POST['ProcedureCancelation']['can_qty'];
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
	          $pro_can_insert->reason_cancel=$_POST['ProcedureCancelation']['reason_cancel'];	 
	          $pro_can_insert->authority=$_POST['ProcedureCancelation']['authority'];	 
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
							$_POST['TreatmentIndividual']['qty'][$key],
							$_POST['TreatmentIndividual']['rate'][$key],
							$_POST['TreatmentIndividual']['total_price'][$key],
							$_POST['TreatmentIndividual']['cgst_percent'][$key]+$_POST['TreatmentIndividual']['sgst_percent'][$key],
							$_POST['TreatmentIndividual']['cgst_percent'][$key],
							$_POST['TreatmentIndividual']['sgst_percent'][$key],
							$_POST['TreatmentIndividual']['cgst_value'][$key]+$_POST['TreatmentIndividual']['sgst_value'][$key],
							$_POST['TreatmentIndividual']['cgst_value'][$key],
							$_POST['TreatmentIndividual']['sgst_value'][$key],
							$_POST['TreatmentIndividual']['discountvalue'][$key],
							$_POST['TreatmentIndividual']['discount_percent'][$key],
							$_POST['TreatmentIndividual']['total_price'][$key],
							$session['user_id'],$_SERVER['REMOTE_ADDR'],$date_id];
							
						
							
							$TreatmentIndividual=TreatmentIndividual::updateAll([
							
							'qty' =>$_POST['TreatmentIssueIndividual']['qty'][$key]-$_POST['TreatmentIndividual']['qty'][$key],
							'gstvalue' =>$treatment_individual_index[$value]['gstvalue'] - ($_POST['TreatmentIndividual']['cgst_value'][$key]+$_POST['TreatmentIndividual']['sgst_value'][$key]),
							'cgst_value' =>$treatment_individual_index[$value]['cgst_value'] -$_POST['TreatmentIndividual']['cgst_value'][$key],
							'sgst_value' =>$treatment_individual_index[$value]['sgst_value'] -$_POST['TreatmentIndividual']['sgst_value'][$key],
							'discountvalue'=>$treatment_individual_index[$value]['discountvalue'] -$_POST['TreatmentIndividual']['discountvalue'][$key],
							'discount_percent'=>$treatment_individual_index[$value]['discount_percent'] -$_POST['TreatmentIndividual']['discount_percent'][$key],
							'total_price' =>$treatment_individual_index[$value]['total_price'] -$_POST['TreatmentIndividual']['total_price'][$key]],
							['ind_id' => $value]);
						}

						Yii::$app->db->createCommand()->batchInsert('proc_can_individual', ['can_treat_id',
						'can_proc_ind_id', 'treat_id','qty','unit_price','mrp',
						'gst_percent','cgst_percent','sgst_percent','gst_value','cgst_value','sgst_value',
						'dis_value','dis_percent','total_price','user_id','ipaddress','created_at'],$data)->execute();
					}

					$opmoneyreceipts=OpMoneyreceipt::updateAll([
						'amount' => $previous_overall_net_amount - $can_net_amount,
						'request_date' => date('Y-m-d H:i:s'),
						'total_amt' => $update_paid_amount,
						'org_disc_amt' =>$balance_amount,
						'amount_words' => $this->AmtinWords($balance_amount),
						'updated_at' => date('Y-m-d H:i:s'),   
						'user_id' => $session['user_id'],   
						'updated_ipaddress' => $_SERVER['REMOTE_ADDR'],				],
					['common_id' => $id,'mr_type'=>'P']);
					
					
					$TreatmentOverall=TreatmentOverall::updateAll(['tot_quantity' =>$previous_tot_quantity-$can_qty ,
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
	
	
	function Objecttoarray($result)
	{
		$array = array();
		foreach ($result as $key=>$value)
		{
			if (is_object($value))
			{
				$array[$key]=$value;
			}
			/*if (is_array($value))
			{
				$array[$key]=$value;
			}*/
			
		}
		return $array;
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
	
	public function actionAjaxsinglefetch($id)
    {
    	
		if(!empty($id))
		{
			$fetch_array=array();
			
			$sub_visit=SubVisit::find()->where(['mr_number'=>$id])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
			 
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_mobileno'=>'pat_mobileno','par_relationname'=>'par_relationname'])
			->where(['temporary_blocked'=>'N'])->andWhere(['mr_no'=>$id])->asArray()->one();
			
			//echo"<pre>"; print_r($Newpatient);
			
			if(!empty($Newpatient))
			{
				$physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
				$insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
				$fetch_array[0] =$sub_visit;
				$fetch_array[1] =$Newpatient;
				$fetch_array[2] =$physicianmaster;
				$fetch_array[3] =$insurance;
				//echo"<pre>"; print_r($fetch_array); die;
				return json_encode($fetch_array);
			}
		}
	}
	
	public function actionAjaxsinglefetchdetails($id)
    {
    	
		if(!empty($id))
		{
			
			$fetch_array=array();
			$sub_visit=SubVisit::find()->where(['pat_id'=>$id])->orderBy(['pat_id'=>SORT_DESC])->asArray()->one();
			 
    		$Newpatient=Newpatient::find()->select(['patientid'=>'patientid','mr_no'=>'mr_no','patientname'=>'patientname','pat_relation'=>'pat_relation',
			'pat_inital_name'=>'pat_inital_name','dob'=>'dob','pat_sex'=>'pat_sex','pat_mobileno'=>'pat_mobileno','pat_marital_status'=>'pat_marital_status','par_relationname'=>'par_relationname'])
			->where(['temporary_blocked'=>'N'])->andWhere(['mr_no'=>$sub_visit['mr_number']])->asArray()->one();
			//print_r($Newpatient); 
			if(!empty($Newpatient))
			{
				$physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
				$insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();
				//echo "<pre>";print_r($sub_visit); die;
				$fetch_array[0] =	$sub_visit;
				$fetch_array[1] =	$Newpatient;
				$fetch_array[2] =	$physicianmaster;
				$fetch_array[3] ='<option value='.$insurance['insurance_type'].'>'.$insurance['insurance_type'].'</option> ';
				//echo "<pre>";	 print_r($fetch_array);die;
				return json_encode($fetch_array);
			}
		}
	}
	
	
	/*public function actionFetchdetails($id)
	{
		$subvisit=SubVisit::find()->where(['sub_id'=>$id])->asArray()->one();
		
		$newpatient=Newpatient::find()->where(['patientid'=>$subvisit['pat_id']])->asArray()->one();
		
		//CONSULTANT NAME
		$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		$fetch_array=array();
		if(!empty($subvisit))
		{
			$fetch_array[0]=$subvisit['sub_visit'];
			$fetch_array[1]=$subvisit['mr_number'];
			$fetch_array[2]=$newpatient['patientname'];
			$fetch_array[3]=$this->Getage($newpatient['dob']);
			$fetch_array[4]='<option value='.$newpatient['pat_sex'].'>'.$newpatient['pat_sex'].'</option>';
			$fetch_array[5]='<option value='.$subvisit['consultant_doctor'].'>'.$physicianmaster[$subvisit['consultant_doctor']].'</option>';
			$fetch_array[6]=$subvisit['net_amt'];
			$fetch_array[7]=$subvisit['paid_amt'];
			$fetch_array[8]=$this->actionAmtinwords($subvisit['paid_amt']);
			
			return  json_encode($fetch_array);
		}
	}*/
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
	public function Getage($userDob)
	{
		
		$dob = new \DateTime($userDob);
		$now = new \DateTime();
		$difference = $now->diff($dob);
		$age = $difference->y;
		$age = $difference->m;
		$age = $difference->d;
		return $age;
		
	}
	
	public function actionReport($id)
	{
	
		$treatmentoverall_list=TreatmentOverall::find()->where(['id'=>$id])->asArray()->one();	
		$treatment_list=TreatmentIndividual::find()->where(['treat_ove_id'=>$id])->asArray()->all();
		$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$treatmentoverall_list['user_id']])->asArray()->one();
		$insurance=Insurance::find()->where(['insurance_typeid'=>$treatmentoverall_list['insurancetype']])->asArray()->one();
		//echo"<pre>";print_r(); die;
		if($insurance['insurance_type']!=""){
			$insurance_val=$insurance['insurance_type'];
		}else{
			$insurance_val="-";
		}
		$overall_net_amount=0;
		if($treatmentoverall_list['overalldiscountamount']!=""){
			$overall_net_amount=$treatmentoverall_list['overalldiscountamount'];
		}else{
			$overall_net_amount=0;
		}
		
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
				$originalDate = $treatmentoverall_list['created_at'];
				$newDate = date("d-m-Y h:i A", strtotime($originalDate));
				
				$tbl1='<html>
				<head>
				</head>
				</head>
				<body>	<div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
				// $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
				// $tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
				$tbl1.='<p style="border-top:1px solid #000;"></p>';
				$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;line-height:2px;"><u> PROCEDURE / SERVICES RECEIPT </u></p>';
				
				$tbl1.='<table cellpadding="4" style="border:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border=1 >
				<tr><td style="width:15%;"> MR NUMBER </td><td style="width:35%;">: '.$treatmentoverall_list['mrnumber'].'</td>
					<td style="width:15%;"> Bill Number </td><td style="width:35%;">: '.$treatmentoverall_list['billnumber'].' </td> </tr>
				<tr><td style="width:15%;"> Patient Name </td><td style="width:35%;">: '.$treatmentoverall_list['name'].'</td>
					<td style="width:15%;"> Bill Date</td> <td style="width:35%;">: '.$newDate.' </td> </tr>
				<tr><td style="width:15%;"> Age / Gender </td><td style="width:35%;">: '. $this->Getagebrief(date('Y-m-d',strtotime($treatmentoverall_list['dob']))).' / <br> '.$treatmentoverall_list['gender'].' </td>
					<td style="width:15%;"> Insurance </td> <td style="width:35%;">: '.$insurance_val.' </td> </tr>
				</table>';
				$tbl1.='<table cellpadding="1" style="border-bottom:1px solid #000;padding:5px 10px;font-size:12px;margin-top:250px;" ALIGN="Center" border=1 >
				<thead ><tr ><td style="width:10%;border-bottom:1px solid #000;text-align:left;font-weight:bold;">S.NO</td>
							 <td style="width:45%;border-bottom:1px solid #000;text-align:left;font-weight:bold;">SERVICES NAME</td>
							 <td style="width:15%;border-bottom:1px solid #000;font-weight:bold;">QTY</td>
							 <td style="width:15%;border-bottom:1px solid #000;text-align:right;font-weight:bold;">RATE</td>
							 <td style="width:15%;border-bottom:1px solid #000;text-align:right;font-weight:bold;">AMOUNT</td></tr></thead>
				<tbody>'; 
				
				if(!empty($treatment_list)){  $i=1; $total_price=0;
					foreach($treatment_list as $val){
						$treatment_list=Treatment::find()->where(['is_active'=>1])->andWhere(['id'=>$val['treatment_id']])->asArray()->one();
						$total_price+=$val['mrp']*$val['qty'];
						if(!empty($treatmentoverall_list['overall_due_amount'])){
							$treatment_due=$treatmentoverall_list['overall_due_amount'];
						}else{
							$treatment_due=0;
						}
				$tbl1.='<tr><td style="width:10%;text-align:left;">'. $i++.'</td>
					<td style="width:45%;text-align:left;">'.$treatment_list['treatment_name'].'</td>
					<td style="width:15%;">'. $val['qty'].'</td>
					<td style="width:15%;text-align:right;">'. $val['rate'].'</td>
					<td style="width:15%;text-align:right;">'. $val['mrp']*$val['qty'] .'</td>
					</tr>';
				}
				$tbl1.='<tr>
					<td style="width:70%;border-top:1px solid #000;text-align:left;"></td>
					<td style="width:15%;border-top:1px solid #000;text-align:left;">TOTAL</td>
					<td style="width:15%;border-top:1px solid #000;text-align:right;">  '.$total_price .'</td>
					</tr><tr>
					<td style="width:70%;text-align:left;"></td>
					<td style="width:15%;text-align:left;">CONCESSION</td>
					<td style="width:15%;text-align:right;">  '.$overall_net_amount.'</td>
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
}
