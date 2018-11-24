<?php

namespace backend\controllers;

use Yii;
use backend\models\InBedno;
use backend\models\InBednoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\InRoomno;

/**
 * InBednoController implements the CRUD actions for InBedno model.
 */
class InBednoController extends Controller
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
     * Lists all InBedno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InBednoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InBedno model.
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
     * Creates a new InBedno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InBedno();
		$roomt_no = ArrayHelper::map(InRoomno::find()->where(['is_active'=>'1'])->all(), 'autoid', 'room_no');
		$session = Yii::$app->session;
		
        if ($model->load(Yii::$app->request->post())) {
        	
           $model->bedno =Yii::$app->request->post('InBedno')['bedno'];
           $model->room_id =Yii::$app->request->post('InBedno')['room_id'];
           $model->	is_active =Yii::$app->request->post('InBedno')['is_active'];
           $model->	created_date = date('Y-m-d H:i:s');
		   $model->user_id = $session['user_id'];
		   $model-> user_role	= $session['authUserRole'];
           $model -> ipaddress = $_SERVER['REMOTE_ADDR'];
		   if($model->save())   
		   {
			 	echo "S";  
		   }
	       else 
	       {
	         	echo "N";
		   }
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'roomt_no' => $roomt_no,
        ]);
    }

    /**
     * Updates an existing InBedno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$roomt_no = ArrayHelper::map(InRoomno::find()->where(['is_active'=>'1'])->all(), 'autoid', 'room_no');
		$session = Yii::$app->session;
		
        if ($model->load(Yii::$app->request->post())) {
        
		  $model->bedno =Yii::$app->request->post('InBedno')['bedno'];
           $model->room_id =Yii::$app->request->post('InBedno')['room_id'];
           $model->	is_active =Yii::$app->request->post('InBedno')['is_active'];
           $model->user_id = $session['user_id'];
		   $model-> user_role	= $session['authUserRole'];
           $model -> ipaddress = $_SERVER['REMOTE_ADDR'];
		   if($model->save())   
		   {
			 	echo "S";  
		   }
	       else 
	       {
	         	echo "N";
		   }
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'roomt_no' => $roomt_no,
        ]);
    }

    /**
     * Deletes an existing InBedno model.
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
     * Finds the InBedno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InBedno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InBedno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionUniquecheck($testname,$bedno)
   	{

	   if($testname != '')
	   {
	 	 $check=InBedno::find()->where(['bedno'=>$testname])->andWhere(['room_id'=>$bedno])->asArray()->one();
	   	 if(!empty($check)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
}
