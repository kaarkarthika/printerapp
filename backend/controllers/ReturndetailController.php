<?php

namespace backend\controllers;

use Yii;
use backend\models\Returndetail;
use backend\models\ReturndetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BranchAdmin;
use backend\models\Unit;
use backend\models\Composition;
use backend\models\CompanyBranch;
use backend\models\Saledetail;
use backend\models\SaledetailSearch;
use backend\models\Productgrouping;
use backend\models\Producttype;
use backend\models\Insurance;
use backend\models\company;
use backend\models\Product;
use backend\models\Salesreturn;
use yii\helpers\ArrayHelper;
class ReturndetailController extends Controller
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


 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  
    public function actionIndex()
    {
        $searchModel = new ReturndetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Returndetail model.
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
     * Creates a new Returndetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Returndetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->return_detailid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Returndetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post())
        {
        	
			$returnid=$model->return_id;
		    $returnproductsroot=Salesreturn::find()->where(['return_id'=>$returnid])->one();
			$session = Yii::$app->session;
	        $returnproductsroot->updated_by=$session['user_id'];
			$returnproductsroot->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$returnproductsroot->updated_on=date("Y-m-d H:i:s");
			$returnproductsroot->total=Yii::$app->request->post('totalprice');
			$brandcode=$_POST['brandcode'];
			$totaldiscountvalue=0;$totalgstvalue=0;
				foreach ($brandcode as $key => $value) {
				$totaldiscountvalue+= Yii::$app -> request -> post('discount_value')[$key];
				$totalgstvalue+= Yii::$app -> request -> post('gst_value')[$key];
				}
			$returnproductsroot->totalgstvalue=$totalgstvalue;
			$returnproductsroot->totalcgstvalue=$totalgstvalue/2;
			$returnproductsroot->totalsgstvalue=$totalgstvalue/2;
			$returnproductsroot->totaldiscountvalue=$totaldiscountvalue;
			if($returnproductsroot->save()){
				$i=1;
				$productid=Yii::$app->request->post('productid');
				foreach ($productid as $key => $value)
				 {
					$returndetailid=Yii::$app->request->post('returndetailid')[$key];
					if(!empty($returndetailid))
					{
						$model1=Returndetail::find()->where(['return_detailid'=>$returndetailid])->one();
					}
					else{
						$model1=new ReturnDetail();
					}
				
				$product=Product::find()->where(['productid'=>$value])->one(); 	
				$model1->return_id=$returnid;
				$model1->returndate=date('Y-m-d');
				$model1->productid=$value;
				$model1->brandcode=Yii::$app->request->post('brandcode')[$key];
				$model1->stock_code=Yii::$app->request->post('stock_code')[$key];
				$model1->compositionid=Yii::$app->request->post('compositionid')[$key];
				$model1->unitid=Yii::$app->request->post('unitid')[$key];
				$model1->batchnumber=Yii::$app->request->post('batchnumber')[$key];
				$model1->expiredate=Yii::$app->request->post('expiredate')[$key];
				$productqty=Yii::$app->request->post('productqty')[$key];
				$model1->productqty=$productqty;
				$price=Yii::$app->request->post('price')[$key];
				$model1->price=$price;
				$priceperqty=Yii::$app->request->post('priceperqty')[$key];
				$model1->priceperqty=$priceperqty;
				$gstrate=Yii::$app -> request -> post('gst')[$key];
				$model1 -> gstrate= $gstrate;
				$dataincrement=Yii::$app -> request -> post('dataincrement')[$key];
				$discountrate=Yii::$app -> request -> post('discount')[$key];
				$model1 -> discountrate=$discountrate;
				$model1->discount_type=Yii::$app -> request -> post('discounttype'.$dataincrement);
				$model1->gstvalueperquantity=($priceperqty * $gstrate)/100;
				$model1->discountvalueperquantity=($priceperqty * $discountrate)/100;
				$model1->is_active=1;
			    $model1->updated_by=$session['user_id'];
				$model1->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model1->updated_on=date("Y-m-d H:i:s");
				$model1->gstvalue=number_format(Yii::$app -> request -> post('gst_value')[$key],2);
			    $model1->cgstvalue=$model1->gstvalue/2;
				$model1->sgstvalue=$model1->gstvalue/2;
				$model1->discountvalue=number_format(Yii::$app -> request -> post('discount_value')[$key],2);
				$model1->stockid=Yii::$app -> request -> post('stockid')[$key];
				$model1->stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
				if($model1->save())
				{
				
					
				}
				
				++$i;
				
				}
			
					echo"Y=".$returnid;
			}

		   
		   
        }
      else {
      	
		
            $productlist="";
$rows = Returndetail::find()->where(['return_id'=>$id])->all();
$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');

   $saledata=Salesreturn::find()->where(['return_id'=>$id])->one();
	$model=Saledetail::find()->where(['opsaleid'=>$saledata->saleid])->one();
	$returndetailmodel = new Saledetail();
	$searchModel = new SaledetailSearch();
	$dataProvider = $searchModel->returnsearch(Yii::$app->request->queryParams,$saledata->saleid);
	echo $this->render('update', [
	'model' => $model,
	'id' => $id,
	'companylist'=>$companylist,
	'productlist'=>$productlist,
	'saledetailmodel'=>$saledetailmodel,
	'searchModel'=>$searchModel,
	'saledata'=>$saledata,
	'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,
	'unitlist'=>$unitlist,
	
	]);
        }
    }

    /**
     * Deletes an existing Returndetail model.
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
     * Finds the Returndetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Returndetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Returndetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
