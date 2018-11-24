<?php

namespace backend\controllers;

use Yii;
use backend\models\InRoomtypes;
use backend\models\InRoomtypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TaxgroupingLog;
use yii\helpers\ArrayHelper;

/**
 * InRoomtypesController implements the CRUD actions for InRoomtypes model.
 */
class InRoomtypesController extends Controller
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
     * Lists all InRoomtypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InRoomtypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InRoomtypes model.
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
     * Creates a new InRoomtypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InRoomtypes();
		$session = Yii::$app->session;
		
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['auto_id'=>170])->asArray()->all(), 'taxgroupid', 'hsncode');
			
        if ($model->load(Yii::$app->request->post()) ) {
        	$model->room_types = Yii::$app->request->post('InRoomtypes')['room_types'];
			$model->hsn_code = Yii::$app->request->post('InRoomtypes')['hsn_code'];
			$model->price = Yii::$app->request->post('InRoomtypes')['price'];
			$model->is_active = Yii::$app->request->post('InRoomtypes')['is_active'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> userrole	= $session['authUserRole'];
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
             'tax_grouping'=>$tax_grouping,
        ]);
    }

    /**
     * Updates an existing InRoomtypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$session = Yii::$app->session;
	//$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
	$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['auto_id'=>170])->asArray()->all(), 'taxgroupid', 'hsncode');

        if ($model->load(Yii::$app->request->post())) {
        	 echo"<pre>"; print_r($_POST); die;
			$model->room_types = Yii::$app->request->post('InRoomtypes')['room_types'];
			$model->hsn_code = Yii::$app->request->post('InRoomtypes')['hsn_code'];
			$model->price = Yii::$app->request->post('InRoomtypes')['price'];
			$model->is_active = Yii::$app->request->post('InRoomtypes')['is_active'];
			//$model->created_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> userrole	= $session['authUserRole'];
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
            'tax_grouping'=>$tax_grouping,
        ]);
    }

    /**
     * Deletes an existing InRoomtypes model.
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
     * Finds the InRoomtypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InRoomtypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InRoomtypes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionUniquecheck($testname)
   	{
   	  
	   if($testname != '')
	   {
	 	 $check=InRoomtypes::find()->where(['room_types'=>$testname])->asArray()->one();
	   	 if(!empty($check)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
}
