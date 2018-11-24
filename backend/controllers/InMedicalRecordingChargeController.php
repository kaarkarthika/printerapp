<?php

namespace backend\controllers;

use Yii;
use backend\models\InMedicalRecordingCharge;
use backend\models\TaxgroupingLog;
use backend\models\InMedicalRecordingChargeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * InMedicalRecordingChargeController implements the CRUD actions for InMedicalRecordingCharge model.
 */
class InMedicalRecordingChargeController extends Controller
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
     * Lists all InMedicalRecordingCharge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InMedicalRecordingChargeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InMedicalRecordingCharge model.
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
     * Creates a new InMedicalRecordingCharge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      /*  $model = new InMedicalRecordingCharge();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->autoid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing InMedicalRecordingCharge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$session = Yii::$app->session;
		// $tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['auto_id'=>170])->asArray()->all(), 'taxgroupid', 'hsncode');

		if ($model->load(Yii::$app->request->post())) 
        {
        	
			$model->name = Yii::$app->request->post('InMedicalRecordingCharge')['name'];
			$model->amount = Yii::$app->request->post('InMedicalRecordingCharge')['amount'];
			$model->hsncode = Yii::$app->request->post('InMedicalRecordingCharge')['hsncode'];
			$model->updated_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model-> user_role= $session['authUserRole'];
         	$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			if($model->save())   
			 {
			 	echo "S";  
			 }
             else 
             {
             	
             	echo "N";
			 }
        }
		else {
			return $this->renderAjax('update', [
            	'model' => $model,
            	'tax_grouping' => $tax_grouping,
        	]);
		}
        
    }

    /**
     * Deletes an existing InMedicalRecordingCharge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       // $this->findModel($id)->delete();

       // return $this->redirect(['index']);
    }

    /**
     * Finds the InMedicalRecordingCharge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InMedicalRecordingCharge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InMedicalRecordingCharge::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
