<?php

namespace backend\controllers;

use Yii;
use backend\models\Taxmaster;
use backend\models\TaxmasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * TaxmasterController implements the CRUD actions for Taxmaster model.
 */
class TaxmasterController extends Controller
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
                            'access' => [
           'class' => AccessControl::className(),
           'rules' => [
               [
                   'allow' => true,
                   'roles' => ['@'],
               ],

               // ...
           ],
       ],
        ];
    }
     


  

    public function actionIndex()
    {
        $searchModel = new TaxmasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReindex()
    {
        $searchModel = new TaxmasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Yii::$app->session->setFlash('success', 'Record Saved Successfully');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taxmaster model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Taxmaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Taxmaster();

        if ($model->load(Yii::$app->request->post()))
         {
            
             $taxvalue=Yii::$app->request->post('Taxmaster')['taxvalue'];
             $taxgroup=trim(ucwords(Yii::$app->request->post('Taxmaster')['taxgroup']));
            
             $active=Yii::$app->request->post('Taxmaster')['is_active'];
             $session = Yii::$app->session;
            $model->taxvalue=$taxvalue;
            $model->taxgroup=$taxgroup;
            $model->is_active=$active;
            $model->updated_by=$session['headlinestv_id'];
            $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            $model->updated_on=date("Y-m-d H:i:s");
             if($model->save()){
                  echo 'okay';  
                 //return $this->redirect(['index']);
            }else{
                print_r('Something Error');die;
            }
        } 
          else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Taxmaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
         if ($model->load(Yii::$app->request->post()))
         {
            
             $taxvalue=Yii::$app->request->post('Taxmaster')['taxvalue'];
             $taxgroup=trim(ucwords(Yii::$app->request->post('Taxmaster')['taxgroup']));
             $active=Yii::$app->request->post('Taxmaster')['is_active'];
             $session = Yii::$app->session;
            $model->taxvalue=$taxvalue;
            $model->taxgroup=$taxgroup;
            $model->is_active=$active;
            $model->updated_by=$session['headlinestv_id'];
            $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            $model->updated_on=date("Y-m-d H:i:s");
            if($model->save()){
                
                 echo 'okay';  
                // return $this->redirect(['index']);
            }else{
                print_r('Something Error');die;
            }
        } 
 else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Taxmaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Taxmaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Taxmaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taxmaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
