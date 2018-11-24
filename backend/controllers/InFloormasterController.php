<?php

namespace backend\controllers;

use Yii;
use backend\models\InFloormaster;
use backend\models\InFloormasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InFloormasterController implements the CRUD actions for InFloormaster model.
 */
class InFloormasterController extends Controller
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
     * Lists all InFloormaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InFloormasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InFloormaster model.
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
     * Creates a new InFloormaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InFloormaster();
		$session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post())) 
        {
        	
			$model->floor_no = Yii::$app->request->post('InFloormaster')['floor_no'];
			$model->is_active = Yii::$app->request->post('InFloormaster')['is_active'];
			$model->created_date = date('Y-m-d H:i:s');
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
        }
		else 
		{
			 
			 return $this->renderAjax('create', ['model' => $model ]);
		}

    }

    /**
     * Updates an existing InFloormaster model.
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
        	
           	$model->floor_no = Yii::$app->request->post('InFloormaster')['floor_no'];
			$model->is_active = Yii::$app->request->post('InFloormaster')['is_active'];
			$model->user_id = $session['user_id'];
			$model-> user_role	= $session['authUserRole'];
         	$model -> ipaddress = $_SERVER['REMOTE_ADDR'];
			
			 if($model->save())   
			 {
			 	echo "U";  
			 }
             else 
             {
             	echo "N";
			 }	
        }
		else {
			return $this->renderAjax('update', [
            'model' => $model,
        ]);
		}
        
    }

    /**
     * Deletes an existing InFloormaster model.
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
     * Finds the InFloormaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InFloormaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InFloormaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
