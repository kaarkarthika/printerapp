<?php

namespace backend\controllers;

use Yii;
use backend\models\InTreatmentOverall;
use backend\models\InTreatmentOverallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
use backend\models\AuthorityMaster;

use backend\models\InTreatmentIndividual;
use backend\models\Treatment;
use backend\models\TaxgroupingLog;
use backend\models\InProcedureCancelation;
use backend\models\InProcCanIndividual;
use backend\models\InRegistration;
use backend\models\BranchAdmin;
use backend\models\Patienttype;
use backend\models\AutoidTable;
use backend\models\IpMoneyreceiptsLog;
/**
 * InTreatmentOverallController implements the CRUD actions for InTreatmentOverall model.
 */
class InTreatmentOverallController extends Controller
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
     * Lists all InTreatmentOverall models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InTreatmentOverallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InTreatmentOverall model.
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
     * Creates a new InTreatmentOverall model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InTreatmentOverall();
		$newpatient= new Newpatient();
		$treatmentindividual= new InTreatmentIndividual();
		
		 $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post())) 
        {
        echo "<pre>"; print_r($_POST); die;
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
				$model->name=$in_registration['patient_name'];
				$model->ip_no=$in_registration['ip_no'];
				$model->dob=date('Y-m-d',strtotime($in_registration['dob']));
				$model->gender=$in_registration['sex'];
				$model->physicianname=$in_registration['consultant_dr'];
				$model->mrnumber=$in_registration['mr_no'];
				$model->patient_id=$in_registration['pat_id'];
				$model->subvisit_id=$in_registration['autoid'];
				$model->subvisit_num=$in_registration['ip_no'];
				$model->insurancetype=$in_registration['insurance_type'];
				$model->address=$in_registration['address'];
				$model->phonenumber=$in_registration['phone_no'];
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
					

					/**********       LOG SAVE     **************/
					$money_reciept_log = new IpMoneyreceiptsLog();
					$money_reciept_log->mr_no = $in_registration['mr_no'];
					$money_reciept_log->ip_no = $in_registration['ip_no'];
					$money_reciept_log->total_amt = $model->overall_net_amount;
					$money_reciept_log->action = 'IPProcedure';
					$money_reciept_log->bill_number = $model->billnumber;
					$money_reciept_log->created_date = date('Y-m-d H:i:s');
					$money_reciept_log->user_id = $session['user_id'];;
					$money_reciept_log->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($money_reciept_log->save()){

					return 'S';
				}else{
						print_r($money_reciept_log->getErrors());die;	
				}
				} 
				else {
						print_r($model->getErrors());die;	
				}
				
			}else{
			//	echo "asdasd"; die;
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
			
			$authority_master=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname');
			
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
                'authority_master' => $authority_master,
            ]);
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

	public function actionAjaxipnumberselectblockipentries($id)
    {
    	
		if(!empty($id))
		{
    		$Newpatient=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$id])->asArray()->one();
			
			$sub_visit=SubVisit::find()->where(['mr_number'=>$Newpatient['mr_no']])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
			
			if(!empty($Newpatient))
			{
				$physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
				$insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();

				$patienttype=Patienttype::find()->where(['is_active'=>1])
					->andWhere(['type_id'=>$Newpatient['type']])->asArray()->one();

				$response[0] = $Newpatient;
				$response[1] = $physicianmaster;
				$response[2] = $insurance['insurance_type'];
				$response[3] = $patienttype;
				
			/*if(!empty($Newpatient))
			{
				$physicianmaster=Physicianmaster::find()->where(['id'=>$Newpatient['consultant_dr']])->asArray()->one();
				$physicianmaster1=Physicianmaster::find()->where(['id'=>$Newpatient['co_consultant']])->asArray()->one();

				$patienttype=Patienttype::find()->where(['is_active'=>1])
					->andWhere(['type_id'=>$Newpatient['type']])->asArray()->one();

				$response[0] = $Newpatient;
				$response[1] = $physicianmaster;
				$response[2] = $physicianmaster1;
				$response[3] = $patienttype;*/
				return json_encode($response);
			}
		}
	}
	
	public function actionAjaxipnumberselectblockipentriesdata($id)
    {
    	
		if(!empty($id))
		{
    		$getipno=InRegistration::find()->select(['ip_no'])->andWhere(['autoid'=>$id])->asArray()->one();
			$Newpatient=InRegistration::find()->select(['*'])->andWhere(['ip_no'=>$getipno['ip_no']])->asArray()->one();
			
			$sub_visit=SubVisit::find()->where(['mr_number'=>$Newpatient['mr_no']])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
			
			if(!empty($Newpatient))
			{
				$physicianmaster=Physicianmaster::find()->where(['id'=>$sub_visit['consultant_doctor']])->asArray()->one();
				$insurance=Insurance::find()->where(['insurance_typeid'=>$sub_visit['insurance_type']])->asArray()->one();

				$patienttype=Patienttype::find()->where(['is_active'=>1])
					->andWhere(['type_id'=>$Newpatient['type']])->asArray()->one();

				$response[0] = $Newpatient;
				$response[1] = $physicianmaster;
				$response[2] = $insurance['insurance_type'];
				$response[3] = $patienttype;
			//	echo "<pre>"; print_r($response); die;	
				return json_encode($response);
			}
		}
	}
	
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
	

    /**
     * Updates an existing InTreatmentOverall model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InTreatmentOverall model.
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
     * Finds the InTreatmentOverall model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InTreatmentOverall the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InTreatmentOverall::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
