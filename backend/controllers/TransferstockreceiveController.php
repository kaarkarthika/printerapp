<?php

namespace backend\controllers;

use Yii;
use backend\models\Transferstockreceive;
use backend\models\TransferstockreceiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Transferstock;
use yii\filters\AccessControl;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;

/**
 * TransferstockreceiveController implements the CRUD actions for Transferstockreceive model.
 */
class TransferstockreceiveController extends Controller
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
           ],
       ],
        ];
    }
	 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}

    /**
     * Lists all Transferstockreceive models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferstockreceiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transferstockreceive model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transferstockreceive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transferstockreceive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transferstockreceiveid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transferstockreceive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transferstockreceiveid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
		public function actionUpdate1($id)
    {
    	 $model1 = Transferstock::find()->where(['transferstockid'=>$id])->one();
		
		 $model2="";
		 if($model1!=""){
		 	$model2=Transferstock::find()->where(['transferstock_requestcode'=>$model1->transferstock_requestcode])->all();
			
		 }
		
        $model3= Transferstockreceive::find()->where(['transferstock_requestcode'=>$model1->transferstock_requestcode])->all();	
	   
	   
	   		$model = Transferstockreceive::find()->where(['transferstock_requestcode'=>$model1->transferstock_requestcode])->one();	
	   
	    if($model==""){
	   		$model=new Transferstockreceive();
	   }
	 
	   	
		$stock="";
		$data=Transferstock::find()->where(['transferstockid'=>$id])->one();
		$requestcode=$data->transferstock_requestcode;
	
		if($data){
				$stock=$data->stockid;
		}

        if ($model->load(Yii::$app->request->post()) ) {
        	$session = Yii::$app->session;
			$i=1;
			foreach ($_POST['Transferstockreceive']['unitid'] as $key => $value) {
				
		   $model = Transferstockreceive::find()->where(['Transferstockid'=>Yii::$app->request->post('Transferstockreceive')['Transferstockid'][$key]])->one();	
	   
	    if($model==""){
	   		$model=new Transferstockreceive();
	   }
				$session = Yii::$app->session;
        	
			$receiveddate=Yii::$app->request->post('Transferstockreceive')['receiveddate'];
			$model->receiveddate=date("Y-m-d",strtotime($receiveddate));
			
			$expiredate=Yii::$app->request->post('expiredate'.$i);
			$model->Transferstockid=Yii::$app->request->post('Transferstockreceive')['Transferstockid'][$key];
			$stockid=Yii::$app->request->post('stockid')[$key];
			$model->stockid=$stockid;
			$model->transferstock_requestcode=Yii::$app->request->post('Transferstockreceive')['transferstock_requestcode'];
			$model->batchnumber=Yii::$app->request->post('batchnumber'.$i);
			$model->expiredate=date("Y-m-d",strtotime($expiredate));
			$purchaseddate=Yii::$app->request->post('purchasedate'.$i);
			$model->purchasedate=date("Y-m-d",strtotime($purchaseddate));
			$manufacturedate=Yii::$app->request->post('manufacturedate'.$i);
			$model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
            $purchaseprice=Yii::$app->request->post('purchaseprice'.$i);
			$model->purchaseprice=$purchaseprice;
			$receivedquantity=Yii::$app->request->post('receivedquantity'.$i);
			$unitid=Yii::$app->request->post('Transferstockreceive')['unitid'][$key];
			$unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
		    $unitreceivedqty=$unitdata->no_of_unit;
			$model->receivedquantity=$receivedquantity;
			$totalreceivedqty=$unitreceivedqty*$receivedquantity;
			$model->unitid=$unitid;
			$model->total_no_of_quantity=$totalreceivedqty;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->priceperquantity=$purchaseprice/$receivedquantity;
			$model->branch_id=$branch;
			print_r($model);die;
			if($model->save())
			{
				
			    $model1 = Stockmaster::find()->where(['stockid'=>$stockid])->one();	
				$model1->quantity=$model1->quantity+$receivedquantity;
				$model1->updated_on=date("Y-m-d H:i:s");
				$model1->save();
			}
			 
			 $i++;
	         }

               Yii::$app->getSession()->setFlash('success','Stock Receive Updated successfully');
			  return $this->redirect('?r=Transferstock/index');
			
            
        } else {
        	
			
            return $this->render('update', [
                'model' => $model,
                 'stock' => $stock,
                 'requestcode'=>$requestcode,
                
                  'model1'=>$model1,
                  'model2'=>$model2,
                  'model3'=>$model3,
            ]);
        }
    }
	

    /**
     * Deletes an existing Transferstockreceive model.
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
     * Finds the Transferstockreceive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transferstockreceive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transferstockreceive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
