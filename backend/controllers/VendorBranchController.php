<?php

namespace backend\controllers;

use Yii;
use backend\models\VendorBranch;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\VendorBranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\States;
use backend\models\Vendor;
use backend\models\BranchAdmin;
use backend\models\VendorGst;
use yii\widgets\ActiveForm;
class VendorBranchController extends Controller
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
	
	
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  

    public function actionIndex()
    {
        $searchModel = new VendorBranchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		 $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vendorlist'=>$vendorlist,
        ]);
    }

    /**
     * Displays a single VendorBranch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VendorBranch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VendorBranch();

        if ($model->load(Yii::$app->request->post()) ) {
        	
			 if(Yii::$app->request->isAjax){
			 	
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              return ActiveForm::validate($model);
            }
			
			
        	
        	if(Yii::$app->request->post('VendorBranch')['is_headoffice']==1){
			$vendorid=Yii::$app->request->post('VendorBranch')['vendorid'];
			$branch=VendorBranch::find()->where(['is_headoffice'=>1,'vendorid'=>$vendorid])->all();
				foreach ($branch as $key => $value) {
					$value->is_headoffice=0;
					$value->save();
				}
			}


			$model->branchcode=trim(Yii::$app->request->post('VendorBranch')['branchcode']);
			$model->branchname=trim(ucwords(Yii::$app->request->post('VendorBranch')['branchname']));
			$model->branch_emailid=trim(strtolower(Yii::$app->request->post('VendorBranch')['branch_emailid']));
			$model->branch_phonenumber=trim(Yii::$app->request->post('VendorBranch')['branch_phonenumber']);
			$model->address1=trim(ucwords(Yii::$app->request->post('VendorBranch')['address1']));
			$model->address2=trim(ucwords(Yii::$app->request->post('VendorBranch')['address2']));
			$model->city=trim(ucwords(Yii::$app->request->post('VendorBranch')['city']));
			$model->contact_person=trim(ucwords(Yii::$app->request->post('VendorBranch')['contact_person']));
			$model->person_mobilenumber=trim(ucwords(Yii::$app->request->post('VendorBranch')['person_mobilenumber']));
			
		
			$model->pincode=trim(Yii::$app->request->post('VendorBranch')['pincode']);
			$model->gstnumber=trim(Yii::$app->request->post('VendorBranch')['gstnumber']);
			$model->bankname=trim(strtoupper(Yii::$app->request->post('VendorBranch')['bankname']));
			$model->ifsccode=trim(Yii::$app->request->post('VendorBranch')['ifsccode']);
			$model->accnumber=trim(Yii::$app->request->post('VendorBranch')['accnumber']);
		    $model->igstpercent=trim(Yii::$app->request->post('VendorBranch')['igstpercent']);
			
        	$session = Yii::$app->session;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save()){
				 Yii::$app->getSession()->setFlash('success','Vendor Branch Created Successfully');
				return $this->redirect(['index']);
			}
			
			else{
				$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
			 $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
            return $this->render('create', [
                'model' => $model,
                'statelist'=>$statelist,
                'vendorlist'=>$vendorlist,
            ]);
			}
        	
           
        }
        else {
        	$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
			 $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
            return $this->render('create', [
                'model' => $model,
                'statelist'=>$statelist,
                'vendorlist'=>$vendorlist,
            ]);
        }
    }

    /**
     * Updates an existing VendorBranch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
           if ($model->load(Yii::$app->request->post()) ) {
           	
			 if(Yii::$app->request->isAjax){
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
               return ActiveForm::validate($model);
            }
        	
        	if(Yii::$app->request->post('VendorBranch')['is_headoffice']==1){
        		$vendorid=Yii::$app->request->post('VendorBranch')['vendorid'];
			$branch=VendorBranch::find()->where(['is_headoffice'=>1,'vendorid'=>$vendorid])->all();
				foreach ($branch as $key => $value) {
					$value->is_headoffice=0;
					$value->save();
				}
			}
			$model->branchcode=trim(Yii::$app->request->post('VendorBranch')['branchcode']);
			$model->branchname=trim(ucwords(Yii::$app->request->post('VendorBranch')['branchname']));
			$model->branch_emailid=trim(strtolower(Yii::$app->request->post('VendorBranch')['branch_emailid']));
			$model->branch_phonenumber=trim(Yii::$app->request->post('VendorBranch')['branch_phonenumber']);
			$model->address1=trim(ucwords(Yii::$app->request->post('VendorBranch')['address1']));
			$model->address2=trim(ucwords(Yii::$app->request->post('VendorBranch')['address2']));
			$model->city=trim(ucwords(Yii::$app->request->post('VendorBranch')['city']));
			$model->contact_person=trim(ucwords(Yii::$app->request->post('VendorBranch')['contact_person']));
			$model->person_mobilenumber=trim(ucwords(Yii::$app->request->post('VendorBranch')['person_mobilenumber']));
		
			$model->pincode=trim(Yii::$app->request->post('VendorBranch')['pincode']);
			$model->gstnumber=trim(Yii::$app->request->post('VendorBranch')['gstnumber']);
			$model->bankname=trim(strtoupper(Yii::$app->request->post('VendorBranch')['bankname']));
			$model->ifsccode=trim(Yii::$app->request->post('VendorBranch')['ifsccode']);
			$model->accnumber=trim(Yii::$app->request->post('VendorBranch')['accnumber']);
			 $model->igstpercent=trim(Yii::$app->request->post('VendorBranch')['igstpercent']);
			
			
        	 $session = Yii::$app->session;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save()){
				 Yii::$app->getSession()->setFlash('success','Vendor Branch Updated Successfully');
				 return $this->redirect(['index']);
			}
			
			else{
				$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
			 $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
            return $this->render('create', [
                'model' => $model,
                'statelist'=>$statelist,
                'vendorlist'=>$vendorlist,
            ]);
			}
        	
           
        }
		
		 else {
        	$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
			 $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
            return $this->render('update', [
                'model' => $model,
                'statelist'=>$statelist,
                 'vendorlist'=>$vendorlist,
            ]);
        }
    }

    /**
     * Deletes an existing VendorBranch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

   public function actionGetstate($id)
    {
    	
		 $rows = VendorGst::find()->where(['vendor_id' => $id])->andwhere(['is_active'=>1])->all();
		
		 echo "<option value=''>--Select State--</option>";
 
        if(count($rows)>0){
            foreach($rows as $row){
            	
				 $rows1 = States::find()->where(['stateid' => $row->state])->one();
                echo "<option value='$rows1->stateid'>$rows1->state_name</option>";
            }
        }
        else{
            echo "<option>State Not Available for this Company.</option>";
        }
		
	}
	
		public function actionGetgst($id,$vendorid)
    {
    	 $rows = VendorGst::find()->where(['state' => $id])->andwhere(['is_active'=>1])->andwhere(['vendor_id'=>$vendorid])->one();
		 if(count($rows)>0){
		 	echo $rows->gst_tax;
		 }else{
		 	echo"";
		 }
		
	}
    protected function findModel($id)
    {
        if (($model = VendorBranch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
