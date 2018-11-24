<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
 use backend\models\BranchAdmin;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
	
	
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}

    public function actionIndex()
    {
    	 $companycount= Company::find()->count();
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'companycount' => $companycount,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {
        	$model->company_name=trim(ucwords(Yii::$app->request->post('Company')['company_name']));
			$model->company_type=trim(ucwords(Yii::$app->request->post('Company')['company_type']));
			$model->cin=trim(ucwords(Yii::$app->request->post('Company')['cin']));
			$model->pan=trim(ucwords(Yii::$app->request->post('Company')['pan']));
			$model->dln1=trim(ucwords(Yii::$app->request->post('Company')['dln1']));
			$model->dln2=trim(ucwords(Yii::$app->request->post('Company')['dln2']));
			$model->dln3=trim(ucwords(Yii::$app->request->post('Company')['dln3']));
        	$session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
			if($model->save()){
			 echo "Y";
			}else{
				echo"N";
			}
			
           
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$model->company_name=trim(ucwords(Yii::$app->request->post('Company')['company_name']));
			$model->company_type=trim(ucwords(Yii::$app->request->post('Company')['company_type']));
			$model->cin=trim(ucwords(Yii::$app->request->post('Company')['cin']));
			$model->pan=trim(ucwords(Yii::$app->request->post('Company')['pan']));
			$model->dln1=trim(ucwords(Yii::$app->request->post('Company')['dln1']));
			$model->dln2=trim(ucwords(Yii::$app->request->post('Company')['dln2']));
			$model->dln3=trim(ucwords(Yii::$app->request->post('Company')['dln3']));
        	$session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
			if($model->save()){
				
				echo"Y";
			}else{
				echo"N";
			}
           
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
