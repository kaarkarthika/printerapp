<?php

namespace backend\controllers;

use Yii;
use backend\models\MedicalRecordingCharge;
use backend\models\MedicalRecordingChargeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TaxgroupingLog;
use yii\helpers\ArrayHelper;
/**
 * MedicalRecordingChargeController implements the CRUD actions for MedicalRecordingCharge model.
 */
class MedicalRecordingChargeController extends Controller
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
     * Lists all MedicalRecordingCharge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicalRecordingChargeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MedicalRecordingCharge model.
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
     * Creates a new MedicalRecordingCharge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedicalRecordingCharge();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->autoid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MedicalRecordingCharge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	 $session = Yii::$app->session;
	$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // echo"<pre>"; print_r($_POST); die;
		   
            $model->amount = Yii::$app->request->post('MedicalRecordingCharge')['amount'];
			$model->hsncode	 = Yii::$app->request->post('MedicalRecordingCharge')['hsncode'];
			$model->name = Yii::$app->request->post('MedicalRecordingCharge')['name'];
			$model->updated_at = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			 if($model->save())   
			 {
			 	echo "1";  
			 }
             else 
             {
             	echo "0";
			 }	
			return $this->redirect(['index', 'id' => $model->autoid]);
        }else{
        	return $this->renderAjax('update', [
            'model' => $model,
            'tax_grouping'=>$tax_grouping
        ]);
			
        }

        
    }

    /**
     * Deletes an existing MedicalRecordingCharge model.
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
     * Finds the MedicalRecordingCharge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MedicalRecordingCharge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedicalRecordingCharge::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
