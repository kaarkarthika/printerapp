<?php

namespace backend\controllers;

use Yii;
use backend\models\LabCategory;

use backend\models\LabSubcategory;
use backend\models\LabSubcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LabSubcategoryController implements the CRUD actions for LabSubcategory model.
 */
class LabSubcategoryController extends Controller
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
     * Lists all LabSubcategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LabSubcategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$catmodel=new LabCategory();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name'); 
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'catgorylist' => $catgorylist,
               'catmodel' => $catmodel,
        ]);
    }

    /**
     * Displays a single LabSubcategory model.
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
     * Creates a new LabSubcategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LabSubcategory();
		
  		$catmodel=new LabCategory();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name');
		//print_r($catgorylist); die;
		if(!empty($_POST)){
		    $model->lab_subcategory=$_POST['LabSubcategory']['lab_subcategory'];
			$model->category_id=$_POST['LabSubcategory']['category_id'];
			$model->isactive=$_POST['LabSubcategory']['isactive'];
		   if($model->save())
		   {
		   	
		   }
		   else {
			   print_r($model->getErrors());die;
		   }
	  		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->auto_id]);
        }
			}
	    
        return $this->renderAjax('create', [
            'model' => $model,
            'catgorylist' => $catgorylist,
               'catmodel' => $catmodel,
        ]);
    }

    /**
     * Updates an existing LabSubcategory model.
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
		$catmodel=new LabCategory();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name');
		
        return $this->renderAjax('update', [
            'model' => $model,
            'catgorylist' => $catgorylist,
               'catmodel' => $catmodel,
        ]);
    }

    /**
     * Deletes an existing LabSubcategory model.
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
     * Finds the LabSubcategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabSubcategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabSubcategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
