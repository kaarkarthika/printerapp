<?php

namespace backend\controllers;

use Yii;
use backend\models\Productgrouping;
use backend\models\ProductgroupingSearch;
use yii\web\Controller;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Product;
use backend\models\Vendor;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;
use yii\helpers\Html;
use yii\filters\AccessControl;
use backend\models\CompanyBranch;
use backend\models\Manufacturermaster;
use yii\helpers\Json;

class ProductgroupingController extends Controller
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
         'access' => [ 'class' => AccessControl::className(),
          
           'rules' => [ [ 'allow' => true,'roles' => ['@']] ],
              
          
       ],
        ];
    }
	 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  
	


    public function actionIndex()
    {
        $searchModel = new ProductgroupingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		 
    if (Yii::$app->request->post('hasEditable')) {
        $model = Productgrouping::findOne(Yii::$app->request->post('editableKey'));
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = ['Productgrouping' => current(Yii::$app->request->post('Productgrouping'))];
        if ($model->load($post)) {
        		
				$session = Yii::$app->session;
		   
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
        	$model->save();  $output = ''; $out = Json::encode(['output'=>$output, 'message'=>'']);}
        echo $out;
        return;
                                                 }
	
	
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$manufacturerlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vendorlist'=>$vendorlist,
            'productlist'=>$productlist,
             'manufacturerlist'=>$manufacturerlist,
            
           
        ]);
    }

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Productgrouping();
		

        if ($model->load(Yii::$app->request->post())) {
            
			$vendor=Yii::$app->request->post('Productgrouping')['vendorid'];
			$product=Yii::$app->request->post('Productgrouping')['productid'];
			foreach ($product as $key => $value) {
			$productgrp=Productgrouping::find()->where(['vendorid'=>$vendor])->andwhere(['productid'=>$value])->one();
			
			if(count($productgrp)>0){}
			else{
		    $session = Yii::$app->session;
		    $model = new Productgrouping();
			$model->productid=$value;
			$model->vendorid=$vendor;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->is_active=1;
			$model->save();
			}
			}
			echo "Y";
		   
        } else {
        	
        	$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
			$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
            return $this->render('create', [
                'model' => $model,
                'productlist' => $productlist,
                 'vendorlist' => $vendorlist,
            ]);
        }
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          
		   $vendor=Yii::$app->request->post('Productgrouping')['vendorid'];
			$product=Yii::$app->request->post('Productgrouping')['productid'];
			
			$productgrp=Productgrouping::find()->where(['vendorid'=>$vendor])->andwhere(['productid'=>$product])->andwhere(['!=','productgroupid',$id])->one();
			
			if(count($productgrp)>0){
				echo"E";
			}
			
			else{
		  
		    $session = Yii::$app->session;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save())
			{
				echo "Y";
			}else{
				echo "N";
			}
			}
		  
        } else {
        	$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
			$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
			
            return $this->renderAjax('update', [
                'model' => $model,
                 'productlist' => $productlist,
                 'vendorlist' => $vendorlist,
            ]);
        }
    }

  
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionGetproduct($id)
    {
    	
		  $rows = Product::find()->where(['is_active'=>1])->all();
		  $checkproduct = Productgrouping::find()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
		  if(count($checkproduct)>0){
		  $prdouctdetail=array();
		  foreach ($checkproduct as $key => $value) {
		  	 $prdouctdetail[]=$value->productid;
		  }
		  }else{
		  	
		  	 $prdouctdetail=[];
		  }
		
		$k=0;
 
        if(count($rows)>0){
            foreach($rows as $row){
            	//print_r($prdouctdetail);die;
            	if(!(in_array($row->productid,  $prdouctdetail))){
            	
				 $rows1 = Product::find()->where(['productid' => $row->productid])->one();
                echo "<option value='$rows1->productid'>$rows1->productname</option>";
				$k=1;
				
				}else{
					
				}
            }
			
			if($k==0)
			{
				echo "<option value=''>Product Already Filled for this Vendor.</option>";
			}
			
			
        }
        else{
            echo "<option>Product Not Available for this Vendor.</option>";
        }
		
	}
	
	
	

	 public function actionAddproductgroup()
    {
    	
	  $model = new Productgrouping();	
	  $vendor=Yii::$app->request->post('Productgrouping')['vendorid'];
	  $product=Yii::$app->request->post('Productgrouping')['productid'];
	if($vendor!="" &&  $product!=""){
		$productids=Yii::$app->request->post('Productgrouping')['productid'];
		$vendorid=Yii::$app->request->post('Productgrouping')['vendorid'];
		$vendor_name=Vendor::find()->where(['vendorid'=>$vendorid])->one();
		$vendorname=$vendor_name->vendorname;
		$manufacturerlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
		$max = Productgrouping::find()->max('productgroupid');
	    return $this->renderAjax('gridform', [
                'model' => $model,
                 'productid' => $productids,
                 'vendorid' => $vendorid,
                 'vendorname'=>$vendorname,
                 'manufacturerlist'=>$manufacturerlist,
                 'stockcode'=>$max,
                 'brandcode'=>$max,
                
            ]);
        
	}
	
	}

	 public function actionSaveproductgroup()
    {
            $model = new Productgrouping();

        if ($model->load(Yii::$app->request->post())) {
			$product=Yii::$app->request->post('Productgrouping')['productid'];
			$i=1;
			foreach ($product as $key => $value)
			 {
			$vendor=Yii::$app->request->post('Productgrouping')['vendorid'];
			$product=Yii::$app->request->post('Productgrouping')['productid'][$key];
			$productgrp=Productgrouping::find()->where(['vendorid'=>$vendor])->andwhere(['productid'=>$product])->one();
			$stockcode=Yii::$app->request->post('stockcode'.$i);
			$brandcode=Yii::$app->request->post('brandcode'.$i);
			
			if(count($productgrp)>0){
			}
			else{
			
			  $session = Yii::$app->session;		
		    $model1 = new Productgrouping();
			$model1->productid=$product;
			$model1->vendorid=$vendor;
			$model1->brandcode=$brandcode;
			$model1->stock_code=$stockcode;
	        $model1->updated_by=$session['user_id'];
			$model1->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model1->updated_on=date("Y-m-d H:i:s");
			$model1->is_active=1;
			$model1->save();
			}
			$i++;
			}

        } 
    	
	}

   
    protected function findModel($id)
    {
        if (($model = Productgrouping::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
