<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
 use backend\models\BranchAdmin;
/**
 * AuthProjectModuleController implements the CRUD actions for AuthProjectModule model.
 */
class AuthProjectModuleController extends Controller
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
        $searchModel = new AuthProjectModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	 public function actionBilling()
    {
        $searchModel = new AuthProjectModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('billing', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionDraft()
    {
        $searchModel = new AuthProjectModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
public function actionJsgridindex()
{
    \Yii::$app->response->format = Response::FORMAT_JSON;
    $jsondata =AuthProjectModule::find()->all();
    return $jsondata;
}

    /**
     * Displays a single AuthProjectModule model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthProjectModule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthProjectModule();

        if ($model->load(Yii::$app->request->post()) ) 
        {
        if($model->save())
		   {
		   	echo "Y";
			
		   }
		   else{
		   	echo "N";
			 
			
		   }
        } 
		
		
		
        else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
	    public function actionGridcreate()
    {
        $model = new AuthProjectModule();

        if($_POST){
        
        
		   $model->moduleName=$_POST["moduleName"];
		    $model->moduleCode=$_POST["moduleCode"];
			 $model->moduleMultiple=$_POST["moduleMultiple"];
			  $model->moduelRoot=$_POST["moduelRoot"];
			   $model->userAction=$_POST["userAction"];
			    $model->FAIcon=$_POST["FAIcon"];
				 $model->sortOrder=$_POST["sortOrder"];
				  
		   
        	
           if($model->save())
		   {
		   return 1;
		   }
		   else{
		   return 0;
		   }
			
			
        } 
		
		
		
        else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthProjectModule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) 
        
     
        {
           if($model->save())
		   {
		   	echo "Y";
		   }
		   else{
		   	echo "N";
		   }
			
			
        } 
		
        
        
        else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }
	
	    public function actionGridupdate($id)
    {
        $model = $this->findModel($id);
		

      if($_POST){
        
           $model->p_autoid=$id;
		   $model->moduleName=$_POST["moduleName"];
		    $model->moduleCode=$_POST["moduleCode"];
			 $model->moduleMultiple=$_POST["moduleMultiple"];
			  $model->moduelRoot=$_POST["moduelRoot"];
			   $model->userAction=$_POST["userAction"];
			    $model->FAIcon=$_POST["FAIcon"];
				 $model->sortOrder=$_POST["sortOrder"];
				  
		   
        	
           if($model->save())
		   {
		   return 1;
		   }
		   else{
		   return 0;
		   }
			
			
        } 
		
        
        
        else {
        	
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthProjectModule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	 public function actionGriddelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	 public function actionModuleaction($id)
    {
       $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) 
        {
        	$act=Yii::$app->request->post('AuthProjectModule')['action'];
			
			if($act!=""){
			$model->action=json_encode($act);
			}
           if($model->save())
		   {
		   	echo "Y";
		   }
		   else{
		   	echo "N";
		   }
			
			
        } 
		
        
        
        else {
            return $this->renderAjax('moduleaction', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the AuthProjectModule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthProjectModule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthProjectModule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
