<?php

namespace backend\controllers;

use Yii;
use backend\models\ServiceuserLogin;
use backend\models\ServiceuserLoginSearch;
use backend\models\AuthProjectModule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Arrayhelper;
use backend\models\AuthUserRole;
use backend\models\BranchAdmin;

class ServiceuserLoginController extends Controller
{
  
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
        $searchModel = new ServiceuserLoginSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceuserLogin model.
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
     * Creates a new ServiceuserLogin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceuserLogin();
		
        if ($model->load(Yii::$app->request->post())) {
        	
			$mode=Yii::$app->request->post('assignservice');
           foreach ($mode as $key => $value) {
         	if($value!=0){
                 $var1[]=$value;
			      $act=Yii::$app->request->post('serviceaction'.$value);
				if($act!=""){
			  foreach ($act as $key1 => $value1) {
			  		if($value1!="0"){
			  	$var[$value].=$value1.',';
					}
			  	
			  }
				}
			}
       }
		 
		 $model->assign_service = json_encode($var1);
		 $model->assign_action = json_encode($var);
		//  print_r($var)  ;
          // print_r(Yii::$app->request->post('ServiceuserLogin')['assign_service']);
        //  print_r($_POST['serviceaction']);
			//die;
           if($model->save())
		   {
		   	Yii::$app->getSession()->setFlash('success','Created Rights successfully');
		   	 return $this->redirect(['index']);
		   	//echo "Y";
		   }
		   else{
		   		Yii::$app->getSession()->setFlash('success',' Already Exists Rights for that User ');
		   	 return $this->redirect(['index']);
		   	//echo "N";
		   }
		   
        } else {
        	$roles=ArrayHelper::map(AuthUserRole::find()->orderBy(['rolename'=>SORT_ASC])->all(),'rolecode','rolename');
        	$model->assign_service=json_encode('');
            return $this->render('create', [
                'model' => $model,
                'roles'=>$roles,
            ]);
        }
    }

    /**
     * Updates an existing ServiceuserLogin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
        
        if ($model->load(Yii::$app->request->post())) {
        	
        	$mode=Yii::$app->request->post('assignservice');
		 echo '<pre>';
			
         foreach ($mode as $key => $value) {
         	if($value!=0){
          $var1[]=$value;
			$act=Yii::$app->request->post('serviceaction'.$value);
			//print_r($act);
				if($act!=""){
			  foreach ($act as $key1 => $value1) {
			  		if($value1!="0"){
			  	$var[$value].=$value1.',';
					}
			  	
			  }
				}else{
					//$var[$value].
				}	
			}
       }
		
		// print_r($var);
		 //die;
	 $model->assign_service = json_encode($var1);
		 
		 $model->assign_action = json_encode($var);

           if($model->save())
		   {
		   	 Yii::$app->getSession()->setFlash('success','Assigned Rights successfully');
			
		   	 return $this->redirect(['index']);
		   //	echo "Y";
		   }
		   else{
		   	 return $this->redirect(['index']);
		   	//echo "N";
		   }
		   
        }
       else {
       $roles=ArrayHelper::map(AuthUserRole::find()->orderBy(['rolename'=>SORT_ASC])->all(),'rolecode','rolename');
            return $this->render('update', [
                'model' => $model,
                'roles'=>$roles,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceuserLogin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceuserLogin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceuserLogin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceuserLogin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
