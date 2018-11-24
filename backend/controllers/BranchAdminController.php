<?php

namespace backend\controllers;

use Yii;
use backend\models\BranchAdmin;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use backend\models\CompanyBranch;
use yii\helpers\ArrayHelper;

use backend\models\AuthUserRole;



class BranchAdminController extends Controller
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
  
    public function actionIndex()
    {
        $searchModel = new BranchAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		 
		

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
            
        ]);
    }
	
	public function actionProfile()
    {
        $searchModel = new BranchAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('profile', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider ]);
    }

  
    public function actionView($id)
    {
        return $this->renderAjax('view', [  'model' => $this->findModel($id)]);
          
       
    }


    public function actionCreate()
    {
    	
        $model = new BranchAdmin();

      if($model->load(Yii::$app->request->post())) {
      	
			
			
		
            $password=Yii::$app->request->post('BranchAdmin')['password_hash'];
			$username = Yii::$app->request->post('BranchAdmin')['ba_name'];
			$model->password_hash = Yii::$app->security->generatePasswordHash($password);
			$model->ba_branchid =Yii::$app->request->post('BranchAdmin')['ba_branchid'];
            $model->ba_createdat=date("Y-m-d h:i:s");
			$exists=BranchAdmin::find()->where(['ba_name'=>$username])->one();
			$model->ba_code="";
			$model->status=0;
			$model->auth_key=Yii::$app->security->generateRandomString();
			if(count($exists)>0){
				return   "E";
			}
			else if($model->save()){
				
				return   "Y";
			}else{
				return  "N";
			}
           
        } 
	  
        
        else {
        	 $companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
			$userrolelist=ArrayHelper::map(AuthUserRole::find()->all(),'rolecode','rolename');
            return $this->renderAjax('create', [
                'model' => $model,
                'companylist'=>$companylist,
                'userrolelist'=>$userrolelist,
            ]);
        }
		
		
		
    }

 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
     if ($model->load(Yii::$app->request->post())) {
			$username = Yii::$app->request->post('BranchAdmin')['ba_name'];
			
			 $password=Yii::$app->request->post('BranchAdmin')['password_hash'];
			 if(!empty($password))
			 {
			 	$model->password_hash = Yii::$app->security->generatePasswordHash($password);
			 }
			 else{
			 	$data=BranchAdmin::find()->where(['ba_autoid'=>$id])->one();
				 $pwd=$data->password_hash;
				 $model->password_hash=$pwd;
			 }
			 
			 $model->auth_key=Yii::$app->security->generateRandomString();
			$model->ba_branchid =Yii::$app->request->post('BranchAdmin')['ba_branchid'];
			$model->ba_code="";
				
            $model->ba_createdat=date("Y-m-d h:i:s");
			$exists=BranchAdmin::find()->where(['ba_name'=>$username])->andwhere(['!=','ba_autoid',$id])->one();
			
			
			if(count($exists)>0){
				return   "E";
			}
			else if($model->save()){
				
				return   "Y";
			}
			else{
				return  "N";
			}
			
        } 
        
        else {
             $companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
			$userrolelist=ArrayHelper::map(AuthUserRole::find()->all(),'rolecode','rolename');
            return $this->renderAjax('update', [
                'model' => $model,
                'companylist'=>$companylist,
                'userrolelist'=>$userrolelist,
            ]);
           }
    }


    public function actionDelete($id)
    {
       $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = BranchAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	

	
}
