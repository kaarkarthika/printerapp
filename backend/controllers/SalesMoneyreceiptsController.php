<?php

namespace backend\controllers;

use Yii;
use backend\models\SalesMoneyreceipts;
use backend\models\SalesMoneyreceiptsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuthorityMaster;
use backend\models\Sales;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\Patienttype;
use backend\models\Patient;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Saledetail;
use backend\models\Stockrequest;
use backend\models\Vendor;
use backend\models\Stockmaster;
use backend\models\StockmasterSearch;
use backend\models\SalesSearch;
use backend\models\PatientSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\CompanyBranch;
use backend\models\BranchAdmin;
use backend\models\Productgrouping;
use backend\models\Physicianmaster;
use backend\models\Producttype;
use backend\models\Insurance;
use backend\models\Company;
use backend\models\StockresponseSearch;
use backend\models\Stockresponse;
use backend\models\Newpatient;
use backend\models\SubVisit;
use backend\models\TaxgroupingLog;
use common\models\LoginForm;
use backend\models\AutoidTable;
use backend\models\Taxgrouping;
use backend\models\SalesMoneyreceiptsLog;
use backend\models\Salesreturn;
use backend\models\Returndetail;
use backend\models\PaymentMethod;
use yii\db\Query;


/**
 * SalesMoneyreceiptsController implements the CRUD actions for SalesMoneyreceipts model.
 */
class SalesMoneyreceiptsController extends Controller
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
     * Lists all SalesMoneyreceipts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesMoneyreceiptsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesMoneyreceipts model.
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
     * Creates a new SalesMoneyreceipts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalesMoneyreceipts();
		
		$session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post())) {
        	
			//echo"<pre>";print_r($_POST); die;
			$model->mr_no=$_POST['SalesMoneyreceipts']['mr_no'];
			$model->total_paid=$_POST['SalesMoneyreceipts']['total_paid'];	
			$model->name=$_POST['SalesMoneyreceipts']['name'];
			$model->mobile_no=$_POST['SalesMoneyreceipts']['mobile_no'];
			$model->bill_number	=$_POST['SalesMoneyreceipts']['bill_number'];
			$model->pancard_no=$_POST['SalesMoneyreceipts']['pancard_no'];
			$model->cardholder_name=$_POST['SalesMoneyreceipts']['cardholder_name'];
			$model->service_tax=$_POST['SalesMoneyreceipts']['service_tax'];
			$model->prev_cashpaid=$_POST['SalesMoneyreceipts']['amount'];
			
			$model->bill_amount=$_POST['SalesMoneyreceipts']['bill_amount'];
			$model->amount	=$_POST['SalesMoneyreceipts']['amount'];
			$model->total_amount	=$_POST['SalesMoneyreceipts']['total_amount'];
			$model->mode_of_payment=$_POST['SalesMoneyreceipts']['mode_of_payment'];
			$model->card_cheque_no=$_POST['SalesMoneyreceipts']['card_cheque_no'];
			
			$model->card_name=$_POST['SalesMoneyreceipts']['card_name'];
			$model->bank_name=$_POST['SalesMoneyreceipts']['bank_name'];
			$model->payment_details=$_POST['SalesMoneyreceipts']['payment_details'];
			$model->amount_in_words=$_POST['SalesMoneyreceipts']['amount_in_words'];
			$model->remark=$_POST['SalesMoneyreceipts']['remark'];
			
			$model->default_amount=$_POST['SalesMoneyreceipts']['total_paid'];
			$model->status	="A";
			$model->updated_at=date('Y-m-d H:i:s');
			$model->created_at=date('Y-m-d H:i:s');
			$model->user_id=$session['user_id'];
			$model->authority="A";
			$model->ip_address=$_SERVER['REMOTE_ADDR'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			if($model->save()){
				$res[0]="saved";
				$res[1]="2";
				return json_encode($res); 
			}else{
					print_r($model->getErrors()); die;
				}
			
            //return $this->redirect(['create', 'id' => $model->autoid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

public function actionSaveval($id)
    {
    	
        $model =SalesMoneyreceipts::find()->where(['bill_number'=>$id])->one();
		if(empty($model)){
			$model =new SalesMoneyreceipts();
		}
		$model_log=new SalesMoneyreceiptsLog();
		$session = Yii::$app->session;
		//echo"<pre>";print_r($_POST); die;
        if (!empty($_POST)) {
        	
			$model->mr_no=$_POST['SalesMoneyreceipts']['mr_no'];
			$model->total_paid=$_POST['SalesMoneyreceipts']['total_paid'];	
			$model->name=$_POST['SalesMoneyreceipts']['name'];
			$model->mobile_no=$_POST['SalesMoneyreceipts']['mobile_no'];
			$model->bill_number	=$_POST['SalesMoneyreceipts']['bill_number'];
			$model->pancard_no=$_POST['SalesMoneyreceipts']['pancard_no'];
			$model->cardholder_name=$_POST['SalesMoneyreceipts']['cardholder_name'];
			$model->service_tax=$_POST['SalesMoneyreceipts']['service_tax'];
			$model->prev_cashpaid=$_POST['SalesMoneyreceipts']['amount'];
			
			$model->bill_amount=$_POST['SalesMoneyreceipts']['bill_amount'];
			$model->amount	=$_POST['SalesMoneyreceipts']['amount'];
			$model->total_amount	=$_POST['SalesMoneyreceipts']['total_amount'];
			$model->mode_of_payment=$_POST['SalesMoneyreceipts']['mode_of_payment'];
			$model->card_cheque_no=$_POST['SalesMoneyreceipts']['card_cheque_no'];
			
			$model->card_name=$_POST['SalesMoneyreceipts']['card_name'];
			$model->bank_name=$_POST['SalesMoneyreceipts']['bank_name'];
			$model->payment_details=$_POST['SalesMoneyreceipts']['payment_details'];
			$model->amount_in_words=$_POST['SalesMoneyreceipts']['amount_in_words'];
			$model->remark=$_POST['SalesMoneyreceipts']['remark'];
			
			$model->default_amount=$_POST['SalesMoneyreceipts']['total_paid'];
			$model->status	="A";
			$model->updated_at=date('Y-m-d H:i:s');
			$model->created_at=date('Y-m-d H:i:s');
			$model->user_id=$session['user_id']; 
			$model->authority=$_POST['SalesMoneyreceipts']['authority'];
			$model->ip_address=$_SERVER['REMOTE_ADDR'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			if($model->save()){
				
				if($model->amount!=0){
					$model_log->mr_no=$_POST['SalesMoneyreceipts']['mr_no'];
					$model_log->sales_money=$model->autoid;
					$model_log->total_paid=$_POST['SalesMoneyreceipts']['total_paid'];	
					$model_log->bill_number	=$_POST['SalesMoneyreceipts']['bill_number'];
					$model_log->prev_cashpaid=$_POST['SalesMoneyreceipts']['amount'];
					$model_log->mode_of_payment=$_POST['SalesMoneyreceipts']['mode_of_payment'];
					$model_log->bill_amount=$_POST['SalesMoneyreceipts']['bill_amount'];
					$model_log->amount	=$_POST['SalesMoneyreceipts']['amount'];
					$model_log->total_amount	=$_POST['SalesMoneyreceipts']['total_amount'];
					$model_log->remark=$_POST['SalesMoneyreceipts']['remark'];
					$model_log->created_at=date('Y-m-d H:i:s');
					$model_log->user_id=$session['user_id'];
					$model_log->ip_address=$_SERVER['REMOTE_ADDR'];
					if($model_log->save()){
						$res[0]="saved";
						$res[1]="2";
						return json_encode($res);
					}else{
						print_r($model_log->getErrors()); die;
					}
				}else{
					$res[0]="notsave";
						$res[1]="1";
						return json_encode($res);
				}
			}else{
					print_r($model->getErrors()); die;
				}
			
            //return $this->redirect(['create', 'id' => $model->autoid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SalesMoneyreceipts model.
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
     * Deletes an existing SalesMoneyreceipts model.
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
     * Finds the SalesMoneyreceipts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SalesMoneyreceipts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesMoneyreceipts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionOpmoneydetails($id)
    {
         $value=Sales::find()->where(['billnumber'=>$id])->asArray()->one();
          $fetch_array=array();
          if(!empty($value))
            {       

            $sales_detail=Saledetail::find()->where(['opsaleid'=>$value['opsaleid']])->asArray()->all();
			$salesmoneylog=SalesMoneyreceiptsLog::find()->where(['bill_number'=>$id])->asArray()->all();
			$salesmoney=SalesMoneyreceipts::find()->where(['bill_number'=>$id])->asArray()->one();
			$pre_paid=0;
			foreach ($salesmoneylog as $key => $value1) {
				$pre_paid=$pre_paid+$value1['prev_cashpaid'];
			}
			     
                    $insurance="";
                    $insurancelist = Insurance::findOne($value['insurancetype']);
                    if($insurancelist){
                        $insurance = $insurancelist->insurance_type;
                    }
			$i=1;		
		if(!empty($salesmoneylog)){
			foreach ($salesmoneylog as $key => $value2) {
				$payment = PaymentMethod::find()->select(['methodname'])->where(['pm_autoid'=>$value2['mode_of_payment']])->asArray()->one();
				$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$value2['user_id']])->asArray()->one();
				
				$originalDate = $value2['created_at'];
				$newDate = date("d-m-Y h:i:s ", strtotime($originalDate));

				$fetch_array['money_re'].='<tr >
					<td>'.$i++.'</td>
					<td>'.$newDate.'</td>
					<td>'.$value2['prev_cashpaid'].'</td>
					<td>'.$branch_det['ba_name'].'</td>
					<td>'.$value2['remark'].'</td>
					<td>'.$payment['methodname'].'</td>
					<td>'.$value2['ip_address'].'</td>
					</tr>';
				}
		}else{
			$fetch_array['money_re'].='<tr><td colspan="7">No Records</td></tr>';
		}
		$fetch_array[0]= $value;
		$fetch_array[1]= $insurance;
		$fetch_array[2]= $pre_paid;
		$fetch_array[3]=$salesmoney;
        	//echo "<pre>"; print_r($fetch_array); die;
        }
            return json_encode($fetch_array);
    }
}
