<?php

namespace backend\controllers;

use Yii;
use backend\models\InCategory;
use backend\models\InCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InCategoryController implements the CRUD actions for InCategory model.
 */
class InCategoryController extends Controller
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
     * Lists all InCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InCategory model.
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
     * Creates a new InCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InCategory();
		$session = Yii::$app->session;
		
        if ($model->load(Yii::$app->request->post()) ) {
        	//echo"<pre>";print_r($_POST); die;
        	$model->category_name = Yii::$app->request->post('InCategory')['category_name'];
			$model->is_active = Yii::$app->request->post('InCategory')['is_active'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> user_role= $session['authUserRole'];
         	$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			 if($model->save())   
			 {
			 	echo "1";  
			 }
             else 
             {
             	echo "0";
			 }	
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$session = Yii::$app->session;
		
        if ($model->load(Yii::$app->request->post())) {
        	$model->category_name = Yii::$app->request->post('InCategory')['category_name'];
			$model->is_active = Yii::$app->request->post('InCategory')['is_active'];
			$model->updated_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> user_role= $session['authUserRole'];
         	$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			 if($model->save())   
			 {
			 	echo "1";  
			 }
             else 
             {
             	echo "0";
			 }	
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InCategory model.
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
     * Finds the InCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionUniquecheck($testname)
   	{
   	  
	   if($testname != '')
	   {
	 	 $check=InCategory::find()->where(['category_name'=>$testname])->asArray()->one();
	   	 if(!empty($check)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
}
