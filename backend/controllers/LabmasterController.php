<?php

namespace backend\controllers;

use Yii;
use backend\models\LabCategory;
use backend\models\LabUnit;
use backend\models\LabUnitSearch;
use backend\models\LabSubcategory;
use backend\models\LabCategorySearch;
use backend\models\LabSubcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LabmasterController implements the CRUD actions for LabCategory model.
 */
class LabmasterController extends Controller
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
     * Lists all LabCategory models.
     * @return mixed
     */
    public function actionLabmaster()
    {
        $searchModel = new LabCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$subcatmodel=new LabSubcategorySearch();
		$unitmodel=new LabUnitSearch();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>A])->asArray()->all(), 'auto_id', 'category_name');
		$subcatgorylist=ArrayHelper::map(LabSubcategory::find()->where(['isactive'=>A])->asArray()->all(), 'auto_id', 'lab_subcategory');
		$unitlist=ArrayHelper::map(LabUnit::find()->where(['isactive'=>A])->asArray()->all(), 'auto_id', 'unit_name');
		// print_r($unitlist); die;
        return $this->render('labmaster', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catgorylist' => $catgorylist,
            'subcatgorylist'=>$subcatgorylist,
              'model' => $model,
              'subcatmodel' => $subcatmodel,
              'unitmodel'=>$unitmodel,
              'unitlist'=>$unitlist,
        ]);
    }
	
	
	public function actionIndex()
    {
        $searchModel = new LabCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabCategory model.
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
     * Creates a new LabCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
    public function actionCreate()
    {
        $model = new LabCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	return $this->redirect(['index', 'id' => $model->auto_id]);
        }else{
        	return $this->renderAjax('create', ['model' => $model, ]);	
        }
        
    }
	
	
    /**
     * Updates an existing LabCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->auto_id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LabCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {  //print_r($id); die;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LabCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
