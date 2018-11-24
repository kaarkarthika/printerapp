<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use backend\models\Finalbill;
use backend\models\FinalbillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
use backend\models\InRegistration;
use backend\models\InLabPaymentPrime;
use backend\models\InLabPayment;
use backend\models\InSales;
use backend\models\ServicesList;
use backend\models\PaymentMethod;
use yii\helpers\ArrayHelper;

/**
 * FinalbillController implements the CRUD actions for Finalbill model.
 */
class FinalbillController extends Controller
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
     * Lists all Finalbill models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinalbillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Finalbill model.
     * @param string $id
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
     * Creates a new Finalbill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Finalbill();
		$session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
        	
				//echo "<pre>"; print_r($_POST); die;
			
			$model->ipno=$_POST['Finalbill']['ipno'];
			$model->mrno=$_POST['Finalbill']['mrno'];
			$model->name=$_POST['Finalbill']['name'];
			$model->age=$_POST['Finalbill']['age'];
			$model->gender=$_POST['Finalbill']['gender'];
			$model->doa=$_POST['Finalbill']['doa'];
			$model->dod=$_POST['Finalbill']['dod'];
			$model->total_amt=$_POST['Finalbill']['total_amt'];
			$model->discount=$_POST['Finalbill']['discount'];
			$model->net_amount=$_POST['Finalbill']['net_amount'];
			$model->paid_amount=$_POST['Finalbill']['paid_amount'];
			$model->balance_amount=$_POST['Finalbill']['balance_amount'];
			$model->reason=$_POST['Finalbill']['reason'];
			$model->refundable=$_POST['Finalbill']['refundable'];
			$model->auth_by	=$_POST['Finalbill']['auth_by'];
			$model->remark=$_POST['Finalbill']['remark'];
			$model->status="Final";
			
			$model->created_date=date('Y-m-d H:i:s');
			$model->user_id	=$session['user_id'];
			$model->user_role=$session['user_role'];
			$model->ipaddress=$_SERVER['REMOTE_ADDR'];
			if($model->save()){
				echo "1";
			}else{
				echo "0";
				print_r($model->getErrors());die;	
			}
	    }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Finalbill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->autoid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Finalbill model.
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
     * Finds the Finalbill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Finalbill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Finalbill::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
	public function actionServicefetch()
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

		$ServicesList_count=ServicesList::find()->where(['is_active'=>'1'])->andWhere(['like','servicename',$s_val])->limit(100000)->asArray()->all();
		
		$ServicesList=ServicesList::find()->where(['is_active'=>'1'])->andWhere(['or',['like','servicename',$s_val]])->limit($length)->offset($sfd)->asArray()->all();
		
		$response='';
			
		if(!empty($ServicesList))
		{
			$fetch_array=array();
			$responce['draw']=$draw;
			$responce['recordsTotal']= $length;
			$responce['recordsFiltered']= count($ServicesList_count);
			foreach ($ServicesList as $key => $value) 
			{
				$responce['data'][]=array("servicename"=>$value['servicename'],"rate"=>$value['rate']);
			}
		}

		return json_encode($responce);
		die;
	}

public function actionAjaxipnumber($id)
    {
    	if(!empty($id))
		{
			$Newpatient=InRegistration::find()->select(['*'])->andWhere(['autoid'=>$id])->asArray()->one();
		}
		return $this->actionajaxipnumberselect($Newpatient['ip_no']);
		//return json_encode($Newpatient);
	}

	public function actionAjaxipnumberselect($id)
    {
    	//print_r($id); die;
		if(!empty($id))
		{
			$Newpatient['user']=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
			$Newpatient['roomdetails']=InChangeroom::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->all();
			$Newpatient['moneyreceiptslog']=IpMoneyreceiptsLog::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->all();
			$Newpatient['labpaymentprime']=InLabPaymentPrime::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
			$Newpatient['treatment']=InTreatmentOverall::find()->select(['*'])->andWhere(['subvisit_num'=>$id])->asArray()->one();
			$Newpatient['labpayment']=InLabPayment::find()->select(['*'])->andWhere(['lab_prime_id'=>$Newpatient['labpaymentprime']['lab_id']])->asArray()->all();
			$Newpatient['insale']=InSales::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
			$Newpatient['treatment_ind']=InTreatmentIndividual::find()->select(['*'])->andWhere(['treat_ove_id'=>$Newpatient['treatment']['id']])->asArray()->all();
			
			$Newpatient['service_amt']=InMedicalRecordingCharge::find()->select(['*'])->asArray()->all();
			$Newpatient['moneyreceipts']=IpMoneyreceipts::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->all();
			
			
	//	echo "<pre>"; print_r($Newpatient['moneyreceipts']); die;
				
			if(!empty($Newpatient))
			{
				$Newpatient['room']=""; $i=1;
				$Newpatient['room_total']="0";
				foreach ($Newpatient['roomdetails'] as $key => $value) {
  					$roomtype_name=InRoomtypes::find()->select(['*'])->andWhere(['autoid'=>$value['roomtype']])->asArray()->one();
					$roomno_det=InRoomno::find()->select(['*'])->andWhere(['autoid'=>$value['roomno']])->asArray()->one();
					$bedno_det=InBedno::find()->select(['*'])->andWhere(['autoid'=>$value['bedno']])->asArray()->one();
					$floor_det=InFloormaster::find()->select(['*'])->andWhere(['autoid'=>$value['floorno']])->asArray()->one();
					$Newpatient['room_total']=$Newpatient['room_total']+$roomtype_name['price'];
					//print_r($value); 
					 
					$Newpatient['room'].='<tr data-id="1" id="room_del'.$value['autoid'].'">
					<td style="width:8%;" class="text-center"><buton type="button" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow" data_price="'.$roomtype_name['price'].'" data_delete_row="'.$value['autoid'].'" id="delrow'.$value['autoid'].'"><i class="fa fa-remove"></i></button></td>
					<td style="width:5.3%;">'.$i++.'</td>
					<td style="width:10.1%;">'.$value['created_date'].'</td>
					<td style="width:10.3%;">'.$value['updated_date'].'</td>
					<td style="width:9.9%;">'.$value['paytype'].'</td>
					<td style="width:9%;">'.$roomtype_name['room_types'].'</td>
					<td style="width:6%;">'.$roomno_det['room_no'].'</td>
					<td style="width:5%;">'.$bedno_det['bedno'].'</td>
					<td style="width:7%;">'.$floor_det['floor_no'].'</td>
					<td style="width:5%;">'.$value['unit'].'</td>
					<td style="width:7%;">'.$roomtype_name['price'].'</td>
					<td style="width:5%;">0</td>
					<td style="width:6%;">0</td>
					<td>'.$roomtype_name['price'].'</td>
					</tr>';
				}
				
	// die;
				
				$Newpatient['total_service']="0";
				foreach ($Newpatient['moneyreceiptslog'] as $key => $value) {
					$Newpatient['total_service']=$Newpatient['total_service']+$value['total_amt'];
				}

//echo"<pre>";		 print_r($Newpatient['labpaymentprime']);  die;	
				$Newpatient['tbl_lap']="";
				 $i=1;
				foreach ($Newpatient['labpayment'] as $key => $value) {
					
					$Newpatient['tbl_lap'].='<tr data-id="1" id="lap_del'.$value['autoid'].'">
					<td class="text-center"><buton type="button" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrowlab" data_price="'.$value['net_amount'].'" data_delete_row="'.$value['autoid'].'" id="delrowlab'.$value['autoid'].'"><i class="fa fa-remove"></i></button></td>
					<td style="width:5.3%;">'.$i++.'</td>
					<td style="width:10.1%;">'.$value['created_at'].'</td>
					<td>'.$value['lab_common_id'].'</td>
					<td>'.$value['price'].'</td>
					<td> 0 </td>
					<td>'.$value['total_amount'].'</td>
					<td>'.$value['cgst_percentage'].'</td>
					<td>'.$value['gst_percentage'].'</td>
					<td>'.$value['cgst_amount'].'</td>
					<td>'.$value['sgst_amount'].'</td>
					<td>'.$value['discount_percent'].'</td>
					<td>'.$value['discount_amount'].'</td>
					<td>'.$value['net_amount'].'</td>
					</tr>';
				}
	// die;

			$Newpatient['tbl_treatent']="";
				 $i=1;
				foreach ($Newpatient['treatment_ind'] as $key =>$value ) {
					
					$Newpatient['tbl_treatent'].='<tr data-id="1" id="treatment_del'.$value['ind_id'].'">
					<td class="text-center"><buton type="button" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrowtreatment" data_price="'.$value['total_price'].'" data_delete_row="'.$value['ind_id'].'" id="delrowtreatment'.$value['ind_id'].'"><i class="fa fa-remove"></i></button></td>
					<td style="width:5.3%;">'.$i++.'</td>
					<td style="width:10.1%;">'.$value['created_at'].'</td>
					<td>'.$value['treatment_id'].'</td>
					<td>'.$value['rate'].'</td>
					<td> 0 </td>
					<td>'.$value['mrp'].'</td>
					<td>'.$value['cgst_percent'].'</td>
					<td>'.$value['sgst_percent'].'</td>
					<td>'.$value['cgst_value'].'</td>
					<td>'.$value['sgst_value'].'</td>
					<td>'.$value['discount_percent'].'</td>
					<td>'.$value['discountvalue'].'</td>
					<td>'.$value['total_price'].'</td>
					</tr>';
				}
 						
				
				$Newpatient['service_tbl']=""; $i=1;
				foreach ($Newpatient['service_amt'] as $key => $value) {
					// echo"<pre>"; print_r($value);
					$Newpatient['service_tbl'].='<tr data-id="1" id="service_del'.$value['autoid'].'">
					<td class="text-center"><buton type="button" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrowservice" data_price="'.$value['amount'].'" data_delete_row="'.$value['autoid'].'" id="delrowservice'.$value['autoid'].'"><i class="fa fa-remove"></i></button></td>
					<td style="width:5.3%;">'.$i++.'</td>
					<td style="width:10.1%;">'.$value['created_date'].'</td>
					<td>'.$value['name'].'</td>
					<td>0</td> <td>0</td>
					<td>'.$value['amount'].'</td>
					<td>0</td> <td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
					<td>'.$value['amount'].'</td>
					</tr>';
				}
				
				$Newpatient['money_re']=""; 
				$Newpatient['money_total']="0";
				$i=1;
			
				foreach ($Newpatient['moneyreceipts'] as $key => $value) {
					$payment=PaymentMethod::find()->where(['pm_autoid'=>$value['mode_of_payment']])->asArray()->one();
					//print_r($payment['methodname']); 
					$Newpatient['money_re'].='<tr data-id="1" id="money_'.$value['autoid'].'">
					<td>'.$value['created_at'].'</td>
					<td>'.$value['mr_no'].'</td>
					<td>'.$value['amount'].'</td>
					<td>'.$payment['methodname'].'</td>
					<td>'.$value['transaction_type'].'</td>
					</tr>';
					$Newpatient['money_total']=$Newpatient['money_total']+$value['amount'];
				}
				
 		//	die;
				
				return json_encode($Newpatient);
			}
		}
	}
	
}
