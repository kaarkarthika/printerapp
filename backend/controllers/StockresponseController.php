<?php

namespace backend\controllers;

use Yii;
use backend\models\Stockresponse;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use backend\models\StockresponseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\Unit;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;
use backend\models\Stockreturn;
use backend\models\Productgrouping;
use backend\models\Product;
use backend\models\Vendor;
use backend\models\Producttype;
use backend\models\Composition;
use backend\models\CompanyBranch;
use backend\models\StockmasterSearch;
use backend\models\VendorBranch;
use backend\models\PurchaseLog;
class StockresponseController extends Controller
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
  

    public function actionIndex()
    {
    	 
        $searchModel = new StockresponseSearch();
		$session = Yii::$app->session;
					  $userid=$session['user_id'];
 
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$companybranchid);
      
		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	 public function actionAudit()
    {
     
	 	$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
	    $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		if($role=="Super")
		{
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		else{
			$companylist=[];
		}
		
		$session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		 $searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->stocksearch(Yii::$app->request->queryParams);
        return $this->render('audit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'companylist' => $companylist,
            'model' => $model,
           'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,
             
        ]);	
		
	 }
	
	
	public function actionBackorder()
    {
        $searchModel = new StockresponseSearch();
		$session = Yii::$app->session;
		 $userid=$session['user_id'];
 
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$companybranchid);
      

        return $this->render('backorder', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	
	public function actionQrcode($responseid)
    {
    	$model = $this->findModel($responseid);
        
     return $this->render('print_qr', ['responseid'=>$responseid ,'model'=>$model]);
    }
	
	
	
	
	
	 public function actionReturnindex()
    {
        $searchModel = new StockresponseSearch();
		$session = Yii::$app->session;
					  $userid=$session['user_id'];
 
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$companybranchid);
      

        return $this->render('returnindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stockresponse model.
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
     * Creates a new Stockresponse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stockresponse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->stockresponseid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stockresponse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->stockresponseid]);
        } else {
            return $this->render('update', [ 'model' => $model ]);
               
           
        }
    }
	
	
	public function actionUpdate1($id)
    {
    		
    	 $model1 = Stockrequest::find()->where(['requestid'=>$id])->one();
		 $branch=1;
		 
		 $model2="";
		 if($model1!=""){
		 	$model2=Stockrequest::find()->where(['requestid'=>$id])->all();
		 }
		
        $model3= Stockresponse::find()->where(['stockrequestid'=>$id])->all();	
	   	$model = Stockresponse::find()->where(['stockrequestid'=>$id])->one();	
	    if($model==""){
	   		$model=new Stockresponse();
	   }
	 
	   	
		$stock="";
		$data=Stockrequest::find()->where(['requestid'=>$id])->one();
		$requestcode=$data->requestcode;
		$unitid=$data->unitid;
		$unitlist=ArrayHelper::map(Unit::find()->where(['unitid'=>$unitid])->asArray()->all(), 'unitid', 'unitvalue');
		if($data!=""){
		$datamaster=Stockmaster::find()->where(['vendorid'=>$data->vendorid])->andwhere(['productid'=>$data->productid])->one();
			if($datamaster!="")	{
				$stock=$datamaster->stockid;
							}
			
		}

        if ($model->load(Yii::$app->request->post()) ) {
        	
			
        	$session = Yii::$app->session;
			$i=1;
			//echo '<pre>';
			//print_r($_POST);die;
			foreach ($_POST['Stockresponse']['unitid'] as $key => $value)
			 {
					
				$stockrequestid=Yii::$app->request->post('Stockresponse')['stockrequestid'][$key];
				$batchnumber=Yii::$app->request->post('Stockresponse')['batchnumber'][$key];
				$productgroupid=Yii::$app->request->post('Stockresponse')['productgroupid'][$key];
				$vendorbranch=Yii::$app->request->post('Stockmaster')['vendor_branchid'];
				
			    $stock = Stockmaster::find()->where(['productgroupid'=>$productgroupid])->one();	
				if($stock=="")
				{
					
			$stock=new Stockmaster();
		    $stock->serialnumber=Stockmaster::find()->orderBy(['stockid' => SORT_DESC])->one()+1;
			$stock->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
			$stock->branch_id=$branch;
			$stock->productgroupid=$productgroupid;
			$productgroupdata=Productgrouping::find()->where(['productgroupid'=>$productgroupid])->one();
			$productid=$productgroupdata->productid;
			$stock->productid=$productid;
		    $productdata=Product::find()->where(['productid'=>$productid])->one();
			$stock->vendorid=$productgroupdata->vendorid;
			$stock->vendor_branchid=$vendorbranch;
			$stock->compositionid=$productdata->composition_id;
			
			
			$stock->brandcode=$productgroupdata->brandcode;
			$stock->stockcode=$productgroupdata->stock_code;
			
			$unit=$productdata->unit;
			$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			
			if(!empty($unitdata))
			{
				if($unitdata->is_tablet == 1)
				{
					$stock->unitid=41;
					$unitquantity=1;
		   			$stock->unitquantity=$unitquantity;
					$stock->total_no_of_quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					$stock->quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
				}
				else 
				{
					$stock->unitid=$unit;
					$unitquantity=$unitdata->no_of_unit;
		   			$stock->unitquantity=$unitquantity;
					$stock->total_no_of_quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
					$receivedfreequantity=Yii::$app->request->post('Stockresponse')['receivedfreequantity'][$key];
					$quantity=$receivedquantity+$receivedfreequantity;
					$stock->quantity=$quantity;
				}
			}
			
		   
		   
		   	
		   
		   
		    $stock->batchnumber=Yii::$app->request->post('Stockresponse')['batchnumber'][$key];
			$stock->manufacturedate=date("Y-m-d",strtotime(Yii::$app->request->post('Stockresponse')['manufacturedate'][$key]));
			$stock->expiredate=date("Y-m-d",strtotime(Yii::$app->request->post('Stockresponse')['expiredate'][$key]));
			
			
			
			$stock->price=Yii::$app->request->post('Stockresponse')['purchaseprice'][$key];
			//	print_r($unitquantity);die;
			$stock->priceperqty=($stock->price)/($receivedquantity * $unitquantity);
			
			
			$stock->is_active=1;
			$session = Yii::$app->session;
			
		    $stock->updated_by=$session['user_id'];
		    $stock->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$stock->updated_on=date("Y-m-d H:i:s");
				}
				else
				{
					
			$productgroupdata=Productgrouping::find()->where(['productgroupid'=>$productgroupid])->one();
			$productid=$productgroupdata->productid;
		    $productdata=Product::find()->where(['productid'=>$productid])->one();
			
			$unit=$productdata->unit;
			$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			$unitquantity=$unitdata->no_of_unit;
			$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
			$receivedfreequantity=Yii::$app->request->post('Stockresponse')['receivedfreequantity'][$key];
			
			
			/*if(!empty($unitdata))
			{
				if($unitdata->is_tablet == 1)
				{
					$stock->unitid=41;
					//$unitquantity=$unitdata->no_of_unit;
		   			$stock->unitquantity=1;
					$stock->total_no_of_quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					$stock->quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					
				}
				else 
				{
					$stock->unitid=$unit;
					$unitquantity=$unitdata->no_of_unit;
		   			$stock->unitquantity=$unitquantity;
					$stock->total_no_of_quantity=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
					$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
					$receivedfreequantity=Yii::$app->request->post('Stockresponse')['receivedfreequantity'][$key];
					$quantity=$receivedquantity+$receivedfreequantity;
					$stock->quantity=$quantity;
				}
			}*/
			
			
			
			
			
			
			
			
			$totalprice=Yii::$app->request->post('Stockresponse')['purchaseprice'][$key];
			$quantity=$receivedquantity+$receivedfreequantity;
			$batchnumber=Yii::$app->request->post('Stockresponse')['batchnumber'][$key];
			$totalqty=Yii::$app->request->post('Stockresponse')['total_no_of_quantity'][$key];
			
			$receiveddata=Stockresponse::find()->where(['stockrequestid'=>$stockrequestid])->andwhere(['batchnumber'=>$batchnumber])->one();
			$stock->price=Yii::$app->request->post('Stockresponse')['purchaseprice'][$key];
			
			$stock->priceperqty=($stock->price)/($receivedquantity * $unitquantity);
			
			if($receiveddata)
			{
				$stock->quantity=$stock->quantity+$quantity-($receiveddata->receivedquantity+$receiveddata->receivedfreequantity);
				$stock->total_no_of_quantity=$stock->total_no_of_quantity+$totalqty-($receiveddata->total_no_of_quantity);
				
		        $stock->price=$stock->price+$totalprice-($receiveddata->purchaseprice);
				
			}
			else
			{
				$stock->quantity=$stock->quantity+$quantity;
				$stock->total_no_of_quantity=$stock->total_no_of_quantity+$totalqty;
		        $stock->price=$stock->price+$totalprice;
			}
			$stock->is_active=1;
			$session = Yii::$app->session;
		    $stock->updated_by=$session['user_id'];
		    $stock->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			
			$stock->updated_on=date("Y-m-d H:i:s");
			
			
				}
				
					
			if($stock->save())
			{
						
		   $model = Stockresponse::find()->where(['stockrequestid'=>$stockrequestid])->andwhere(['batchnumber'=>$batchnumber])->one();	
	   
	   	  if(empty($model)){
	    //if($model==""){
	   		$model=new Stockresponse();
			$session = Yii::$app->session;
        	
			$receiveddate=Yii::$app->request->post('Stockresponse')['receiveddate'];
			$model->receiveddate=date("Y-m-d",strtotime($receiveddate));
			
			$expiredate=Yii::$app->request->post('Stockresponse')['expiredate'][$key];
			$model->stockrequestid=Yii::$app->request->post('Stockresponse')['stockrequestid'][$key];
			$stockid=Yii::$app->request->post('Stockresponse')['stockid'][$key];
			$model->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
			$model->stockid=$stock->stockid;
			$model->request_code=Yii::$app->request->post('Stockresponse')['request_code'];
			$model->batchnumber=Yii::$app->request->post('Stockresponse')['batchnumber'][$key];
			$model->expiredate=date("Y-m-d",strtotime($expiredate));
			$purchaseddate=Yii::$app->request->post('Stockresponse')['purchasedate'][$key];
			$model->purchasedate=date("Y-m-d",strtotime($purchaseddate));
			$manufacturedate=Yii::$app->request->post('Stockresponse')['manufacturedate'][$key];
			$model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
			$unitid=Yii::$app->request->post('Stockresponse')['unitid'][$key];
			$unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
		    $unitreceivedqty=$unitdata->no_of_unit;
			$purchaseprice=Yii::$app->request->post('Stockresponse')['purchaseprice'][$key];
			$model->purchaseprice=$purchaseprice;
			$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
			$model->receivedquantity=$receivedquantity;
			$receivedfreequantity=Yii::$app->request->post('Stockresponse')['receivedfreequantity'][$key];
			$model->receivedfreequantity=$receivedfreequantity;
			$discountpercent=Yii::$app->request->post('Stockresponse')['discountpercent'][$key];
			$model->discountpercent=$discountpercent;
			$discountvalue=Yii::$app->request->post('Stockresponse')['discountvalue'][$key];
			$model->discountvalue=$discountvalue;
			$gstpercent=Yii::$app->request->post('Stockresponse')['gstpercent'][$key];
			$model->gstpercent=$gstpercent;
			$gstvalue=Yii::$app->request->post('Stockresponse')['gstvalue'][$key];
			$model->gstvalue=$gstvalue;
			$cgstpercent=Yii::$app->request->post('Stockresponse')['cgstpercent'][$key];
			$model->cgstpercent=$cgstpercent;
			$cgstvalue=Yii::$app->request->post('Stockresponse')['cgstvalue'][$key];
			$model->cgstvalue=$cgstvalue;
			$sgstpercent=Yii::$app->request->post('Stockresponse')['sgstpercent'][$key];
			$model->sgstpercent=$sgstpercent;
			$sgstvalue=Yii::$app->request->post('Stockresponse')['sgstvalue'][$key];
			$model->sgstvalue=$sgstvalue;
			$igstpercent=Yii::$app->request->post('Stockresponse')['igstpercent'][$key];
			$model->igstpercent=$igstpercent;
			$igstvalue=Yii::$app->request->post('Stockresponse')['igstvalue'][$key];
			$model->igstvalue=$igstvalue;
			$priceperquantity=$purchaseprice/$receivedquantity;
			$model->priceperquantity=$priceperquantity;
			$model->branch_id=$branch;
			$mrpperunit=Yii::$app->request->post('Stockresponse')['mrpperunit'][$key];
			$model->mrpperunit=$mrpperunit;
			$mrp=Yii::$app->request->post('Stockresponse')['mrp'][$key];
			$model->mrp=$mrp;
			$totalreceivedqty=$unitreceivedqty*($receivedquantity+$receivedfreequantity);
			$model->unitid=$unitid;
			$model->total_no_of_quantity=$totalreceivedqty;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->priceperquantity=$purchaseprice/($receivedquantity*$unitreceivedqty);
			$model->branch_id=$branch;
			
			if($model->save())
			{
			  if($model->sales_status != 'Y')
			  {
			  		$purchase_log = PurchaseLog::find()->where(['stock_res_id' => $model->stockresponseid])->one();
					if(empty($purchase_log))
					{
						$purchase_log = new PurchaseLog();	
					}
					
					$purchase_log->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
					$purchase_log->stock_res_id =  $model->stockresponseid;
					$purchase_log->stock_req_id =  $model->stockrequestid;
					$purchase_log->req_code =  $model->request_code;
					$purchase_log->stock_id =  $stock->stockid;
					$purchase_log->productgroupid = $stock->productgroupid; 
					$purchase_log->productid =  $stock->productid;
					$purchase_log->vendor_id =  $stock->vendorid; 
					$purchase_log->vendor_branch_id =  $stock->vendor_branchid; 
					$purchase_log->composition_id =  $stock->compositionid; 
					$purchase_log->branch_id =  $model->branch_id;
					$purchase_log->batch_number =  	$model->batchnumber;
					$purchase_log->received_qty =  $model->receivedquantity;
					$purchase_log->total_qty =  $model->total_no_of_quantity;
					$purchase_log->unit_id =  $model->unitid;
					$purchase_log->received_date =  date('Y-m-d',strtotime($model->receiveddate));
					$purchase_log->purchase_price =  $model->purchaseprice;
					$purchase_log->priceperquantity =  $model->	priceperquantity;
					$purchase_log->receivedfreequantity =  $model->	receivedfreequantity;
					$purchase_log->discountpercent =  $model->discountpercent;
					$purchase_log->discountvalue =  $model->discountvalue;
					$purchase_log->gstpercent =  $model->gstpercent;
					$purchase_log->gstvalue =  $model->	gstvalue;
					$purchase_log->cgstpercent =   $model->cgstpercent;
					$purchase_log->cgstvalue =  $model->cgstvalue;
					$purchase_log->sgstpercent =  $model->sgstpercent;
					$purchase_log->sgstvalue =  $model->sgstvalue;
					$purchase_log->igstpercent =  $model->igstpercent;
					$purchase_log->igstvalue =  $model->igstvalue;
					$purchase_log->mrpperunit =  $model->mrpperunit;
					$purchase_log->mrp =  $model->mrp;
					$purchase_log->manufacturedate =  date('Y-m-d',strtotime($model->manufacturedate));
					$purchase_log->expiredate =  date('Y-m-d',strtotime($model->expiredate));
					$purchase_log->purchasedate =  date('Y-m-d',strtotime($model->purchasedate));
					$purchase_log->sales_status =  $model->	sales_status;
					$purchase_log->updated_by =   $model->updated_by;
					$purchase_log->created_at =  date('Y-m-d H:i:s');
					$purchase_log->updated_on =  date('Y-m-d H:i:s');
					$purchase_log->updated_ipaddress =  $model->updated_ipaddress;
					if($purchase_log->save())
					{
						
					}
					else {
							print_r($purchase_log->getErrors());die;
						}
			  }
				
			}
	   }
		
		else{
			
			
			 $session = Yii::$app->session;
			$receiveddate=Yii::$app->request->post('Stockresponse')['receiveddate'];
			$model->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
			$model->receiveddate=date("Y-m-d",strtotime($receiveddate));
			$expiredate=Yii::$app->request->post('Stockresponse')['expiredate'][$key];
			$model->stockrequestid=Yii::$app->request->post('Stockresponse')['stockrequestid'][$key];
			$stockid=Yii::$app->request->post('Stockresponse')['stockid'][$key];
			$model->stockid=$stock->stockid;
			$model->request_code=Yii::$app->request->post('Stockresponse')['request_code'];
			$model->batchnumber=Yii::$app->request->post('Stockresponse')['batchnumber'][$key];
			$model->expiredate=date("Y-m-d",strtotime($expiredate));
			$purchaseddate=Yii::$app->request->post('Stockresponse')['purchasedate'][$key];
			$model->purchasedate=date("Y-m-d",strtotime($purchaseddate));
			$manufacturedate=Yii::$app->request->post('Stockresponse')['manufacturedate'][$key];
			$model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
			$unitid=Yii::$app->request->post('Stockresponse')['unitid'][$key];
			$unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
		    $unitreceivedqty=$unitdata->no_of_unit;
			$purchaseprice=Yii::$app->request->post('Stockresponse')['purchaseprice'][$key];
			$model->purchaseprice=$purchaseprice;
			$receivedquantity=Yii::$app->request->post('Stockresponse')['receivedquantity'][$key];
			$model->receivedquantity=$receivedquantity;
			$receivedfreequantity=Yii::$app->request->post('Stockresponse')['receivedfreequantity'][$key];
			$model->receivedfreequantity=$receivedfreequantity;
			$totalreceivedqty=$unitreceivedqty*($receivedquantity+$receivedfreequantity);
			$model->unitid=$unitid;
			$model->total_no_of_quantity=$totalreceivedqty;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
			$discountpercent=Yii::$app->request->post('Stockresponse')['discountpercent'][$key];
			$model->discountpercent=$discountpercent;
			$discountvalue=Yii::$app->request->post('Stockresponse')['discountvalue'][$key];
			$model->discountvalue=$discountvalue;
			$gstpercent=Yii::$app->request->post('Stockresponse')['gstpercent'][$key];
			$model->gstpercent=$gstpercent;
			$gstvalue=Yii::$app->request->post('Stockresponse')['gstvalue'][$key];
			$model->gstvalue=$gstvalue;
			$cgstpercent=Yii::$app->request->post('Stockresponse')['cgstpercent'][$key];
			$model->cgstpercent=$cgstpercent;
			$cgstvalue=Yii::$app->request->post('Stockresponse')['cgstvalue'][$key];
			$model->cgstvalue=$cgstvalue;
			$sgstpercent=Yii::$app->request->post('Stockresponse')['sgstpercent'][$key];
			$model->sgstpercent=$sgstpercent;
			$sgstvalue=Yii::$app->request->post('Stockresponse')['sgstvalue'][$key];
			$model->sgstvalue=$sgstvalue;
			$igstpercent=Yii::$app->request->post('Stockresponse')['igstpercent'][$key];
			$model->igstpercent=$igstpercent;
			$igstvalue=Yii::$app->request->post('Stockresponse')['igstvalue'][$key];
			$model->igstvalue=$igstvalue;
			$model->priceperquantity=$purchaseprice/($receivedquantity*$unitreceivedqty);
			
			$model->branch_id=$branch;
			$mrpperunit=Yii::$app->request->post('Stockresponse')['mrpperunit'][$key];
			$model->mrpperunit=$mrpperunit;
			$mrp=Yii::$app->request->post('Stockresponse')['mrp'][$key];
			$model->mrp=$mrp;
			//$model->save();
			
			if($model->save())
			{
				if($model->sales_status != 'Y')
				{
					$purchase_log = PurchaseLog::find()->where(['stock_res_id' => $model->stockresponseid])->one();
					if(empty($purchase_log))
					{
						$purchase_log = new PurchaseLog();	
					}
					
					$purchase_log->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
					$purchase_log->stock_res_id =  $model->stockresponseid;
					$purchase_log->stock_req_id =  $model->stockrequestid;
					$purchase_log->req_code =  $model->request_code;
					$purchase_log->stock_id =  $stock->stockid;
					$purchase_log->productgroupid = $stock->productgroupid; 
					$purchase_log->productid =  $stock->productid;
					$purchase_log->vendor_id =  $stock->vendorid; 
					$purchase_log->vendor_branch_id =  $stock->vendor_branchid; 
					$purchase_log->composition_id =  $stock->compositionid; 
					$purchase_log->branch_id =  $model->branch_id;
					$purchase_log->batch_number =  	$model->batchnumber;
					$purchase_log->received_qty =  $model->receivedquantity;
					$purchase_log->total_qty =  $model->total_no_of_quantity;
					$purchase_log->unit_id =  $model->unitid;
					$purchase_log->received_date =  date('Y-m-d',strtotime($model->receiveddate));
					$purchase_log->purchase_price =  $model->purchaseprice;
					$purchase_log->priceperquantity =  $model->	priceperquantity;
					$purchase_log->receivedfreequantity =  $model->	receivedfreequantity;
					$purchase_log->discountpercent =  $model->discountpercent;
					$purchase_log->discountvalue =  $model->discountvalue;
					$purchase_log->gstpercent =  $model->gstpercent;
					$purchase_log->gstvalue =  $model->	gstvalue;
					$purchase_log->cgstpercent =   $model->cgstpercent;
					$purchase_log->cgstvalue =  $model->cgstvalue;
					$purchase_log->sgstpercent =  $model->sgstpercent;
					$purchase_log->sgstvalue =  $model->sgstvalue;
					$purchase_log->igstpercent =  $model->igstpercent;
					$purchase_log->igstvalue =  $model->igstvalue;
					$purchase_log->mrpperunit =  $model->mrpperunit;
					$purchase_log->mrp =  $model->mrp;
					$purchase_log->manufacturedate =  date('Y-m-d',strtotime($model->manufacturedate));
					$purchase_log->expiredate =  date('Y-m-d',strtotime($model->expiredate));
					$purchase_log->purchasedate =  date('Y-m-d',strtotime($model->purchasedate));
					$purchase_log->sales_status =  $model->	sales_status;
					$purchase_log->updated_by =   $model->updated_by;
					$purchase_log->created_at =  date('Y-m-d H:i:s');
					$purchase_log->updated_on =  date('Y-m-d H:i:s');
					$purchase_log->updated_ipaddress =  $model->updated_ipaddress;
					if($purchase_log->save())
					{
						
					}
					else {
						print_r($purchase_log->getErrors());die;
					}
				}
			}
		}

            $stockrequestmodel=Stockrequest::find()->where(['requestid'=>$stockrequestid])->all();
				foreach ($stockrequestmodel as $key => $value) {
					$value->is_active=0;
					$value->updated_by=$session['user_id'];
			        $value->updated_on=date("Y-m-d H:i:s");
					$value->save();
				}
             }
				
			}
               Yii::$app->getSession()->setFlash('success','Stock Receive Updated successfully');
			  return $this->redirect('?r=stockresponse/index');
			
            
        } else {
            return $this->render('update', [
                'model' => $model,
                 'stock' => $stock,
                 'requestcode'=>$requestcode,
                 'unitlist'=>$unitlist,
                  'model1'=>$model1,
                  'model2'=>$model2,
                  'model3'=>$model3,
            ]);
        }
    }






	public function actionReturn($id)
    {

    	 $model1 = Stockrequest::find()->where(['requestid'=>$id])->one();
		 $branch=$model1->branch_id;
		
		 $model2="";
		 if($model1!=""){
		 	$model2=Stockrequest::find()->where(['requestid'=>$id])->all();
			
		 }
		
        $model3= Stockresponse::find()->where(['stockrequestid'=>$id])->all();	
	  
	   
	   		$model = Stockresponse::find()->where(['stockrequestid'=>$id])->one();	
	    
	    if($model==""){
	   		$model=new Stockresponse();
	   }
		$stock="";
		$data=Stockrequest::find()->where(['requestid'=>$id])->one();
		$requestcode=$data->requestcode;
		$unitid=$data->unitid;
		$unitlist=ArrayHelper::map(Unit::find()->where(['unitid'=>$unitid])->asArray()->all(), 'unitid', 'unitvalue');
		
		if($data!="")
		{
			$datamaster=Stockmaster::find()->where(['vendorid'=>$data->vendorid])->andwhere(['productid'=>$data->productid])->one();
			if($datamaster!="")	
			{
				$stock=$datamaster->stockid;
			}
		}

        if ($model->load(Yii::$app->request->post()) ) {
        	$session = Yii::$app->session;
			$i=1;
			foreach ($_POST['Stockresponse']['unitid'] as $key => $value) {
				$stockrequestid=Yii::$app->request->post('Stockresponse')['stockrequestid'][$key];
		   $model = Stockreturn::find()->where(['stockrequestid'=>$stockrequestid])->one();	
		   $responsemodel = Stockresponse::find()->where(['stockrequestid'=>$stockrequestid])->one();	
		  
	   
	    if($model==""){
	   		$model=new Stockreturn();
			$returnqty=Yii::$app->request->post('returnquantity'.$i);
			$model->returnquantity=$returnqty;
			$qty=0;
			$totalqty=0;
		   }
		else{
			$qty=$model->returnquantity;
			$returnqty=Yii::$app->request->post('returnquantity'.$i);
			$model->returnquantity=$returnqty;
			$totalqty=$model->total_no_of_quantity;
	      	}
			$session = Yii::$app->session;
			$receiveddate=Yii::$app->request->post('Stockresponse')['receiveddate'];
			$model->receiveddate=date("Y-m-d",strtotime($receiveddate));
			$expiredate=Yii::$app->request->post('expiredate'.$i);
			$model->stockrequestid=Yii::$app->request->post('Stockresponse')['stockrequestid'][$key];
			$stockid=Yii::$app->request->post('stockid')[$key];
			$model->stockid=$stockid;
			$model->request_code=Yii::$app->request->post('Stockresponse')['request_code'];
			$model->batchnumber=Yii::$app->request->post('batchnumber'.$i);
			$model->expiredate=date("Y-m-d",strtotime($expiredate));
			$purchaseddate=Yii::$app->request->post('purchasedate'.$i);
			$model->purchasedate=date("Y-m-d",strtotime($purchaseddate));
			$manufacturedate=Yii::$app->request->post('manufacturedate'.$i);
			$model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
			$receivedquantity=Yii::$app->request->post('receivedquantity'.$i);
			$unitid=Yii::$app->request->post('Stockresponse')['unitid'][$key];
			$model->receivedquantity=$receivedquantity;
			$model->unitid=$unitid;
			$totalunits=Yii::$app->request->post('totalunits'.$i);
			$model->total_no_of_quantity=$totalunits;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$mrpperunit=$responsemodel->mrpperunit;
			$model->priceperquantity=$mrpperunit;
			$model->branch_id=$branch;
			$model->purchaseprice=$mrpperunit*$totalunits;
			$model->returndate=date("Y-m-d");
			
			
			if($model->save())
			{
			    $model1 = Stockmaster::find()->where(['stockid'=>$stockid])->one();	
				$model1->quantity=$model1->quantity+$qty-$model->returnquantity;
				$model1->total_no_of_quantity=$model1->total_no_of_quantity+$totalqty-$model->total_no_of_quantity;
				$model1->updated_on=date("Y-m-d H:i:s");
				$model1->save();
				if($model1->save()){
				$responsemodel->receivedquantity=$responsemodel->receivedquantity+$qty-$model->returnquantity;
				$responsemodel->total_no_of_quantity=$responsemodel->total_no_of_quantity+$totalqty-$model->total_no_of_quantity;
				$responsemodel->updated_on=date("Y-m-d H:i:s");
				$responsemodel->save();
				}
				
			}
			 
			 $i++;
	         }

               Yii::$app->getSession()->setFlash('success','Stock Return Updated successfully');
			  return $this->redirect('?r=stockresponse/returnindex');
			
            
        } else {
        	
            return $this->render('return', [
                'model' => $model,
                 'stock' => $stock,
                 'requestcode'=>$requestcode,
                 'unitlist'=>$unitlist,
                  'model1'=>$model1,
                  'model2'=>$model2,
                  'model3'=>$model3,
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
        if (($model = Stockresponse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
		 public function actionGetunitquantity($id,$dataid)
    {
    	
		$rows=Unit::find()->where(['unitid'=>$id])->one();
		$res["noofunit"]=$rows->no_of_unit;
		$res["dataid"]=$dataid;
        return json_encode($res);
		
	}




public function actionGetigstcalculation($id,$dataid)
    {
    	
		$rows=VendorBranch::find()->where(['vendor_branchid'=>$id])->one();
		$res["igstpercent"]=$rows->igstpercent;
		$res["dataid"]=$dataid;
        return json_encode($res);
		
		
	}




}
