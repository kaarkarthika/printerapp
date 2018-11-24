<?php

namespace backend\controllers;

use Yii;
use backend\models\Producttype;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\ProducttypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;

/**
 * ProducttypeController implements the CRUD actions for Producttype model.
 */
class ProducttypeController extends Controller
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
        $searchModel = new ProducttypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producttype model.
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
     * Creates a new Producttype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producttype();

        if ($model->load(Yii::$app->request->post()) )
		 {
		 	$producttype=trim(ucwords(Yii::$app->request->post('Producttype')['product_type']));
		    $active=Yii::$app->request->post('Producttype')['is_active'];
			$session = Yii::$app->session;
			$model->product_type=$producttype;
			$producttypedata=Producttype::find()->where(["like",'product_type',$producttype])->one();
			$model->is_active=$active;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
		if($producttypedata)
			{
			echo "E";	
			}
		else if($model->save()){echo "Y";}
			else{echo "N";}
        } 
       else {
        	return $this->renderAjax('create', ['model' => $model]);
             }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post()) )
		 {
        	 $producttype=trim(ucwords(Yii::$app->request->post('Producttype')['product_type']));
		     $active=Yii::$app->request->post('Producttype')['is_active'];
			 $session = Yii::$app->session;
			$model->product_type=$producttype;
			$model->is_active=$active;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save()){echo "Y";}else{echo "N";}
			
        } 
        
        
        else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

   
    protected function findModel($id)
    {
        if (($model = Producttype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
