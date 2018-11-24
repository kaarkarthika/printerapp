<?php

namespace backend\controllers;

use Yii;
use backend\models\IpMoneyreceipts;
use backend\models\IpMoneyreceiptsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\InRegistration;
use backend\models\InRegistrationSearch;


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

use backend\models\InMedicalRecordingCharge;
use backend\models\InCategorygroup;
use backend\models\Specialistdoctor;

/**
 * IpMoneyreceiptsController implements the CRUD actions for IpMoneyreceipts model.
 */
class IpMoneyreceiptsController extends Controller
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
     * Lists all IpMoneyreceipts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IpMoneyreceiptsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IpMoneyreceipts model.
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
     * Creates a new IpMoneyreceipts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IpMoneyreceipts();

        if ($model->load(Yii::$app->request->post())) {
           // echo "<pre>"; print_r($_POST); die;
            $session = Yii::$app->session;
            $model->ip_no                = $_POST['ip_number'];
            $model->transaction_type = $_POST['IpMoneyreceipts']['transaction_type'];
            $model->mr_no            = $_POST['IpMoneyreceipts']['mr_no'];
            $model->bill_number      = $_POST['IpMoneyreceipts']['bill_number'];
            $model->bed_no           = $_POST['IpMoneyreceipts']['bed_no'];
            $model->total_paid       = $_POST['IpMoneyreceipts']['total_paid'];
            $model->name             = $_POST['IpMoneyreceipts']['name'];
            $model->mobile_no        = $_POST['IpMoneyreceipts']['mobile_no'];
            $model->pancard_no       = $_POST['IpMoneyreceipts']['pancard_no'];
            $model->cardholder_name  = $_POST['IpMoneyreceipts']['cardholder_name'];
            $model->service_tax      = $_POST['IpMoneyreceipts']['service_tax'];
            $model->admission_status = $_POST['IpMoneyreceipts']['admission_status'];
            $model->prev_cashpaid    = $_POST['IpMoneyreceipts']['prev_cashpaid'];
            $model->bill_amount      = $_POST['IpMoneyreceipts']['bill_amount'];
            $model->amount           = $_POST['IpMoneyreceipts']['amount'];
            $model->total_amount     = $_POST['IpMoneyreceipts']['total_amount'];
            $model->mode_of_payment  = $_POST['IpMoneyreceipts']['mode_of_payment'];
            $model->card_cheque_no   = $_POST['IpMoneyreceipts']['card_cheque_no'];
            $model->bank_name        = $_POST['IpMoneyreceipts']['amount_in_words'];
            $model->amount_in_words  = $_POST['IpMoneyreceipts']['bank_name'];
            $model->remark           = $_POST['IpMoneyreceipts']['remark']; 
            $model->ip_address       = $_SERVER['REMOTE_ADDR'];
            $model->user_id          = $session['user_id']; 
            $model->created_at       = date('Y-m-d H:i:s');
             if($model->save()){

            }else{
              echo "<pre>"; print_r($model->getErrors()); die;
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IpMoneyreceipts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $session = Yii::$app->session;
            $model->ip_no            = $_POST['ip_number'];
            $model->transaction_type = $_POST['IpMoneyreceipts']['transaction_type'];
            $model->mr_no            = $_POST['IpMoneyreceipts']['mr_no'];
            $model->bill_number      = $_POST['IpMoneyreceipts']['bill_number'];
            $model->bed_no           = $_POST['IpMoneyreceipts']['bed_no'];
            $model->total_paid       = $_POST['IpMoneyreceipts']['total_paid'];
            $model->name             = $_POST['IpMoneyreceipts']['name'];
            $model->mobile_no        = $_POST['IpMoneyreceipts']['mobile_no'];
            $model->pancard_no       = $_POST['IpMoneyreceipts']['pancard_no'];
            $model->cardholder_name  = $_POST['IpMoneyreceipts']['cardholder_name'];
            $model->service_tax      = $_POST['IpMoneyreceipts']['service_tax'];
            $model->admission_status = $_POST['IpMoneyreceipts']['admission_status'];
            $model->prev_cashpaid    = $_POST['IpMoneyreceipts']['prev_cashpaid'];
            $model->bill_amount      = $_POST['IpMoneyreceipts']['bill_amount'];
            $model->amount           = $_POST['IpMoneyreceipts']['amount'];
            $model->total_amount     = $_POST['IpMoneyreceipts']['total_amount'];
            $model->mode_of_payment  = $_POST['IpMoneyreceipts']['mode_of_payment'];
            $model->card_cheque_no   = $_POST['IpMoneyreceipts']['card_cheque_no'];
            $model->bank_name        = $_POST['IpMoneyreceipts']['amount_in_words'];
            $model->amount_in_words  = $_POST['IpMoneyreceipts']['bank_name'];
            $model->remark           = $_POST['IpMoneyreceipts']['remark']; 
            $model->updated_ipaddress= $_SERVER['REMOTE_ADDR'];
            $model->user_id          = $session['user_id']; 
           // $model->created_at       = date('Y-m-d H:i:s');
            if($model->save()){

            }else{
                echo "<pre>"; print_r($model->getErrors()); die;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IpMoneyreceipts model.
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
     * Finds the IpMoneyreceipts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IpMoneyreceipts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IpMoneyreceipts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
public function actionInipfetchmrnumber($id)
    {
    	
    if(!empty($id))
	{
    	$new_patient=InRegistration::find()->where(['autoid'=>$id])->asArray()->one();
		
		$ippaylog = IpMoneyreceiptsLog::find()->where(['ip_no'=>$new_patient['ip_no']])->asArray()->all();
		$prev_ippay = IpMoneyreceipts::find()->where(['ip_no'=>$new_patient['ip_no']])->asArray()->all();
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
			
						
		if(!empty($new_patient))
		{
			$insurance=Insurance::find()->where(['insurance_typeid'=>$new_patient['type']])->andWhere(['is_active'=>1])->one();
			
			$fetch_array=array();
			$fetch_array[0]=$new_patient;
			$fetch_array[1]=$insurance['insurance_type'];
			$fetch_array[2] = $amounts;
				
			//echo"<pre>";print_r($fetch_array);die;
			return json_encode($fetch_array);
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
	
}
