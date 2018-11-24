<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthorityMaster;
use backend\models\AuthorityMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorityMasterController implements the CRUD actions for AuthorityMaster model.
 */
class AuthorityMasterController extends Controller
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
     * Lists all AuthorityMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthorityMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthorityMaster model.
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
     * Creates a new AuthorityMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthorityMaster();
		 $session = Yii::$app->session;
	     
	     if ($model->load(Yii::$app->request->post())) {
           
            $model->authorityname = Yii::$app->request->post('AuthorityMaster')['authorityname'];
			$model->isactive	 = Yii::$app->request->post('AuthorityMaster')['isactive'];
			$model->created_at = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model->user_role = $session['userrole'];
			$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			 if($model->save())   
			 {
			 	echo "1";  
			 }
             else 
             {
             	echo "<pre>"; print_r($model->getErrors()); die;
			 }	
			return $this->redirect(['index', 'id' => $model->autoid]);
			
        }else{
        	
        	return $this->renderAjax('create', [
            	'model' => $model,
        	]);
		}
    }

    /**
     * Updates an existing AuthorityMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->authorityname = Yii::$app->request->post('AuthorityMaster')['authorityname'];
			$model->isactive= Yii::$app->request->post('AuthorityMaster')['isactive'];
			$model->updated_at = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model->user_role = $session['userrole'];
			$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			 if($model->save())   
			 {
			 	echo "1";  
			 }
             else 
             {
             	echo "<pre>"; print_r($model->getErrors()); die;
			 }	
			return $this->redirect(['index', 'id' => $model->autoid]);
			
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthorityMaster model.
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
     * Finds the AuthorityMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthorityMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthorityMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
