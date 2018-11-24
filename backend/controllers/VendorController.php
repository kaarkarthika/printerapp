<?php

namespace backend\controllers;

use Yii;
use backend\models\Vendor;
use backend\models\VendorSearch;
use yii\web\Controller;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\States;
use backend\models\BranchAdmin;
/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends Controller
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
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendor model.
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
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendor();
		
       if ($model->load(Yii::$app->request->post()) )
	    {
	    	
        	 $session = Yii::$app->session;
		     $vendorname=trim(ucwords(Yii::$app->request->post('Vendor')['vendorname']));
			 $vendorcode=trim(Yii::$app->request->post('Vendor')['vendorcode']);
			 $vendordef=Yii::$app->request->post('Vendor')['default_vendor'];
			 
			  $model->updated_by=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updated_on=date("Y-m-d H:i:s");
			 $model->vendorname=$vendorname;
			 $model->vendorcode=$vendorcode;
			 $model->default_vendor=$vendordef;
			 
			 if($vendordef == 1)
			 {
			 	Vendor::updateAll(['default_vendor' => 0]);
			 }
			 
			 $data=Vendor::find()->where(['vendorname'=>$vendorname])->one();
			 $data1=Vendor::find()->where(['vendorcode'=>$vendorcode])->one();
			 if(count($data)>0)
			 {
			 	echo "VN";
			 }
			 else if(count($data1)>0)
			 {
			 	echo "VC";
			 }
			 
			 
			 
			 else{
			 	    if($model->save())   { echo "S";  }
                    else {echo "N";}
               
			 }
			 
			 
	       
			
			
	   }
        
        else {
            return $this->renderAjax('create', ['model' => $model ]);
        }
    }

    /**
     * Updates an existing Vendor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) )
	    {
        	 $session = Yii::$app->session;
		     $vendorname=trim(ucwords(Yii::$app->request->post('Vendor')['vendorname']));
			 $vendorcode=trim(Yii::$app->request->post('Vendor')['vendorcode']);
			 
			 $vendordef=Yii::$app->request->post('Vendor')['default_vendor'];
			  $model->updated_by=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updated_on=date("Y-m-d H:i:s");
			 $model->vendorname=$vendorname;
			 $model->vendorcode=$vendorcode;
			  $model->default_vendor=$vendordef;
			 
			 
			 if($vendordef == 1)
			 {
			 	Vendor::updateAll(['default_vendor' => 0]);
			 }
			 
			 $data=Vendor::find()->where(['vendorname'=>$vendorname])->one();
			 $data1=Vendor::find()->where(['vendorcode'=>$vendorcode])->one();
			 if(count($data)>1)
			 {
			 	echo "VN";
			 }
			 else if(count($data1)>1)
			 {
			 	echo "VC";
			 }
			 
			 
			 
			 else{
			 	    if($model->save())   {echo "U";  }
                    else {echo "N";}
               
			 }
			 
			 
	       
			
			
	   }
	   
	   else {
        	
            return $this->renderAjax('update', [ 'model' => $model]);
               
                 
           
        }
    }

    /**
     * Deletes an existing Vendor model.
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
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Vendor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
