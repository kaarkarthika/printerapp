<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyBranch;
use backend\models\Company;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\CompanyGst;
use backend\models\States;
use backend\models\CompanyBranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;
class CompanyBranchController extends Controller
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
                            'access' => [
           'class' => AccessControl::className(),
           'rules' => [
               [
                   'allow' => true,
                   'roles' => ['@'],
               ],

               // ...
           ],
       ],
        ];
    }
	 
 
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  


    /**
     * Lists all CompanyBranch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyBranchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyBranch model.
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
     * Creates a new CompanyBranch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyBranch();

        if ($model->load(Yii::$app->request->post())) {
			if(Yii::$app->request->post('CompanyBranch')['is_head_office']==1){
			$companyid=Yii::$app->request->post('CompanyBranch')['company_id'];
			$branch=CompanyBranch::find()->where(['is_head_office'=>1,'company_id'=>$companyid])->all();
				foreach ($branch as $key => $value) {
					$value->is_head_office=0;
					$value->save();
				}
			}
            $model->branch_code=trim(Yii::$app->request->post('CompanyBranch')['branch_code']);		
			$model->branch_name=trim(ucwords(Yii::$app->request->post('CompanyBranch')['branch_name']));	
			$model->address1=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address1']));	
			$model->address2=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address2']));	
			$model->address3=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address3']));	
			$model->city=trim(ucwords(Yii::$app->request->post('CompanyBranch')['city']));	
			$model->pincode=trim(ucwords(Yii::$app->request->post('CompanyBranch')['pincode']));	
			$model->gst_number=trim(ucwords(Yii::$app->request->post('CompanyBranch')['gst_number']));
		
        	$session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
			if($model->save()){
				 Yii::$app->getSession()->setFlash('success','Company Branch Added successfully');
				 return $this->redirect(['index']);
				
			}else{
				$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			
            return $this->render('create', [
                'model' => $model,
                'companylist'=>$companylist,
               
            ]);
			}
           
        } else {
        	
			$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			
            return $this->render('create', [
                'model' => $model,
                'companylist'=>$companylist,
               
            ]);
        }
    }

    /**
     * Updates an existing CompanyBranch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
		if(Yii::$app->request->post('CompanyBranch')['is_head_office']==1){
			$companyid=Yii::$app->request->post('CompanyBranch')['company_id'];
			$branch=CompanyBranch::find()->where(['is_head_office'=>1,'company_id'=>$companyid])->all();
				foreach ($branch as $key => $value) {
					$value->is_head_office=0;
					$session = Yii::$app->session;
        	        $value->updated_by=$session['user_id'];
					$value->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			        $value->updated_on=date("Y-m-d H:i:s");
					$value->save();
				}
			}
            $model->branch_code=trim(Yii::$app->request->post('CompanyBranch')['branch_code']);		
			$model->branch_name=trim(ucwords(Yii::$app->request->post('CompanyBranch')['branch_name']));	
			$model->address1=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address1']));	
			$model->address2=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address2']));	
			$model->address3=trim(ucwords(Yii::$app->request->post('CompanyBranch')['address3']));	
			$model->city=trim(ucwords(Yii::$app->request->post('CompanyBranch')['city']));	
			$model->pincode=trim(ucwords(Yii::$app->request->post('CompanyBranch')['pincode']));	
			$model->gst_number=trim(ucwords(Yii::$app->request->post('CompanyBranch')['gst_number']));	
		
 		    $session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
			if($model->save()){
				
				 Yii::$app->getSession()->setFlash('success','Company Branch Updated successfully');
				 return $this->redirect(['index']);
				
				
			}else{
				
			$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			 $rows = CompanyBranch::find()->where(['branch_id' => $id])->one();
			 $companyid=$rows->company_id;
			 $rows2=CompanyGst::find()->where(['company_id' => $companyid])->andwhere(['isactive'=>1])->all();
			 
            foreach($rows2 as $row){
            	
				 $rows1[] =$row->stateid;
                
            }
			$states= implode(",",$rows1);
			$statelist=ArrayHelper::map(States::find()->where('stateid IN('.$states.')')->asArray()->all(),'stateid','state_name');
			
			
            return $this->render('update', [ 'model' => $model, 'companylist'=>$companylist,'statelist'=>$statelist]);
			
			
			}
		   
		   
        } else {
        	
			$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			 $rows = CompanyBranch::find()->where(['branch_id' => $id])->one();
			 $companyid=$rows->company_id;
			 $rows2=CompanyGst::find()->where(['company_id' => $companyid])->andwhere(['isactive'=>1])->all();
			 
            foreach($rows2 as $row){
            	
				 $rows1[] =$row->stateid;
                
            }
			$states= implode(",",$rows1);
			$statelist=ArrayHelper::map(States::find()->where('stateid IN('.$states.')')->asArray()->all(),'stateid','state_name');
			
			
            return $this->render('update', [ 'model' => $model, 'companylist'=>$companylist,'statelist'=>$statelist]);
        }    
        
    }

    /**
     * Deletes an existing CompanyBranch model.
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
    	
		 $rows = CompanyGst::find()->where(['company_id' => $id])->andwhere(['isactive'=>1])->all();
		
		 echo "<option value=''>--Select State--</option>";
 
        if(count($rows)>0){
            foreach($rows as $row){
            	
				 $rows1 = States::find()->where(['stateid' => $row->stateid])->one();
                echo "<option value='$rows1->stateid'>$rows1->state_name</option>";
            }
        }
        else{
            echo "<option>State Not Available for this Company.</option>";
        }
		
	}
	
	public function actionGetgst($id)
    {
    	 $rows = CompanyGst::find()->where(['stateid' => $id])->andwhere(['isactive'=>1])->one();
		 if(count($rows)>0){
		 	echo $rows->gst;
		 }else{
		 	echo"";
		 }
		
	}

    /**
     * Finds the CompanyBranch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyBranch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyBranch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
