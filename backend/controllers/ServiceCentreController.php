<?php

namespace backend\controllers;

use Yii;
use backend\models\ServiceCentre;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\ServiceCentreAdmin;
use backend\models\ServiceCentreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AdminLog;
use yii\filters\AccessControl;
 use backend\models\BranchAdmin;

/**
 * ServiceCentreController implements the CRUD actions for ServiceCentre model.
 */
class ServiceCentreController extends Controller
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
        $searchModel = new ServiceCentreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceCentre model.
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
     * Creates a new ServiceCentre model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceCentre();
        $servicemodel = new ServiceCentreAdmin();
        $logmodel = new AdminLog();
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {

            $model->service_center_createdat=date("Y-m-d h:i:s");


            if($model->save())
            {
                
               $name=Yii::$app->request->post('ServiceCentre')['username'];
              $password=Yii::$app->request->post('ServiceCentre')['password'];
                
               $servicemodel->servicecenter_id=$model->primaryKey.'';
                 $servicemodel->username=$name;
               
                $servicemodel->password_hash = Yii::$app->security->generatePasswordHash($password);
                
                 $servicemodel->created_at=date("Y-m-d h:i:s");
                 
                $servicemodel->save();

                $logmodel->service_center_id=$model->primaryKey;
                $logmodel->user_id=$session['user_id'] ;
                 $logmodel->action="Service Center Created";
                 if($logmodel->save())
                 {

                 }
                 else
                 {
                    echo "<pre>";
                    print_r($logmodel->getErrors());
                    exit();
                 }

                Yii::$app->getSession()->setFlash('success','Service Centre created successfully');
                return $this->redirect(['index']);
            }
            else
            {
                 Yii::$app->getSession()->setFlash('error','Error on creation');
                return $this->redirect(['index']);
            }
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServiceCentre model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        

        $model = $this->findModel($id);
        $model1 = ServiceCentreAdmin::find()->where(['servicecenter_id'=>$id])->one();
        $model1->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {

            $password_old=$model1->password_hash;           
            $model->username=Yii::$app->request->post('ServiceCentreAdmin')['username'];
			$pass_text=Yii::$app->request->post('ServiceCentreAdmin')['password_hash'];
            $model->password=$password_old;
            $model->save();
            if($model->save())
            {
            	if($pass_text!=""){
             	  $model1->password_hash = Yii::$app->security->generatePasswordHash($pass_text);
				}
               $model1->username=Yii::$app->request->post('ServiceCentreAdmin')['username'];
               $model1->save();
               //exit();
                
            }
            
            return $this->redirect(['index']);
        } else {

            return $this->render('update', [
                'model' => $model,
                 'model1' => $model1,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceCentre model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceCentre model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ServiceCentre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceCentre::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
