<?php

namespace backend\controllers;

use Yii;
use backend\models\Treatment;
use backend\models\TreatmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TaxgroupingLog;
use yii\helpers\ArrayHelper;

/**
 * TreatmentController implements the CRUD actions for Treatment model.
 */
class TreatmentController extends Controller
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
     * Lists all Treatment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreatmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Treatment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Treatment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Treatment();
		
		$session = Yii::$app->session;
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
        if ($model->load(Yii::$app->request->post())) 
        {
        	$model->treatment_name = Yii::$app->request->post('Treatment')['treatment_name'];
			$model->code = Yii::$app->request->post('Treatment')['code'];
			$model->amount = Yii::$app->request->post('Treatment')['amount'];
			$model->hsn_code = Yii::$app->request->post('Treatment')['hsn_code'];
			$model->is_active = Yii::$app->request->post('Treatment')['is_active'];
			$model->created_at = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model->userrole = $session['authUserRole'];
			$model->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			
			if($model->save())
			{
				echo "S";  
			}
			else 
			{
				//print_r($model->getErrors());die;
				echo "N";	
			}
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'tax_grouping'=> $tax_grouping,
            ]);
        }
    }

    /**
     * Updates an existing Treatment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
        if ($model->load(Yii::$app->request->post())) 
        {
         //   return $this->redirect(['view', 'id' => $model->id]);
            $model->treatment_name = Yii::$app->request->post('Treatment')['treatment_name'];
			$model->code = Yii::$app->request->post('Treatment')['code'];
			$model->amount = Yii::$app->request->post('Treatment')['amount'];
			$model->hsn_code = Yii::$app->request->post('Treatment')['hsn_code'];
			$model->is_active = Yii::$app->request->post('Treatment')['is_active'];
			$model->user_id = $session['user_id'];
			$model->userrole = $session['authUserRole'];
			$model->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			
			if($model->save())
			{
				echo "S";  
			}
			
			else 
			{
				
				echo "N";	
			}
        
		} else {
            return $this->renderAjax('update', [
                'model' => $model,
                'tax_grouping'=> $tax_grouping,
            ]);
        }
    }

    /**
     * Deletes an existing Treatment model.
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
     * Finds the Treatment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Treatment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Treatment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
