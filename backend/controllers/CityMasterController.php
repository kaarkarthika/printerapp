<?php

namespace backend\controllers;

use Yii;
use backend\models\CityMaster;
use backend\models\CityMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
/**
 * CityMasterController implements the CRUD actions for CityMaster model.
 */
class CityMasterController extends Controller
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
     * Lists all CityMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CityMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CityMaster model.
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
     * Creates a new CityMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CityMaster();
         
        if ($model->load(Yii::$app->request->post())) {
        if(Yii::$app->request->isAjax){ 
                  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
             }
            
             if($model->save())   
             {
                echo "S";  
             }
             else 
             {
                echo "N";
             }
           return $this->redirect(['index']);
        }else{ 
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    }
	
	

    /**
     * Updates an existing CityMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if(Yii::$app->request->isAjax){
                  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
             }

             if($model->save())   
             {
                echo "U";  
             }
             else 
             {
                echo "N";
             }
            return $this->redirect(['index']);
        }else{

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }
    }

    /**
     * Deletes an existing CityMaster model.
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
     * Finds the CityMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CityMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CityMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionUniquecheck($testname)
    {
      
       if($testname != '')
       {
         $check=CityMaster::find()->where(['city'=>$testname])->asArray()->one();
         if(!empty($check)){
            return true;
         }else{
            return false;
         }
       }

    }
}
