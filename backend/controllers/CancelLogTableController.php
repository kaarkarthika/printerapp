<?php

namespace backend\controllers;

use Yii;
use backend\models\CancelLogTable;
use backend\models\CancelLogTableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Newpatient;
use backend\models\SubVisit;
use backend\models\BranchAdmin;
use backend\models\Physicianmaster;
use backend\models\Specialistdoctor;
use backend\models\PaymentType;
use backend\models\Patienttype;
use backend\models\Ucil;
use backend\models\ConsultantAmt;
use yii\helpers\ArrayHelper;
use backend\models\Insurance;
use backend\models\AutoidTable;
use yii\db\Query;
/**
 * CancelLogTableController implements the CRUD actions for CancelLogTable model.
 */
class CancelLogTableController extends Controller
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
     * Lists all CancelLogTable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CancelLogTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CancelLogTable model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CancelLogTable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CancelLogTable();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cancel_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CancelLogTable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cancel_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CancelLogTable model.
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
     * Finds the CancelLogTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CancelLogTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CancelLogTable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
						//return 'S';
						return $this->redirect(['index']);
					}
					else 
					{
						print_r($cancellog->getErrors());die;
					}	
				}
			}
			else 
			{
				print_r($subvisit_query->getErrors());die;
			}
		}
		else 
		{
			$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		
			$physicianmaster=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
			
			$specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
			
			$paymenttype=ArrayHelper::map(PaymentType::find()->where(['is_active'=>1])->asArray()->all(), 'payment_type_id', 'paymenttype');
			
			$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
		
			//Datatable
			$subvisit_datatable=SubVisit::find()->select(['sub_id'=>'sub_id','pat_id'=>'pat_id','mr_number'=>'mr_number','sub_visit'=>'sub_visit','consultant_doctor'=>'consultant_doctor','department'=>'department','consultant_name'=>'consultant_name','created_at'=>'created_at'])->where(['refund_status'=>'NO'])->andWhere(['date(created_at)'=>date('Y-m-d')])->andWhere(['ucil_letter_status'=>''])->andWhere(['cons_status'=>'F'])->andWhere(['<>','net_amt' ,''])->asArray()->all();
			$subvisit_datatable_map=ArrayHelper::map($subvisit_datatable, 'sub_id', 'pat_id');
			$subvisit_datatable_index=ArrayHelper::index($subvisit_datatable, 'sub_id');
			
			//CONSULTANT NAME
			$physicianmaster_datatable=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
			
			$newpatient_datatable=Newpatient::find()->where(['IN','patientid',$subvisit_datatable_map])->asArray()->all();
			$newpatient_datatable_index=ArrayHelper::index($newpatient_datatable, 'patientid');

		
		
			
			return $this->render('cancelopd', [
	            'subvisit' => $subvisit,
	            'cancellog' => $cancellog,
	            'newpatient' => $newpatient,
	            'paymenttype' => $paymenttype,
	            'physicianmaster' => $physicianmaster,
	            'subvisit_datatable' => $subvisit_datatable_index,
	            'newpatient_datatable' => $newpatient_datatable_index,
	            'physicianmaster_datatable'=> $physicianmaster_datatable,
	           
	        ]);
		}
		
	}
		
		
		
	
	
	
/*public function actionCancelkey() 
	{
		//Datatable
		$subvisit_datatable=SubVisit::find()->select(['sub_id'=>'sub_id','pat_id'=>'pat_id','mr_number'=>'mr_number','sub_visit'=>'sub_visit','consultant_doctor'=>'consultant_doctor','department'=>'department','consultant_name'=>'consultant_name','created_at'=>'created_at'])->where(['refund_status'=>'NO'])->andWhere(['created_at'=>date('Y-m-d',strtotime('2018-08-31'))])->andWhere(['ucil_letter_status'=>''])->andWhere(['cons_status'=>'F'])->orderBy(['sub_id'=>SORT_DESC])->asArray()->all();
		$subvisit_datatable_map=ArrayHelper::map($subvisit_datatable, 'pat_id', 'pat_id');
		$subvisit_datatable_index=ArrayHelper::index($subvisit_datatable, 'sub_id');
		
		//CONSULTANT NAME
		$physicianmaster_datatable=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		
		$newpatient_datatable=Newpatient::find()->where(['IN','patientid',$subvisit_datatable_map])->asArray()->all();
		$newpatient_datatable_index=ArrayHelper::index($newpatient_datatable, 'patientid');
		
		$sub_visit_array=array();
		if(!empty($subvisit_datatable))
		{
			foreach ($subvisit_datatable as $key => $value) 
			{
			//	$sub_visit_array['data'][]=array($value['sub_id'],'DT_RowId'=>$value['sub_id'],'subvisitnumber'=>$value['sub_visit'],'patientname'=>$newpatient_datatable_index[$value['pat_id']]['patientname'],'Mobile_Number'=>$newpatient_datatable_index[$value['pat_id']]['pat_mobileno'],'Consultant'=>$physicianmaster_datatable[$value['consultant_doctor']]); 
				
				$sub_visit_array['data'][]=array($value['sub_id'],$value['sub_visit'],$newpatient_datatable_index[$value['pat_id']]['patientname'],$newpatient_datatable_index[$value['pat_id']]['pat_mobileno'],$physicianmaster_datatable[$value['consultant_doctor']]);
			} 
		} 
		//echo '<pre>';
		//print_r($sub_visit_array);die;
		echo json_encode($sub_visit_array);
	}

	
	public function actionCancelkey2() 
	{
		//Datatable
		$subvisit_datatable=SubVisit::find()->select(['sub_id'=>'sub_id','pat_id'=>'pat_id','mr_number'=>'mr_number','sub_visit'=>'sub_visit','consultant_doctor'=>'consultant_doctor','department'=>'department','consultant_name'=>'consultant_name','created_at'=>'created_at'])->where(['refund_status'=>'NO'])->andWhere(['created_at'=>date('Y-m-d',strtotime('2018-08-31'))])->orderBy(['sub_id'=>SORT_DESC])->asArray()->all();
		$subvisit_datatable_map=ArrayHelper::map($subvisit_datatable, 'pat_id', 'pat_id');
		$subvisit_datatable_index=ArrayHelper::index($subvisit_datatable, 'sub_id');
		
		//CONSULTANT NAME
		$physicianmaster_datatable=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
		
		$newpatient_datatable=Newpatient::find()->where(['IN','patientid',$subvisit_datatable_map])->asArray()->all();
		$newpatient_datatable_index=ArrayHelper::index($newpatient_datatable, 'patientid');

		$totalData=count($subvisit_datatable);
		$totalFiltered=$totalData;
		
		$sub_visit_array=array();
			
		if(!empty($subvisit_datatable))
		{$i=0;
			foreach ($subvisit_datatable as $key => $value) 
			{
				$responce->rows[$i]=array('subvisitnumber'=>$value['sub_visit'],'patientname'=>$newpatient_datatable_index[$value['pat_id']]['patientname'],'Mobile_Number'=>$newpatient_datatable_index[$value['pat_id']]['pat_mobileno'],'Consultant'=>$physicianmaster_datatable[$value['consultant_doctor']]); 
				$i++;
			} 
		} 
		
		echo json_encode($responce);
	}
	*/
	
	public function actionFetchdetails($id)
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
	}
	
	
	
	public function actionCancelsubvisit($subvisit1) 
	{
		$subvisit=SubVisit::find()->where(['refund_status'=>'NO'])->andWhere(['date(created_at)'=>date('Y-m-d')])->andWhere(['ucil_letter_status'=>''])->andWhere(['cons_status'=>'F'])->andWhere(['sub_visit'=>$subvisit1])->andWhere(['<>','net_amt' ,''])->asArray()->one();
		
		$fetch_array=array();
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
		}
		else 
		{
			$fetch_array[0]='F';
		}
		
		return json_encode($fetch_array);
		
	}	
	
	
	public function actionCancelkey1($id) 
	{
		$query = new Query;
		$query	->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.mr_no =sub_visit.mr_number')->where(['LIKE','newpatient.patientname',$id])->orWhere(['like','newpatient.pat_mobileno',$id])->orWhere(['LIKE','newpatient.mr_no',$id])->groupBy(['sub_visit.sub_id'])->orderBy(['sub_id'=>SORT_DESC])->limit(10)->all(); 
					
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
}
