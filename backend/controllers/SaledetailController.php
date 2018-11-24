<?php

namespace backend\controllers;

use Yii;
use backend\models\Saledetail;
use backend\models\SaledetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Sales;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\Patienttype;
use backend\models\Patient;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;

use backend\models\CompanyBranch;

use backend\models\Productgrouping;
use backend\models\Physicianmaster;
use backend\models\Producttype;
use backend\models\Insurance;
use backend\models\Company;
use backend\models\Stockmaster;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\StockmasterSearch;
use backend\models\StockresponseSearch;

/**
 * SaledetailController implements the CRUD actions for Saledetail model.
 */
class SaledetailController extends Controller
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
        $searchModel = new SaledetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Saledetail model.
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
     * Creates a new Saledetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
        $model = new Saledetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->opsale_detailid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Saledetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->opsale_detailid]);
        } else {
            			
						
            		
			$saledetaildata=Saledetail::find()->where(['opsale_detailid'=>$model->opsale_detailid])->one();	
			$saleid=$saledetaildata->opsaleid;
			$mrnumber=$saledetaildata->mrnumber;
			
			
			$salesmodel = Sales::find()->where(['opsaleid'=>$saleid])->one();	
			
			
		
		$patient_details1 = Patient::find() -> where(['medicalrecord_number' => $mrnumber]) -> one();
		$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');

		

		$rows = Stockmaster::find() -> where(['is_active' => 1]) -> all();

	

		$patient_type = Patienttype::find() -> where(['patient_typeid' => $patient_details1 -> patient_type]) -> one();
		$ptype = "";
		if ($patient_type -> patient_typename == "Out Patient") {
			$ptype = "OP";
		} else if ($patient_type -> patient_typename == "In Patient") {
			$ptype = "IP";
		}
				$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		
		
		
		 $pmodel = new Patient();
			$patientmax = Patient::find() -> max('patient_id');
			$patientmax = $patientmax + 1;
			$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
			$patient_type = ArrayHelper::map(Patienttype::find() -> asArray() -> all(), 'patient_typeid', 'patient_typename');
			$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		
           
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		
		
		$insuranceid=$patient_details1->insurance_type;
		 $smodel = new Stockmaster();
        $searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch(Yii::$app->request->queryParams,$insuranceid);
	   
	   
	   $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		
       
		
		
		
		
		
		echo $this->render('wizardform', [
                'salesmodel' => $salesmodel,
                 'patient_details1'=>$patient_details1,
                 'companylist'=>$companylist,
                
                 'ptype'=>$ptype,
                 
                 'brandlist'=>$brandlist,
                 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'smodel' => $smodel, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patient_type'=>$patient_type,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'physicianlist'=>$physicianlist,'saledetailid'=>$id,'saleid'=>$saleid,'mrnumber'=>$mrnumber,'saledetaildata'=>$saledetaildata,
            ]);
        }
    }

    /**
     * Deletes an existing Saledetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	
	public function actionProductdetail_ep($id,$branch_id,$ptype,$autonumber)
	 {

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
	    if ($id != "") {
			echo $this->renderAjax('productdetail_ep', [
                 'model' => $model,
                 'unitlist'=>$unitlist,
                 'branch_id'=>$branch_id,
                 'stockresponseid'=>$id,
                 'autonumber'=>$autonumber,
                 'ptype'=>$ptype,
            ]);
		}
	}
	
	
	
	
	
	
	
	
	
	

    /**
     * Finds the Saledetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Saledetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Saledetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
		public function actionSavesales($saleid) {
			
		
		$model = Sales::find()->where(['opsaleid' => $saleid])->one();
		if ($model -> load(Yii::$app -> request -> post())) {
			$session = Yii::$app -> session;
			$model -> total = Yii::$app -> request -> post('totalprice');
			$brandcode=$_POST['brandcode'];
			$totaldiscountvalue=0;$totalgstvalue=0;
				foreach ($brandcode as $key => $value) {
					$totaldiscountvalue+= Yii::$app -> request -> post('discount_value')[$key];
					$totalgstvalue+= Yii::$app -> request -> post('gst_value')[$key];
					
				}
					$model->totalgstvalue=$totalgstvalue;
					$model->totalcgstvalue=$totalgstvalue/2;
					$model->totalsgstvalue=$totalgstvalue/2;
					$model->totaldiscountvalue=$totaldiscountvalue;
					$model -> updated_by = $session['user_id'];
					$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model -> updated_on = date("Y-m-d H:i:s");
					$model->name=Yii::$app -> request -> post('Sales')["name"];
					$model->emailid=Yii::$app -> request -> post('Sales')["emailid"];
					$model->dob=date("Y-m-d",strtotime(Yii::$app -> request -> post('Sales')["dob"]));
					$model->invoicedate=date("Y-m-d h:i:s",strtotime(Yii::$app -> request -> post('Sales')["invoicedate"]));
					$model->gender=Yii::$app -> request -> post('Sales')["gender"];
					$model->phonenumber=Yii::$app -> request -> post('Sales')["phonenumber"];
					$model->emailid=Yii::$app -> request -> post('Sales')["emailid"];
					
					
			if ($model -> save()) {
				
				
			/*	
				$saleid = $model -> opsaleid;
				$i = 1;
				
				$brandcode=$_POST['brandcode'];
				
				$modelx= Saledetail::find()->where(['opsaleid'=>$saleid])->all();
				
				foreach($modelx as $xmodel)
				{
					 Saledetail::findOne($xmodel->opsale_detailid)->delete();
					
				}
				
				
				foreach ($brandcode as $key => $value) {
					
						$model1=new Saledetail();
					$model1 -> opsaleid = $saleid;
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid =  Yii::$app -> request -> post('productid')[$key];
					$model1 -> batchnumber =  Yii::$app -> request -> post('batchnumber')[$key];
					$model1 -> brandcode =  Yii::$app -> request -> post('brandcode')[$key];
					$model1 -> stock_code =  Yii::$app -> request -> post('stock_code')[$key];
					$model1 -> compositionid = Yii::$app -> request -> post('compositionid')[$key];
					$model1 -> unitid = Yii::$app -> request -> post('unitid')[$key];
					$productqty = Yii::$app -> request -> post('totalunits')[$key];
					$model1 -> productqty = $productqty;
					$priceperqty = Yii::$app -> request -> post('priceperqty')[$key];
					$model1 -> priceperqty = $priceperqty;
					$model1->taxableamount=$priceperqty*$productqty;
					$gstrate = Yii::$app -> request -> post('gst')[$key];
					$model1 -> gstrate=$gstrate;
					$discountrate = Yii::$app -> request -> post('discount')[$key];
					$model1 -> discountrate=$discountrate;
					$gstvalueperqty=($priceperqty * $gstrate)/100;
					$model1->gstvalueperquantity=$gstvalueperqty;
					
					
					
					$model1->discountvalueperquantity=($priceperqty * $discountrate)/100;
					$model1 -> price =  number_format(Yii::$app -> request -> post('price')[$key],2);
					$model1 -> expiredate =  date("Y-m-d",strtotime(Yii::$app -> request -> post('expiredate')[$key]));
					$model1 -> is_active = 1;
					$model1 -> updated_by = $session['user_id'];
					$model1 -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					$model1->gstvalue=number_format(Yii::$app -> request -> post('gst_value')[$key],2);
					$model1->cgstvalue=$model1->gstvalue/2;
					$model1->sgstvalue=$model1->gstvalue/2;
					$model1->discountvalue=number_format(Yii::$app -> request -> post('discount_value')[$key],2);
					$increment=Yii::$app -> request -> post('dataincrement')[$key];
					$model1->discount_type=Yii::$app -> request -> post('discounttype'.$increment);
					$model1->mrpperunit=$priceperqty+$gstvalueperqty;
					$model1->stockid=Yii::$app -> request -> post('stockid')[$key];
					$model1->stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
					$model1 -> save();
					$i++;
				}


 */


				echo "Y";
				
				
				
				
			}

      

		}

	}
	
	
	
	
	
	
	
	
	
	
	
}
