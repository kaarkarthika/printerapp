<?php

namespace backend\controllers;

use Yii;
use backend\models\UsersProfile;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\UsersProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
 use backend\models\BranchAdmin;

/**
 * UsersProfileController implements the CRUD actions for UsersProfile model.
 */
class UsersProfileController extends Controller
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


    public function actionIndex()
    {
        $searchModel = new UsersProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	 

 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  

    /**
     * Displays a single UsersProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionPassword($id)
    {
         $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
			$model-> password_hash= Yii::$app->security->generatePasswordHash($model-> password);
			 $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Creates a new UsersProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersProfile();

        if ($model->load(Yii::$app->request->post())  ) {
			$model->auth_key=Yii::$app->security->generateRandomString();
			
			$model-> password_hash= Yii::$app->security->generatePasswordHash($model-> password);
			$model->created_at  = date("Y-m-d H:i:s");
			
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsersProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->scenario = 'update';
		$passswordtst=(Yii::$app->request->post('UsersProfile')['password']);
        if ($model->load(Yii::$app->request->post()) ) {        	
        	if($passswordtst!=""){
			  $model-> password_hash= Yii::$app->security->generatePasswordHash($passswordtst);
			}
			 $model->save();
			// print_r($model->getErrors());die;
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UsersProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = UsersProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
