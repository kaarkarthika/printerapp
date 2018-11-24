<?php

namespace backend\controllers;

use Yii;
use backend\models\Bulkproducts;
use backend\models\BulkproductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Product;

class BulkproductsController extends Controller
{
   
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

   
    public function actionIndex()
    {
        $searchModel = new BulkproductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bulkproducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bulkproducts();

        if ($model->load(Yii::$app->request->post())) {
        	
			$model->bulkproductname=Yii::$app->request->post("Bulkproducts")["bulkproductname"];
			$productidz=Yii::$app->request->post("Bulkproducts")["productidz"];
			
			$name=array();
			foreach($productidz as $kproducts)
			{
				
				
				 $productdata=Product::find()->where(["productid"=>$kproducts])->one();
				 $name[]=$productdata->productname;
				 
			}
			$session = Yii::$app->session;
			$model->productidz=implode(",",$productidz);
			$model->productnamez=implode(",",$name);
			$model->created_at=date("Y-m-d h:i:s");
			$model->updated_on=date("Y-m-d h:i:s");
		
		    $model->updated_by=$session['user_id'];
			$model->status=1;
			if($model->save())
			{
			Yii::$app->getSession()->setFlash('success','Bulk Product Added successfully');
			return $this->redirect(['index']);	
			}
			
			else {
				print_r($model->getErrors());die;
				Yii::$app->getSession()->setFlash('success','Bulk Product Added not successfully');
			return $this->redirect(['index']);
			}
			
			
			
			
        } 
        
        
        else {
        	
			$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
			
			
            return $this->render('create', [
                'model' => $model,
                "productlist"=>$productlist,
            ]);
        }
    }

    /**
     * Updates an existing Bulkproducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post())) {
        	
			$model->bulkproductname=Yii::$app->request->post("Bulkproducts")["bulkproductname"];
			$productidz=Yii::$app->request->post("Bulkproducts")["productidz"];
			
			$name=array();
			foreach($productidz as $kproducts)
			{
				
				
				 $productdata=Product::find()->where(["productid"=>$kproducts])->one();
				 $name[]=$productdata->productname;
				 
			}
			$session = Yii::$app->session;
			$model->productidz=implode(",",$productidz);
			$model->productnamez=implode(",",$name);
			$model->created_at=date("Y-m-d h:i:s");
			$model->updated_on=date("Y-m-d h:i:s");
		
		    $model->updated_by=$session['user_id'];
			$model->status=1;
			if($model->save())
			{
			Yii::$app->getSession()->setFlash('success','Bulk Product Added successfully');
			return $this->redirect(['index']);	
			}
			
			else {
				print_r($model->getErrors());die;
				Yii::$app->getSession()->setFlash('success','Bulk Product Added not successfully');
			return $this->redirect(['index']);
			}
			
			
			
			
        } 
        
        
        
        
        else {
           $productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
			
			
            return $this->render('update', [
                'model' => $model,
                "productlist"=>$productlist,
            ]);
        }
    }

    /**
     * Deletes an existing Bulkproducts model.
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
     * Finds the Bulkproducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bulkproducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bulkproducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
