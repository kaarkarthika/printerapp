<?php

namespace backend\controllers;

use Yii;
use backend\models\Specialistdoctor;
use backend\models\SpecialistdoctorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecialistdoctorController implements the CRUD actions for Specialistdoctor model.
 */
class SpecialistdoctorController extends Controller
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
     * Lists all Specialistdoctor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialistdoctorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Specialistdoctor model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Specialistdoctor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Specialistdoctor();
        $session = Yii::$app->session;
        
        if ($model->load(Yii::$app->request->post()))
        {
            
            $specialname=trim(ucwords(Yii::$app->request->post('Specialistdoctor')['specialist']));
            $active_status=Yii::$app->request->post('Specialistdoctor')['is_active'];
            
             $model->specialist=$specialname;
             $model->is_active=$active_status;
             $model->consult_amount=Yii::$app->request->post('Specialistdoctor')['consult_amount'];
             $model->ucil_amount=Yii::$app->request->post('Specialistdoctor')['ucil_amount'];
                
             $model->updated_by=$session['user_id'];
             
             $model->ip_address=$_SERVER['REMOTE_ADDR'];
             $model->created_at=date("Y-m-d H:i:s");
             $model->updated_at=date("Y-m-d H:i:s");
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
     * Updates an existing Specialistdoctor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            
            $specialname=trim(ucwords(Yii::$app->request->post('Specialistdoctor')['specialist']));
            $active_status=Yii::$app->request->post('Specialistdoctor')['is_active'];
            
             $model->specialist=$specialname;
             $model->is_active=$active_status;
             $model->consult_amount=Yii::$app->request->post('Specialistdoctor')['consult_amount'];
             $model->ucil_amount=Yii::$app->request->post('Specialistdoctor')['ucil_amount'];
                
             $model->updated_by=$session['user_id'];
             $model->ip_address=$_SERVER['REMOTE_ADDR'];
             
             $model->updated_at=date("Y-m-d H:i:s");
              if($model->save())   
              {
                echo "U";  
              }
              else 
              {
                echo "N";
              }
        }
        else 
        {
            return $this->renderAjax('update', ['model' => $model ]);
        }
    }

    /**
     * Deletes an existing Specialistdoctor model.
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
     * Finds the Specialistdoctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Specialistdoctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specialistdoctor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
