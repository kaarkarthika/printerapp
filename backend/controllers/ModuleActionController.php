<?php

namespace backend\controllers;

use Yii;
use backend\models\ModuleAction;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\ModuleActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
 use backend\models\BranchAdmin;
use backend\models\Shortcut;
use yii\helpers\ArrayHelper;
/**
 * ModuleActionController implements the CRUD actions for ModuleAction model.
 */
class ModuleActionController extends Controller
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
        $searchModel = new ModuleActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleAction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [ 'model' => $this->findModel($id),   ]);
        
    }

    /**
     * Creates a new ModuleAction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleAction();

        if ($model->load(Yii::$app->request->post())) {
        	$session = Yii::$app->session;
        	$model->updatedby=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updatedon=date("Y-m-d H:i:s");
			
           if($model->save())
		   {
		   	echo "Y";
		   }
		   else{
		   	print_r($model->getErrors());
		   	echo "N";
		   }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleAction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$session = Yii::$app->session;
        	$model->updatedby=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updatedon=date("Y-m-d H:i:s");
           if($model->save())
		   {
		   	echo "Y";
		   }
		   else{
		   	echo "N";
		   }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }
	
	
	public function actionShortcut()
    {
    	$model = new Shortcut();
		$shortlist=ArrayHelper::map(AuthProjectModule::find()->asArray()->all(), 'p_autoid', 'moduleName');
		//print_r($shortlist);die;
       	return $this->render('shortcut', [
            'model' => $model,
            'shortlist' => $shortlist,
            
        ]);
    }

    /**
     * Deletes an existing ModuleAction model.
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
     * Finds the ModuleAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
