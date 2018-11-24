<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use backend\models\ApiLog;
use backend\models\BranchAdmin;
use backend\models\Patient;
use backend\models\Stockresponse;
use backend\models\Stockmaster;
use yii\data\ActiveDataProvider;
use backend\models\CompanyBranch;
use backend\models\Product;
use backend\models\StockresponseSearch;
use backend\models\Sales;
use backend\models\Saledetail;
use backend\models\PaymentMethod;
use backend\models\PaymentType;
use backend\models\InvoicePayment;
use backend\models\Salesdetail;
use backend\models\Unit;
use backend\models\Salesreturn;
use backend\models\Returndetail;
use yii\db\Query; 



class DmcApiController extends Controller
{
   
    public function behaviors()
    {
        return [
                'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [ 'logout' => ['post']]],
                           ];
    }

    
  public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}
  
  
  
  public function actionFetchpatient(){
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	
	/********* Log save start **********/	
		$log_model=new ApiLog();
		$log_model->event_key="fetch-patient";
		$log_model->request_data=$postd;
		$log_model->created_at=date("Y-m-d H:i:s");
		$log_model->save();
		$logid=$log_model->autoid;
	/********* Log save end **********/

	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','mrn_no');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		$mrn_no=$requestInput['mrn_no'];
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data){
			
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrn_no])->one();
			
			if($patientdata)
			{
					
				$patientname=$patientdata->firstname.' '.$patientdata->lastname;	
				$mobileno=$patientdata->patient_mobilenumber;
				$dob=date("d/m/Y",strtotime($patientdata->dob));
				$emailid=$patientdata->emailid;
				$address=$patientdata->address;
				$det['patientname']=$patientname;
				if($patientdata->patient_type==1)
				{
					$det['patienttype']="IP";
				}
				else{
					$det['patienttype']="OP";
				}
				
				$det['mobilenumber']=$mobileno;
				$det['dob']=$dob;
				$det['emailid']=$emailid;
				$det['address']=$address;
				$list['status']=true;
				$list['message']="success";
				$list['data'][]=$det;
			}
			
			else{
				$list['message']="Medical Record Number Is Invalid";
			}
		}
		else{
			$list['message']="Invalid Authkey";
		}
		
	}
	$response['Output'][]=$list;
/********* Log save start **********/		
	if($logid!=''){
		$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
		$log_model->response_data=json_encode($list);
		$log_model->save();
	}
/********* Log save end **********/	
	
	return json_encode($response);	
  
  }


   public function actionSearchstock()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	/********* Log save start **********/	
		$log_model=new ApiLog();
		$log_model->event_key="search-stock";
		$log_model->request_data=$postd;
		$log_model->created_at=date("Y-m-d H:i:s");
		$log_model->save();
		$logid=$log_model->autoid;
	/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','search_key');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		$search_key=$requestInput['search_key'];
	
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data){
 
	
		$query = new Query;
        $query->select(['stockresponse.stockresponseid','stockresponse.stockid', 'stockmaster.stockcode','stockresponse.batchnumber',
        'stockmaster.stockid','product.productid',
        'product.productname','producttype.product_typeid','producttype.product_type','composition.composition_id','composition.composition_name'])  
		->from('stockresponse')
		
		->where(['stockresponse.branch_id'=>$data->ba_branchid])
		->andwhere(['>=','stockresponse.total_no_of_quantity',0])
		->andwhere(['LIKE','product.productname',$search_key.'%',false])
		->innerJoin('stockmaster', 'stockresponse.stockid = stockmaster.stockid')
		->innerJoin('product', 'product.productid = stockmaster.productid')
		->innerJoin('composition', 'stockmaster.compositionid = composition.composition_id')
		->innerJoin('producttype', 'product.product_typeid = producttype.product_typeid');
		
		
		
		
$command = $query->createCommand();
$data1 = $command->queryAll();	

	   
		 foreach($data1 as $k)
		 {
		 	$det=array();
		 	$det['stockresponseid'] = $k['stockresponseid'];
			$det['stock_code'] = $k['stockcode'];
		    $det['product_name'] = $k['productname'];
			$det['product_composition'] = $k['composition_name'];
			$det['product_type'] = $k['product_type'];
			$det['batchnumber'] = $k['batchnumber'];
			$details[]=$det;
		 }
			$list['status']=true;
			$list['message']="success";
			$list['data']=$details;	
	
		
		}else
		{
			$list['status']="Invalid Authkey";
		}
		
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!='')
		{
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	return json_encode($response);	
  }


 public function actionFetchstockdetails()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-stockdetails";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','stock_code');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		$stock_code=$requestInput['stock_code'];
		
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
		   
		    $branchid=$data->ba_branchid;
 $datastock = Stockresponse::find()->Where(['stockresponse.branch_id'=>$branchid])
  ->andWhere(["stockmaster.stockcode"=>$stock_code])->joinwith(["stockbrandcode"])->all();
			
	    if($datastock)
		{
		foreach($datastock as $data1)
			{
				if($data1->total_no_of_quantity>0)
				{
		    $det1=array();
		    $det['stock_code'] = $data1->stockbrandcode->stockcode;
		    $det['product_name'] = $data1->stockbrandcode->product->productname;
			$det['hsn_code'] = $data1->stockbrandcode->product->hsn_code;
			$det['product_composition'] = $data1->stockbrandcode->composition->composition_name;
			$det['product_type'] = $data1->stockbrandcode->product->producttype->product_type;
			$det1['stockresponseid']=$data1->stockresponseid;
			$det1['batch_no']=$data1->batchnumber;
			$det1['expiry_date']=date("d/m/Y",strtotime($data1->expiredate));
			$det1['manufacture_date']=date("d/m/Y",strtotime($data1->manufacturedate));
			$custommrp=($data1->mrpperunit)/(1+(0.01*($data1->gstpercent)));
			$det1['unitprice']=number_format($custommrp,2);
			$det1['gst_percent'] = $data1->gstpercent;
			$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$branchid])->all();
			 $currentqty=0;
			 if($saledata)
				 {
				 	foreach($saledata as $kk)
			{
			    $saledetaildata=Saledetail::find()->where(['opsaleid'=>$kk->opsaleid])->andwhere(['stockresponseid'=>$data1->stockresponseid])->all();
				if($saledetaildata)
				{
					foreach($saledetaildata as $l)
				{
					$currentqty+=$l->productqty;	
				}
				
				}
				
			}

				 }
				 $availableqty=($data1->total_no_of_quantity)-$currentqty;
			$det1['available_qty']=$availableqty;
			$details1[]=$det1;
				}
		   
		}
			 $list['status']=true;
			$list['message']="success";
			
			if(!empty($details1))
		{
			$list['stockinfo']=$det;
			$list['data']=$details1;
		}
			
		}
		else{
			
			 $list['status']=false;
			$list['message']="No Stock Found";
		}
		}
		
		
		else{
			$list['message']="Invalid Authkey";
		}
		
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }




 public function actionFetchinvoice()
   {
   	
	
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-invoice";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
$field_check=array('authkey','paidstatus');

/******** pagination start *********/ 
/******** pagination start *********/ 
  $page = 1;
  $start = 10;
  $limit = 10;
  if (isset($requestInput['page']) && $requestInput['page'] != "") {
   $page = $requestInput['page'];
   if (!is_numeric($page)) {
    $page = 1;
   }
   $start = $page * $limit;
  }
  /********** pagination end **********/

	
	$list['status']=false;
	$list['message']="";
	
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes')
	{
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$paidstatus=$requestInput['paidstatus'];
		$invnumber=$requestInput['invoicenumber'];
		
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
		 
		   
		    $branchid=$data->ba_branchid;
			if($invnumber=="")
			{
				 $invoice = Sales::find()->where(['branch_id'=>$branchid])->andwhere(['paid_status'=>$paidstatus])
->orderBy(['opsaleid'=>SORT_DESC,'updated_on'=>SORT_DESC])->limit($start)->all();
 
			}
			else {
				$invoice = Sales::find()->where(['branch_id'=>$branchid])->andwhere(['paid_status'=>$paidstatus])
 ->andwhere(['opsaleid'=>$invnumber])->orderBy(['opsaleid'=>SORT_DESC])->all();
 
			}
			

 
	
	    if($invoice)
		{
			
			foreach($invoice as $data1)
			{
		    $det1=array();
			$det1['mrnumber']=$data1->mrnumber;
			$count=Saledetail::find()->Where(['opsaleid'=>$data1->opsaleid])->count();
			$det1['patientname']=$data1->name;
			$det1['invoicedate']=date("d/m/Y",strtotime($data1->invoicedate));
			$det1['billnumber']=$data1->billnumber;
			$det1['paidstatus']=$data1->paid_status;
			$det1['overalltotal']=$data1->overalltotal;
			$det1['noofsaleproducts']=$count;
			$det1['phonenumber']=$data1->phonenumber;
			$det1['saleid']=$data1->opsaleid;
			$details1[]=$det1;
		  }
			if(!empty($details1))
		  {
		     $list['status']=true;
			$list['message']="success";
			$list['data']=$details1;
		  }
		  else{
			 $list['status']=false;
			 $list['message']="Invoice Not Found";
		     }
		  
		}
		
		else{
			$list['message']="Invalid Invoice";
		}
		
	}
else {
	$list['status']=false;
			 $list['message']="Invalid Auth Key";
}
		
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }




 public function actionEditinvoice()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="update-invoice";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/

	
	$xlist['status']=false;
	$xlist['message']="";
	$field_check=array('authkey','invoicenumber');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$xlist['status']=false;
		$xlist['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		$invoiceno=$requestInput['invoicenumber'];
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
		 $branchid=$data->ba_branchid;
         $data1 = Sales::find()->Where(['branch_id'=>$branchid])->andwhere(['billnumber'=>$invoiceno])->one();
	    if($data1)
		{
			$xlist['authkey']=$data->auth_key;
			
		    $xlist["saleinfo"]['branch_id']=$data1->branch_id;
			$xlist["saleinfo"]['name']=$data1->name;
			$xlist["saleinfo"]['dob']=$data1->dob;
			$xlist["saleinfo"]['phonenumber']=$data1->phonenumber;
			$xlist["saleinfo"]['invoicedate']=date("d/m/Y",strtotime($data1->invoicedate));
			$xlist["saleinfo"]['mrnumber']=$data1->mrnumber;
			
			
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$data1->mrnumber])->one();
			if($patientdata)
			{
				$ptype=$patientdata->patient_type;
				$patienttype="OP";	
				if($ptype==1)
				{
				$patienttype="IP";	
				}
			}
			$xlist["saleinfo"]['patienttype']=$patienttype;
			$xlist["saleinfo"]['total']=number_format($data1->total,2);
			$xlist["saleinfo"]['totalgstvalue']=number_format($data1->totalgstvalue,2);
			$xlist["saleinfo"]['totaldiscountvalue']=number_format($data1->totaldiscountvalue,2);
			$xlist["saleinfo"]['totaltaxableamount']=number_format($data1->totaltaxableamount,2);
			$xlist["saleinfo"]['overalldiscounttype']=$data1->overalldiscounttype;
			$xlist["saleinfo"]['overalldiscountpercent']=$data1->overalldiscountpercent;
			$xlist["saleinfo"]['overalldiscountamount']=number_format($data1->overalldiscountamount,2);
			$xlist["saleinfo"]['overalltotal']=number_format($data1->overalltotal,2);
			$xlist["saleinfo"]['opsaleid']=$data1->opsaleid;
			$xlist["saleinfo"]['paid_status']=$data1->paid_status;
			
					$saledetaildata1=Saledetail::find()->where(['opsaleid'=>$data1->opsaleid])->groupBy(['stock_code'])->all();
					$ko=1;
					foreach($saledetaildata1 as $kk)
					{
						
						$saledetaildata2=Saledetail::find()->where(['stock_code'=>$kk->stock_code])->andwhere(['opsaleid'=>$data1->opsaleid])->all();
				
			$stockresponsedata=Stockresponse::find()->where(['stockresponseid'=>$kk->stockresponseid])->one();
			$list['productdetail']['saledate']=date("d/m/Y",strtotime($kk->saledate));
			$list['productdetail']['productid']=$kk->productid;
			$list['productdetail']['stockname']=$kk->product->productname;
			$list['productdetail']['hsncode']=$kk->product->hsn_code;
			$list['productdetail']['producttype']=$kk->product->producttype->product_type;
			$list['productdetail']['brandcode']=$kk->brandcode;
			$list['productdetail']['stockcode']=$kk->stock_code;
			$list['productdetail']['compositionid']=$kk->compositionid;
			$list['productdetail']['compositionname']=$kk->composition->composition_name;
			$list['productdetail']['unitid']=$kk->unitid;
			$list['productdetail']['discountpercent']=$kk->discountrate;
			$list['productdetail']['discountamount']=number_format($kk->discountvalue,2);
			$list['productdetail']['discounttype']=$kk->discount_type;
			
						
					foreach($saledetaildata2 as $k)	
					{
				
			
		     $det3=array();
			$det3['batchnumber']=$k->batchnumber;
			$det3['productqty']=$k->productqty;
			$det3['price']=number_format($k->price,2);
			$det3['taxableamount']=number_format($k->taxableamount,2);
			$unitprice=($k->taxableamount)/($k->productqty);
			$det3['unitprice']=number_format($unitprice,2);
			$det3['expiredate']=date("d/m/Y",strtotime($k->expiredate));
			$det3['manufacturedate']=date("d/m/Y",strtotime($stockresponsedata->manufacturedate));
			$det3['stockid']=$k->stockid;
			$det3['stockresponseid']=$k->stockresponseid;
			$det3['gstpercent']=$k->gstrate;
			
			$stockresponsedata1=Stockresponse::find()->where(['stockresponseid'=>$k->stockresponseid])->one();
			
			$currentqty=0;
		    $saledetaildata3=Saledetail::find()->where(['opsaleid'=>$data1->opsaleid])->andwhere(['stockresponseid'=>$k->stockresponseid])->one();
				if($saledetaildata3)
				{
				$currentqty+=$saledetaildata3->productqty;
				}
			 $saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$branchid])->all();
					foreach($saledata as $kkk)
										{
										  $saleids=$kkk->opsaleid;
										  $paymentqty=0;
										$saledetaildatax=Saledetail::find()->where(['opsaleid'=>$saleids])->andwhere(['stockresponseid'=>$k->stockresponseid])->all();
										if($saledetaildatax)
										{
											foreach($saledetaildatax as $lll)
											{
											$paymentqty+=$lll->productqty;	
										    }
										}
											
										}
		    $availableqty=($stockresponsedata->total_no_of_quantity)-$paymentqty+$currentqty;
			$det3['availablequantity']=$availableqty;
			$detail3[]=$det3;
			
			++$ko;
			}
			
			 $det5=$list['productdetail'];
			 $list['saledetailinfo']=$detail3;
			 $xlist['productlistdata'][]=$list;
			 $list['productdetail']=array();
			  $list['saledetailinfo']=array();
			  $detail3=array();
			
					}
				
					
					
	              	
				
			
			
			}
			if(!empty($xlist))
		  {
		     $xlist['status']=true;
			 $xlist['message']="success";
			  
			
		  }
		  else
		     {
			 $xlist['status']=false;
			 $xlist['message']="Invoice Not Found";
		     }
		  
		}
		
		else{
			$xlist['message']="Invalid Authkey";
		}
		
	}
		
	
	$response['Output'][]=$xlist;
	
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($response);
			$log_model->save();
		}
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }





public function actionFetchlogin()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-login";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('username','password');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$username=$requestInput['username'];
		$password=$requestInput['password'];
	    $user_data = BranchAdmin::find()->where(['ba_name' => $username])->one();
			 
			if($user_data){
           $haspassword=$user_data->password_hash;
		   $branchid=$user_data->ba_branchid;
          if(!isset($haspassword))
		      {
                $haspassword=Yii::$app->security->generatePasswordHash(date("Y-m-d"));
             }
            	if(Yii::$app->security->validatePassword($password,$haspassword))
					{
					   $branchdata=CompanyBranch::find()->where(['branch_id'=>$branchid])->one();
					   $list['authkey']=$user_data->auth_key;	
					   $list['branchcode']=$branchdata->branch_code;	
					   $list['branchname']=$branchdata->branch_name;	
					   $list['branchid']=$branchid;		   
					   $list['status']=true;
					   $list['message']= "success";           
					}
					else
					{
					   $list['status']=false;
			           $list['message']=" Invalid Password";
					}
			
            }
			else{
            	$list['status']=false;
		$list['message']= "Invalid Username";
			}
	
		
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }


  public function actionFetchproductlist()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-productlist";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
	
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		
	   $data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
			$productdata=Product::find()->select(['productname'])->asArray()->all();
			foreach($productdata as $k)
			{
			$details[]=$k;
			}  
		    $list['status']=true;
			$list['message']= "success";  
			if(!empty($details))
		{
			$list['data']=$details;
		}
	    }
		
	  else  
	     {
            	$list['status']=false;
		        $list['message']= "Invalid Authkey";
		  }
	
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!='')
		{
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	return json_encode($response);	
  
  }
    
}

public function actionAddsales()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="add-sales";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','saleinfo','productlistdata');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		$val=$requestInput[$one_key];
		
			if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	
	$saledetailinfo=$requestInput['productlistdata'];
	
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	
	
	else{
		$authkey=$requestInput['authkey'];
		$saleinfo=$requestInput['saleinfo'];
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data){
			
				$mrnumber=$saleinfo["mrnumber"]; 
			if($mrnumber=="Empty")
			{
			    $patientmodel=new Patient();
				$patientmodel->patient_type=2;
				$patientmodel->firstname=$saleinfo['customername'];
			
				if($saleinfo['dob']=="")
				{
					$patientmodel->dob="";
					$patientmodel->age="";
					
				}
				else 
				{
					$current_time = time();
$age_years = date('Y',$current_time) - date('Y',strtotime($saleinfo['dob']));
$age_months = date('m',$current_time) - date('m',strtotime($saleinfo['dob']));
$age_days = date('d',$current_time) - date('d',strtotime($saleinfo['dob']));
if ($age_days<0) {
    $days_in_month = date('t',$current_time);
    $age_months--;
    $age_days= $days_in_month+$age_days;
}
if ($age_months<0) {
    $age_years--;
    $age_months = 12+$age_months;
}
$age="$age_years years - $age_months months - $age_days days"; 
$patientmodel->dob=date("Y-m-d",strtotime($saleinfo['dob']));
$patientmodel->age=$age;
				}
			    $patientmax = Patient::find()->max('patient_id');
				$patientmax+=1;
				$patientmodel->medicalrecord_number="MRN".$patientmax;
				$patientmodel->address=$saleinfo['address'];
				$patientmodel->emailid=$saleinfo['emailid'];
				$patientmodel->patient_type=$saleinfo['patienttype'];
				$patientmodel -> is_active = 1;
			    $session = Yii::$app -> session;
			    $patientmodel -> updated_by = $data->ba_branchid;
			    $patientmodel -> updated_on = date("Y-m-d H:i:s");
				$patientmodel->patient_mobilenumber=$saleinfo['phonenumber'];
				
			    if($patientmodel->save())
				{
						$model=new Sales();
			$saleinfo=$requestInput['saleinfo'];
			$branchid=$saleinfo["branchid"];
			$mrnumber=$patientmodel->medicalrecord_number;
			$total=number_format($saleinfo["total"],2);
			$totalgstvalue=number_format($saleinfo["totalgstvalue"],2);
			$totaldiscountvalue=number_format($saleinfo["totaldiscountvalue"],2);
			$overalldiscounttype=$saleinfo["overalldiscounttype"];
			if($overalldiscounttype=="Empty")
			{
				
				 $overalldiscountpercent=0;
			$overalldiscountamount=0;
			}
			else{
				 $overalldiscountpercent=$saleinfo["overalldiscountpercent"];
			$overalldiscountamount=number_format($saleinfo["overalldiscountamount"],2);
			}
			$overalltotal=number_format($saleinfo["overalltotal"],2);
			$totaltaxableamount=number_format($saleinfo["totaltaxableamount"],2);
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
			$saleincrement="";
			if($patientdata)
			{
				$model -> branch_id = $branchid;
				$model -> name = $patientdata->firstname;
				$model -> dob = $patientdata->dob;
				$model->mrnumber=$mrnumber;
				$model->emailid=$patientdata->emailid;
				$model->phonenumber=$patientdata->patient_mobilenumber;
				$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
				if($saledatainc)
				{
					$saleincrement=$saledatainc->saleincrement+1;
				}
				else
				{
					$saleincrement=1;
				}
			if($saleinfo['patienttype']==1)
			{
				$billformat = "P/INV/IP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
			else{
				$billformat = "P/INV/OP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
			$model -> billnumber = $billformat;
			$model -> invoicedate =date("Y-m-d");
			$model -> total = $total;
			$model->totalgstvalue=$totalgstvalue;
			$model->totalcgstvalue=$totalgstvalue/2;
			$model->totalsgstvalue=$totalgstvalue/2;
			$model->totaldiscountvalue=$totaldiscountvalue;
			$model->saleincrement=$saleincrement;
			$model->paid_status="UnPaid";
			$model->patienttype=$saleinfo['patienttype'];
			$model->overalldiscounttype=$overalldiscounttype;
			$model->overalldiscountpercent=$overalldiscountpercent;
			$model->overalldiscountamount=$overalldiscountamount;
			$model->overalltotal=$overalltotal;
			$model->totaltaxableamount=$totaltaxableamount;
		    $model -> updated_by = $data->ba_branchid;
			$model-> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model-> updated_on = date("Y-m-d H:i:s");
			if($model->save())
					{	
			            	foreach ($saledetailinfo as $key => $kdata)
					 {
					 		
							$discountpercentage=$kdata["productdetail"]["discountpercent"];
							$discounttype=$kdata["productdetail"]["discounttype"];
							$newsaledetailinfo=$kdata["saledetailinfo"];
							$count_saledetailinfo=count($kdata["saledetailinfo"]);
							$discountamount=$kdata["productdetail"]["discountamount"];
							foreach ($newsaledetailinfo as $key => $value)
					 {	
					 	
					$model1 = new Saledetail();
					$model1 -> opsaleid = $model->opsaleid;
					$stockresponseid=$value["stockresponseid"];
					$model1->stockresponseid=$stockresponseid;
					$stockresponsedata=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
					$model1->stockid=$stockresponsedata->stockid;
					$stockdata=Stockmaster::find()->where(['stockid'=>$stockresponsedata->stockid])->one();
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid = $stockdata->productid;
					$model1 -> brandcode =  $stockdata->brandcode;
					$model1 -> stock_code =  $stockdata->stockcode;
					$model1 -> compositionid = $stockdata->compositionid;
					$model1 ->unitid = $stockdata->unitid;
					$model1 -> batchnumber = $stockresponsedata->batchnumber;
					$qty=$value["quantity"];
					$model1->productqty=$qty;
					$unitprice=$value["unitprice"];
					$gstrate=$value["gstpercent"];
					$mrpperunit=$unitprice+($unitprice*0.01*$gstrate);
					$model1->priceperqty=number_format($mrpperunit,2);
					$model1->gstrate=$gstrate;
					$model1->discount_type=$discounttype;
					$model1 -> discountrate=$discountpercentage;
					$model1->gstvalueperquantity=$mrpperunit;
					$model1->discountvalueperquantity=$discountamount/$qty;
					$model1->gstvalue=$qty* $mrpperunit;
					$model1->cgstvalue=number_format((($qty* $mrpperunit)/2),2);
					$model1->sgstvalue=number_format((($qty* $mrpperunit)/2),2);
					$model1->discountvalue=$discountamount;
					$model1 -> price = $qty* $mrpperunit;
					$model1 -> taxableamount = $qty* $unitprice;
					$model1->mrpperunit=$mrpperunit;
					$model1 -> expiredate =  $stockresponsedata->expiredate;
					$session = Yii::$app->session;
					$model1 -> is_active = 1;
					$model1 -> updated_by =$data->ba_branchid;
					$model1 -> updated_ipaddress =$saleinfo["ipaddress"];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					$model1 -> save();	
					}
					
					}
					$list['status']=true;
		            $list['message']= "Success";
					}
					
					else {
						print_r($model->getErrors());die;
						
						$list['status']=false;
		                $list['message']= "Invoice Not Generated";
					}
			}
				}
				else{
					    $list['status']=false;
		                $list['message']= "Phone Number or Email Id already Exist";
				}
			
			   
			}



else {
	
$model=new Sales();
$saleinfo=$requestInput['saleinfo'];
$branchid=$saleinfo["branchid"];
$mrnumber=$mrnumber;
$total=number_format($saleinfo["total"],2);
$totalgstvalue=number_format($saleinfo["totalgstvalue"],2);
$totaldiscountvalue=number_format($saleinfo["totaldiscountvalue"],2);
$overalldiscounttype=$saleinfo["overalldiscounttype"];
if($overalldiscounttype=="Empty")
{

$overalldiscountpercent=0;
$overalldiscountamount=0;
}
else{
$overalldiscountpercent=$saleinfo["overalldiscountpercent"];
$overalldiscountamount=number_format($saleinfo["overalldiscountamount"],2);
}
$overalltotal=number_format($saleinfo["overalltotal"],2);
$totaltaxableamount=number_format($saleinfo["totaltaxableamount"],2);
$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
$saleincrement="";
			if($patientdata)
			{
				$model -> branch_id = $branchid;
				$model -> name = $patientdata->firstname." ".$patientdata->lastname;
				$model -> dob = $patientdata->dob;
				$model ->gender=$patientdata->gender;
				$model->physicianname=$patientdata->physicianname;
				$model->mrnumber=$mrnumber;
				$model->emailid=$patientdata->emailid;
				$model->phonenumber=$patientdata->patient_mobilenumber;
				$model->patienttype=$saleinfo['patienttype'];
				$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
				if($saledatainc)
				{
					$saleincrement=$saledatainc->saleincrement+1;
				}
				else{
					$saleincrement=1;
				}
				
			if($saleinfo['patienttype']==1)
			{
				$billformat = "P/INV/IP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
			else{
				$billformat = "P/INV/OP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
			$model -> billnumber = $billformat;
			$model -> invoicedate =date("Y-m-d");
			$model -> total = $total;
			$model->totalgstvalue=$totalgstvalue;
			$model->totalcgstvalue=$totalgstvalue/2;
			$model->totalsgstvalue=$totalgstvalue/2;
			$model->totaldiscountvalue=$totaldiscountvalue;
			$model->saleincrement=$saleincrement;
			$model->paid_status="UnPaid";
			$model->overalldiscounttype=$overalldiscounttype;
			$model->overalldiscountpercent=$overalldiscountpercent;
			$model->overalldiscountamount=$overalldiscountamount;
			$model->overalltotal=$overalltotal;
			$model->totaltaxableamount=$totaltaxableamount;
		    $model -> updated_by = $data->ba_branchid;
			$model-> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model-> updated_on = date("Y-m-d H:i:s");
			if($model->save())
					{	
					foreach ($saledetailinfo as $key => $kdata)
					 {
					 	$discountpercentage=$kdata["productdetail"]["discountpercent"];
							$discounttype=$kdata["productdetail"]["discounttype"];
							$discountamount=$kdata["productdetail"]["discountamount"];
							$newsaledetailinfo=$kdata["saledetailinfo"];
							$count_saledetailinfo=count($kdata["saledetailinfo"]);
							foreach ($newsaledetailinfo as $key => $value)
					 {	
					 	
					$model1 = new Saledetail();
					$model1 -> opsaleid = $model->opsaleid;
					$stockresponseid=$value["stockresponseid"];
					$model1->stockresponseid=$stockresponseid;
					$stockresponsedata=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
					$model1->stockid=$stockresponsedata->stockid;
					$stockdata=Stockmaster::find()->where(['stockid'=>$stockresponsedata->stockid])->one();
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid = $stockdata->productid;
					$model1 -> brandcode =  $stockdata->brandcode;
					$model1 -> stock_code =  $stockdata->stockcode;
					$model1 -> compositionid = $stockdata->compositionid;
					$model1 ->unitid = $stockdata->unitid;
					$model1 -> batchnumber = $stockresponsedata->batchnumber;
					$qty=$value["quantity"];
					$model1->productqty=$qty;
					$unitprice=$value["unitprice"];
					$gstrate=$value["gstpercent"];
					$mrpperunit=$unitprice+($unitprice*0.01*$gstrate);
					$model1->priceperqty=number_format($mrpperunit,2);
					$model1->gstrate=$gstrate;
					$model1->discount_type=$discounttype;
					$model1 -> discountrate=$discountpercentage;
					$model1->gstvalueperquantity=$mrpperunit;
					$discountvalueperqty=($mrpperunit * $discountpercentage)/100;
					$model1->discountvalueperquantity=$discountamount/$qty;
					$model1->gstvalue=$qty* $mrpperunit;
					$model1->cgstvalue=number_format((($qty* $mrpperunit)/2),2);
					$model1->sgstvalue=number_format((($qty* $mrpperunit)/2),2);
					$model1->discountvalue=$discountamount;
					$model1 -> price = $qty* $mrpperunit;
					$model1 -> taxableamount = $qty* $unitprice;
					$model1->mrpperunit=$mrpperunit;
					$model1 -> expiredate =  $stockresponsedata->expiredate;
					$session = Yii::$app->session;
					$model1 -> is_active = 1;
					$model1 -> updated_by =$data->ba_branchid;
					$model1 -> updated_ipaddress =$saleinfo["ipaddress"];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					$model1 -> save();	
					
					}
					
					}
					$list['status']=true;
		            $list['message']= "Success";	
					}
					
					else {
						$list['status']=false;
		                $list['message']= "Invoice Not Generated";
					    }
			}
}
	
		
		}
			else
			{
		            	$list['status']=false;
				        $list['message']= "Invalid Auth Key";
			}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
		
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }




public function actionUpdatesales()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="update-sales";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','saleinfo','productlistdata');
	$is_error='';
	foreach($field_check as $one_key)
	{
		$key_val=isset($requestInput[$one_key]);
		$val=$requestInput[$one_key];
			if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	$saledetailinfo=$requestInput['productlistdata'];
	

	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$saleinfo=$requestInput['saleinfo'];
		$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		
	if($data1)
		    {
		    	$saleid=$saleinfo['opsaleid'];
			   	$model = Sales::find()->where(['opsaleid' => $saleid])->one();
				
		if ($model) 
		{
		    $model -> total = $saleinfo['total'];
			$model -> totalgstvalue = $saleinfo['totalgstvalue'];
			$model->totalcgstvalue=$saleinfo['totalgstvalue']/2;
			$model->totalsgstvalue=$saleinfo['totalgstvalue']/2;
			$model->totaltaxableamount=$saleinfo['totaltaxableamount'];
			$model->totaldiscountvalue=$saleinfo['totaldiscountvalue'];
			$model->overalldiscounttype=$saleinfo['overalldiscounttype'];
			$model->overalldiscountpercent=$saleinfo['overalldiscountpercent'];
			$model->overalldiscountamount=$saleinfo['overalldiscountamount'];
			$model->overalltotal=$saleinfo['overalltotal'];
			$model -> updated_by = $data1->ba_branchid;
			$model -> updated_ipaddress = $saleinfo['ipaddress'];
			$model -> updated_on = date("Y-m-d H:i:s");
			if ($model -> save()) {
				
				$saleid = $model -> opsaleid;
				$i = 1;
				$saledetailmodel1 = Saledetail::find()->where(['opsaleid'=>$saleid])->all();
				foreach ($saledetailmodel1 as $key => $value) {
					
					                  $data=Saledetail::find()->where(['opsale_detailid'=>$value->opsale_detailid])->one();
					                    $data->delete();
				}
				
		     	foreach ($saledetailinfo as $key => $kdata)
					 {
					 		
							$discountpercentage=$kdata["productdetail"]["discountpercent"];
							$discounttype=$kdata["productdetail"]["discounttype"];
							$discountamount=$kdata["productdetail"]["discountamount"];
							$newsaledetailinfo=$kdata["saledetailinfo"];
							$count_saledetailinfo=count($kdata["saledetailinfo"]);
							foreach ($newsaledetailinfo as $key => $value)
					 {	
							$model1 = new Saledetail();
							$model1 -> opsaleid = $saleid;
							$stockresponseid=$value["stockresponseid"];
							$model1->stockresponseid=$stockresponseid;
							$stockresponsedata=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
							$model1->stockid=$stockresponsedata->stockid;
							$stockdata=Stockmaster::find()->where(['stockid'=>$stockresponsedata->stockid])->one();
							$model1 -> saledate = date('Y-m-d');
							$model1 -> productid = $stockdata->productid;
							$model1 -> brandcode =  $stockdata->brandcode;
							$model1 -> stock_code =  $stockdata->stockcode;
							$model1 -> compositionid = $stockdata->compositionid;
							$model1 ->unitid = $stockdata->unitid;
							$model1 -> batchnumber = $stockresponsedata->batchnumber;
							$qty=$value["quantity"];
							$model1->productqty=$qty;
							$unitprice=$value["unitprice"];
							$gstpercent=$value["gstpercent"];
							$mrpperunit=$unitprice+($unitprice*0.01*$gstpercent);
							$model1->priceperqty=number_format($mrpperunit,2);
							$model1->gstrate=$gstpercent;
							$model1->discount_type=$discounttype;
							$model1 -> discountrate=$discountpercentage;
							$model1->gstvalueperquantity=$mrpperunit;
							$discountvalueperqty=($mrpperunit * $discountpercentage)/100;
							$model1->discountvalueperquantity=$discountamount/$qty;
							$model1->gstvalue=$qty* $mrpperunit;
							$model1->cgstvalue=number_format((($qty* $mrpperunit)/2),2);
							$model1->sgstvalue=number_format((($qty* $mrpperunit)/2),2);
							$model1->discountvalue=$discountamount;
							$model1 -> price = $qty* $mrpperunit;
							$model1 -> taxableamount = $qty* $unitprice;
							$model1->mrpperunit=$mrpperunit;
							$model1 -> expiredate =  $stockresponsedata->expiredate;
							$session = Yii::$app->session;
							$model1 -> is_active = 1;
							$model1 -> updated_by =$data1->ba_branchid;
							$model1 -> updated_ipaddress =$saleinfo["ipaddress"];
							$model1 -> updated_on = date("Y-m-d H:i:s");
							$model1 -> save();	
					}
					
					}
					$list['status']=true;
		            $list['message']= "Success";	
			}


		} 


else{
	
	$list['status']=false;
				        $list['message']= "Invalid Saleid";
}
		    }
			else
			{
		            	$list['status']=false;
				        $list['message']= "Invalid Auth Key";
			}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
		
	/********* Log save end **********/	
	
	return json_encode($response);	
	
	
	
  
  }
 public function actionFetchinvoicehistory()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-invoicehistory";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/

    $list['status']=false;
	$list['message']="";
	$field_check=array('authkey','saleid');
	$is_error='';
	foreach($field_check as $one_key)
	{
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes')
	{
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else
	{
		$authkey=$requestInput['authkey'];
		
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
			$saleid=$requestInput['saleid'];
			
		  $saledata=Sales::find()->where(['opsaleid'=>$saleid])->one();
		  if($saledata)
		  {
		  
		  	$list['saleid']  =  $saledata->opsaleid;
		    $list['patientname']  =   $saledata->name;	
	    	$list['phonenumber']  =   $saledata->phonenumber;	
		    $list['invoicenumber'] = $saledata->billnumber;	
		    $list['overalltotal'] =  $saledata->overalltotal;	
			$list['mrnumber'] =  $saledata->mrnumber;	
			$list['invoicedate'] =  date("d/m/Y",strtotime($saledata->invoicedate));
			$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saledata->opsaleid])->all();
			
			if($saledetaildata)
			{
				
				$kk=0;
			foreach($saledetaildata as $l)
			{
				
			$det=array();
			$det['sno']  = ++$kk;
			$det['saledetailid']  = $l->opsale_detailid;
			$det['stockresponseid']  = $l->stockresponseid;
			$productid=$l->productid;
			$productdata=Product::find()->where(['productid'=>$productid])->one();
			$returndata=Salesreturn::find()->where(['saleid'=>$l->opsaleid])->one();
			$items=0;
			if($returndata)
			{
				$returnid=$returndata->return_id;
			$returndetaildata=Returndetail::find()->where(['return_id'=>$returnid])->andwhere(['stockresponseid'=>$l->stockresponseid])->one();
			
			if($returndetaildata)
			{
				$items=$returndetaildata->productqty;
			}
			}
			if($productdata)
			{
			    $det['stockname'] = $productdata->productname;
				$det['hsncode'] = $productdata->hsn_code;
			}
			$det['items']  = $l->productqty-$items;
			$detail[]=$det;
			}	
			
			$list['data']=$detail;
			$list['status']=true;
	        $list['message']= "success";  
			}
			else 
			{
				$list['data']=$detail;
			$list['status']=false;
	        $list['message']= "Invalid Sale Id"; 
				
			}
		  }
		    
		 
		}
		else{
			$list['message']="Invalid Authkey";
		}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!='')
		{
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }






  public function actionFetchpaymentmethod()
  {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	/********* Log save start **********/	
		$log_model=new ApiLog();
		$log_model->event_key="fetch-paymentmethod";
		$log_model->request_data=$postd;
		$log_model->created_at=date("Y-m-d H:i:s");
		$log_model->save();
		$logid=$log_model->autoid;
	/********* Log save end **********/

	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
	
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data){
			$paymentdata=PaymentMethod::find()->select('pm_autoid, methodname')->asArray()->all();
			if($paymentdata)
			{
				foreach($paymentdata as $k)	
				{
				$det=array();
				$det['paymentmethodid']=$k['pm_autoid'];
				$det['paymentmethodkey']=ucwords($k['methodname']);
				$details[]=$det;
				}
				$list['status']=true;
	            $list['message']="success";
	            $list['data']=$details;
			}
			
			else{
				$list['message']="Records Not Found";
			}
		}
		else{
			$list['message']="Invalid Authkey";
		}
		
	}
	$response['Output'][]=$list;
/********* Log save start **********/		
	if($logid!=''){
		$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
		$log_model->response_data=json_encode($list);
		$log_model->save();
	}
/********* Log save end **********/	
	return json_encode($response);	
  
  }

 public function actionFetchcardtype()
 {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	/********* Log save start **********/	
		$log_model=new ApiLog();
		$log_model->event_key="fetch-cardtype";
		$log_model->request_data=$postd;
		$log_model->created_at=date("Y-m-d H:i:s");
		$log_model->save();
		$logid=$log_model->autoid;
	/********* Log save end **********/
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey');
	$is_error='';
	foreach($field_check as $one_key)
	{
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	if($is_error=='yes')
	{
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else
	{
		$authkey=$requestInput['authkey'];
		$data=BranchAdmin::find()->where(['auth_key'=>$requestInput['authkey']])->one();
		if($data){
			$carddata=PaymentType::find()->select('payment_type_id, paymenttype')->asArray()->all();
			if($carddata)
			{
				foreach($carddata as $k)	
				{
				$det=array();
				$det['cardid']=$k['payment_type_id'];
				$det['cardtype']=ucwords($k['paymenttype']);
				$details[]=$det;
				}
				$list['status']=true;
	            $list['message']="success";
	            $list['data']=$details;
			}
			else{$list['message']="Records Not Found";}
		}
		else{$list['message']="Invalid Authkey";}
	}
	$response['Output'][]=$list;
/********* Log save start **********/		
	if($logid!=''){
		$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
		$log_model->response_data=json_encode($list);
		$log_model->save();
	}
/********* Log save end **********/	
	return json_encode($response);	
  }


     public function actionPayment() 
    
    {
    		
    	
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="add-payment";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','saleid','ipaddress','paymentinfo');
	$is_error='';
	foreach($field_check as $one_key)
	{
		$key_val=isset($requestInput[$one_key]);
		if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	$paymentinfo=$requestInput['paymentinfo'];
	

	
	
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	if($data1)
		    {
		    	$saleid=   $requestInput['saleid'];
		        $model = Sales::findOne($saleid);
		if ($model) 
		{
			foreach ($paymentinfo as $key => $paymentdata) {
						$invoicepayment = new InvoicePayment();
						$invoicepayment -> branchid = $data1->ba_branchid;
						$invoicepayment->saleid=$saleid;
						$saledata=Sales::find()->where(['opsaleid'=>$saleid])->one();
					    $invoicepayment->invoicenumber=$saledata->billnumber;
						$invoicepayment -> paymentmethod = $paymentdata['paymentmethod'];
						$invoicepayment -> paymentamount = $paymentdata['paymentamount'];
						$invoicepayment -> timestamp = date("Y-m-d h:i:s");
						$invoicepayment -> cardtype = $paymentdata['cardtype'];
						$invoicepayment -> cardholdername = $paymentdata['cardholdername'];
						$invoicepayment -> referencenumber = $paymentdata['referencenumber'];
						if($invoicepayment -> save())
						{
							$saledata=Sales::find()->where(['opsaleid'=>$saleid])->one();
							$saledata->paid_status="Paid";
			                $saledata->updated_by=$data1->ba_branchid;
		        	        $saledata->updated_ipaddress=$requestInput['ipaddress'];
			                $saledata->updated_on=date("Y-m-d H:i:s");
							if($saledata->save())
							{
								$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saledata->opsaleid])->all();
								if($saledetaildata)
								{
									foreach($saledetaildata as $sddata)
								{
									$stockid=$sddata->stockid;
									$stockresponseid=$sddata->stockresponseid;
								    $stockmaster = Stockmaster::find() -> where(['stockid' => $stockid]) -> one();
									$unitid=$sddata->unitid;
							        $unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
							        $noofunit=$unitdata->no_of_unit;
						 if ($stockmaster)
						  {
						 	
					        
							// $qty=($sddata->productqty)/$noofunit;
							// $stockmaster -> quantity = $stockmaster->quantity -$qty;
							 $stockmaster->total_no_of_quantity= $stockmaster -> total_no_of_quantity-$sddata->productqty;
							 $stockmaster->price= $stockmaster->price-$sddata -> price;
							 $stockmaster -> updated_on = date("Y-m-d H:i:s");
							 $stockmaster -> save();
						 }
						  
						  $stockmasterfrombatch = Stockresponse::find() -> where(['stockresponseid' => $stockresponseid]) -> one();
						 if ($stockmasterfrombatch)
						  {
						// $qty=($sddata->productqty)/$noofunit;
							// $stockmasterfrombatch->receivedquantity= $stockmasterfrombatch->receivedquantity-$qty;
						     $stockmasterfrombatch->total_no_of_quantity= $stockmasterfrombatch->total_no_of_quantity-$sddata->productqty;
							 $stockmasterfrombatch->purchaseprice= $stockmasterfrombatch->purchaseprice-$sddata -> price;
							 $stockmasterfrombatch -> updated_on = date("Y-m-d H:i:s");
							 $stockmasterfrombatch->save();
						 }
						}
								}
								
							}
							
						}
				      }
				
			            $list['status']=true;
				        $list['message']= "success";

		} 
                    else{
	                    $list['status']=false;
				        $list['message']= "Invalid Invoice Number";
                        }
		    }
			else
			{
		            	$list['status']=false;
				        $list['message']= "Invalid Auth Key";
			}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
	/********* Log save end **********/	
	return json_encode($response);	
    	
		/********************/
	
		
	}


 public function actionCancelpayment() 
    
    {
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="cancel-payment";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','saleid','ipaddress');
	$is_error='';
	
	
	foreach($field_check as $one_key)
	{
		$key_val=isset($requestInput[$one_key]);
		$val=$requestInput[$one_key];
			if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	$authkey=$requestInput['authkey'];
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	if($data1)
		    {
		    	$saleid=   $requestInput['saleid'];
		        $model = Sales::findOne($saleid);
		if ($model) 
		       {
			     $saledata=Sales::find()->where(['opsaleid'=>$saleid])->one();
							$saledata->paid_status="Cancelled";
			                $saledata->updated_by=$data1->ba_branchid;
		        	        $saledata->updated_ipaddress=$requestInput['ipaddress'];
			                $saledata->updated_on=date("Y-m-d H:i:s");
							$saledata->save();
                        $list['status']=true;
				        $list['message']= "success";
				      }
		          else{
			            $list['status']=false;
				        $list['message']= "Invalid Auth Key";
		              }
		} 
           else
			{
		            	$list['status']=false;
				        $list['message']= "Invalid Auth Key";
			}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
		
	/********* Log save end **********/	
	
	return json_encode($response);	
    	
		/********************/
	}

public function actionAddreturn()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="add-return";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','ipaddress','returninfo','returndetailinfo');
	$is_error='';
	foreach($field_check as $one_key){
		$key_val=isset($requestInput[$one_key]);
		$val=$requestInput[$one_key];
		
			if($key_val==''){
			$is_error='yes';
			$is_error_note=$one_key;
			break;
		}
	}
	
	$returninfo=$requestInput['returninfo'];
	
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
  else
	{
		$authkey=$requestInput['authkey'];
		$returninfo=$requestInput['returninfo'];
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data){
			
			$returndetailinfo=$requestInput['returndetailinfo'];
			 $saleid=$returninfo["saleid"];
             $model=new Salesreturn();
			foreach($returndetailinfo as $info)
			{
				$stockresponseid=$info['stockresponseid'];
				$quantity=$info['quantity'];
				$saledetaildata1=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$stockresponseid])->one();
				$total=0;$gstvalue=0;$discountvalue=0;
				$discountvalue=0;
				if($saledetaildata1)
				{
				$mrpperunit=$saledetaildata1->mrpperunit;
				$total+=($mrpperunit*$quantity);
				$gstvalue+=$quantity*($saledetaildata1->gstvalueperquantity);
				$discountvalue+=$quantity*($saledetaildata1->discountvalueperquantity);
				}
			}
		    $salesdata=Sales::find()->where(['opsaleid'=>$saleid])->one();
			$model->saleid=$saleid;
		    $returndatainc=	Salesreturn::find()->orderBy(['return_id' => SORT_DESC])->one();
			if($returndatainc)
			{
				$returnincrement=$returndatainc->returnincrement+1;
			}
			else {
				$returnincrement=1;
			}
           $type=$salesdata->billnumber;
		   if (preg_match("/\bIP\b/i", $type, $match)) {
		   	$returninv='P/RETURN/IP/'.date("Y").'/'.date("m").'/'.($returnincrement);
			   $pt=1;
		   }
		   else{
		   $returninv='P/RETURN/OP/'.date("Y").'/'.date("m").'/'.($returnincrement);
			   $pt=2;
		   }
			$model->return_invoicenumber=$returninv;
			$model->patient_type=$pt;
			$model->name=$salesdata->name;
			$model->returndate=date('Y-m-d');
			$model->mrnumber=$salesdata->mrnumber;
			$model->branch_id=$salesdata->branch_id;
			$model->returnincrement=$returnincrement;
			$model->total=number_format($total,2);
			$model->totalgstvalue=number_format($gstvalue,2);
			$model->totalcgstvalue=number_format(($gstvalue/2),2);
			$model->totalsgstvalue=number_format(($gstvalue/2),2);
			$model->totaldiscountvalue=number_format(($discountvalue/2),2);
			$model->paid_status="UnPaid";
			$model->is_active=1;
	        $model->updated_by=$salesdata->branch_id;
			$model->updated_ipaddress=$requestInput['ipaddress'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($model->save())
					{	
				foreach($returndetailinfo as $singleinfo)
			{
			    $model1 = new Returndetail();
				$model1->return_id=$model->return_id;
				$stockresponseid=$singleinfo['stockresponseid'];
				
				$stockresponsedata1=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
				
				$model1->stockresponseid=$stockresponseid;
				$model1->stockid=$stockresponsedata1->stockid;
				$model1->returndate=date('Y-m-d');
				$model1->productid=$stockresponsedata1->stockbrandcode->productid;
				$model1->brandcode=$stockresponsedata1->stockbrandcode->brandcode;
				$model1->stock_code=$stockresponsedata1->stockbrandcode->stockcode;
				$model1->compositionid=$stockresponsedata1->stockbrandcode->compositionid;
				$model1->unitid=$stockresponsedata1->stockbrandcode->unitid;
				$model1->batchnumber=$stockresponsedata1->batchnumber;
				$model1->expiredate=$stockresponsedata1->expiredate;
				$quantity=$singleinfo['quantity'];
				$model1->productqty=$singleinfo['quantity'];
				$saledetaildata2=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$stockresponseid])->one();
				$model1->priceperqty=$saledetaildata2->priceperqty;
				$model1->gstrate=$saledetaildata2->gstrate;
				$model1->discountrate=$saledetaildata2->discountrate;
				$model1->gstvalueperquantity=$saledetaildata2->gstvalueperquantity;
				$model1->discountvalueperquantity=$saledetaildata2->discountvalueperquantity;
				$model1->gstvalue=number_format($quantity*($model1->gstvalueperquantity),2);
				$model1->cgstvalue=number_format(($model1->gstvalue/2),2);
			    $model1->sgstvalue=number_format(($model1->gstvalue/2),2);
				$model1->discountvalue=number_format($quantity*($model1->discountvalueperquantity),2);
				$model1->price=number_format($quantity*($saledetaildata2->mrpperunit));
				$model1->discount_type=$saledetaildata2->discount_type;
				$model1->is_active=1;
			    $model1->updated_by=$salesdata->branch_id;
			    $model1->updated_ipaddress=$requestInput['ipaddress'];
			    $model1->updated_on=date("Y-m-d H:i:s");
					$model1 -> save();	
					}
				    $list['status']=true;
		            $list['message']= "Success";	
					}
					
					else 
					    {
						$list['status']=false;
		                $list['message']= "Invoice Not Generated";
					    }
		}
			else
			{
		            	$list['status']=false;
				        $list['message']= "Invalid Auth Key";
			}
	}
	
	$response['Output'][]=$list;
	/********* Log save start **********/		
		if($logid!=''){
			$log_model=ApiLog::find()->where(['autoid'=>$logid])->one();
			$log_model->response_data=json_encode($list);
			$log_model->save();
		}
		
	/********* Log save end **********/	
	
	return json_encode($response);	
  
  }
}
