<?php

namespace backend\controllers;

use Yii;
use backend\models\Insurance;
use backend\models\InsuranceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsuranceController implements the CRUD actions for Insurance model.
 */
class InsuranceController extends Controller
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
     * Lists all Insurance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsuranceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Insurance model.
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
     * Creates a new Insurance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Insurance();

      	if ($model->load(Yii::$app->request->post()))
		{
		       $model->insurance_type=trim(ucwords(Yii::$app->request->post('Insurance')['insurance_type']));
			$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save())
			{
				echo "Y";
			}
			else
			{
				if(!empty($model->getErrors('insurance_type')[0]))
				{
					echo "E";
				}
				else 
				{
					echo "N";
				}
			}
	  }
      else 
      {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Insurance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        	if ($model->load(Yii::$app->request->post()))
			{
		$model->insurance_type=trim(ucwords(Yii::$app->request->post('Insurance')['insurance_type']));
			$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save())
			{
				echo "Y";
			}
			else
			{
				if(!empty($model->getErrors('insurance_type')[0]))
				{
					echo "E";
				}
				else 
				{
					echo "N";
				}
				
			}
			}else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Insurance model.
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
     * Finds the Insurance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Insurance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Insurance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
