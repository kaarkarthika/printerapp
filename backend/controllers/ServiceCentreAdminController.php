<?php

namespace backend\controllers;

use Yii;
use backend\models\ServiceCentreAdmin;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\ServiceCentreAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;

/**
 * ServiceCentreAdminController implements the CRUD actions for ServiceCentreAdmin model.
 */
class ServiceCentreAdminController extends Controller
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
        $searchModel = new ServiceCentreAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceCentreAdmin model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceCentreAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceCentreAdmin();

        if ($model->load(Yii::$app->request->post())) {

        $password=Yii::$app->request->post('ServiceCentreAdmin')['password_hash'];
        $model->password_hash = Yii::$app->security->generatePasswordHash($password);

        if($model->save())
            {
                Yii::$app->getSession()->setFlash('success','Service Center login created successfully');
            }
            else
            {
                Yii::$app->getSession()->setFlash('error','Username is already exist');
               
            }
             return $this->redirect(['index']);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceCentreAdmin model.
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
     * Finds the ServiceCentreAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ServiceCentreAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceCentreAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
