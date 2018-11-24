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
use backend\models\Vendor;
use backend\models\Productgrouping;
use yii\helpers\ArrayHelper;
use yii\db\Query; 
use backend\models\Composition;
use backend\models\Stockrequest;
use backend\models\Producttype;
use yii\data\ActiveDataProvider;
use backend\models\StockrequestSearch;
use backend\models\Taxgrouping;
use backend\models\VendorBranch;


class DmcApipart2Controller extends Controller
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



  public function actionFetchproductautocomplete()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-productautocomplete";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
	
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','vendorid');
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
		$vendorid=$requestInput['vendorid'];
		$stockname=$requestInput['stockname'];
		
	   $data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
			
			if(empty($stockname))
			{
				
			 $query = new Query;
        $query->select(['productgrouping.*', 'product.*'])  
		->from('productgrouping')
		
		->where(['productgrouping.vendorid'=>$vendorid])
		->andwhere(['productgrouping.is_active'=>1])
		->innerJoin('product', 'product.productid = productgrouping.productid');
			 
			 $command = $query->createCommand();
             $productdata = $command->queryAll();	
			 foreach($productdata as $k)
			{
			if($k['productname']!="" )
				{
					
			$details=array();
			$details['productid']=$k['productid'];
			$details['productname']=$k['productname'];
			$det[]=$details;
			
				}
			
			}  
		    $list['status']=true;
			$list['message']= "success";  
			
			if(!empty($det))
		{
			$list['data']=$det;
		}
			
			 
			}
			
			else
			{
				
			 $query = new Query;
        $query->select(['productgrouping.*', 'product.*'])  
		->from('productgrouping')
		
		->where(['productgrouping.vendorid'=>$vendorid])
		->andwhere(['productgrouping.is_active'=>1])
		->andwhere(['LIKE','product.productname',$stockname.'%',false])
		->innerJoin('product', 'product.productid = productgrouping.productid');
			 
			 $command = $query->createCommand();
             $productdata = $command->queryAll();	
			 if($productdata)
			 {
			 			 	 		foreach($productdata as $k)
			{
			if($k['productname']!="")
				{
					
			$details=array();
			$details['productid']=$k['productid'];
			$details['productname']=$k['productname'];
			$det[]=$details;
			
				}
			
			}  
			
			    $list['status']=true;
			    $list['message']= "Success";  
					if(!empty($det))
					{
					 	$list['data']=$det;
					 }
			 }
			 
           else
		   	{
		   		$list['status']=true;
			    $list['message']= "No records found";  
				$list['data']=array();
		   	}
	
		    
			
		
			 
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




  public function actionFetchvendorautocomplete()
   {
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-vendorautocomplete";
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
		$vendorname=$requestInput['vendorname'];
		
	   $data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
			if(!empty($vendorname))
			{
				$productdata=Vendor::find()->
			where(['LIKE', 'vendorname', $vendorname.'%',false])->all();
			}
			else {
				$productdata=Vendor::find()->all();
			}
			
			
			if($productdata)
			{
							foreach($productdata as $k)
			{
			$details=array();
			$details['vendorname']=$k->vendorname;
			$details['vendorid']=$k->vendorid;
			$details['vendorcode']=$k->vendorcode;
			$det[]=$details;
			}  
		    $list['status']=true;
			$list['message']= "success";  
			
			if(!empty($det))
		{
			$list['data']=$det;
		}
			
			
			}

			 else  
	     {
            	$list['status']=true;
		        $list['message']= "No matching Records";
				$list['data']=array();
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

 public function actionFetchinvoiceautocomplete()
   {
   	
  	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-invoiceautocomplete";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
$field_check=array('authkey','invoicenumber','paid_status');

/******** pagination start *********/ 
 
	$list['status']=false;
	$list['message']="";
	
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
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}else{
		$authkey=$requestInput['authkey'];
		$invnum=$requestInput['invoicenumber'];
		$paidstatus=$requestInput['paid_status'];
		
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
		 $branchid=$data->ba_branchid;
        $invoice = Sales::find()->Where(['branch_id'=>$branchid])->andwhere(['paid_status'=>$paidstatus])->andwhere(["LIKE",'billnumber',$invnum])->all();
 
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
		 
		  
		}
		
		else{
			$list['message']="Invoice Not Found";
		}
		
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



    public function actionStockrequestinfo() 
    
    {
    	
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="add-stockrequestinfo";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','vendorid','productinfo');
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
	$productinfo=$requestInput['productinfo'];
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
		    	$vendor=$requestInput['vendorid'];
				$branch=$data1->ba_branchid;
		    	foreach ($productinfo as $key => $value) {
		    		$productid=$value['productid'];
				    $productdata=Product::find()->where(['productid'=>$productid])->one();
			 $type=$productdata->product_typeid;
			 $rows = Stockmaster::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$productid])->andwhere(['branch_id'=>$branch])->
			 andwhere(['is_active'=>1])->one();
			 if($rows)
			 {
			 	$qty=$rows->total_no_of_quantity;
			 }
           else
           {
           	$qty=0;
           }
			  $data = Productgrouping::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$productid])->andwhere(['is_active'=>1])->one();
			 
			 $brandcode=$data->brandcode;
			 $compositionid=$productdata->composition_id;
			 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
			 $compositionname=$compositiondata->composition_name;
			 $unit=$productdata->unit;
			 $productgroupdata=Product::find()->where(['productid'=>$productid])->one();
			 $unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			 $stockcode=$data->stock_code;
			 $hsncode=$productgroupdata->hsn_code;
			 $producttypedata=Producttype::find()->where(['product_typeid'=>$type])->one();
			 $producttype=$producttypedata->product_type;
			 
			    $det=array();
				$det['productgroupid']=$data->productgroupid;
				$det['productid']=$productid;
				$det['hsncode']=$hsncode;
				$det['stockcode']=$stockcode;
				$det['brandcode']=$brandcode;
				$det['productname']=$productdata->productname;
				$det['compositionname']=$compositionname;
				$det['producttype']=$producttype;
				$det['availablestock']=$qty;
				
				$unitinfo=Unit::find()->where(['unitname'=>$type])->all();
				
				foreach($unitinfo as $ll)
				{
					$det1=array();
				$det1['unitid']=$ll->unitid;
				$det1['unitname']=$ll->unitvalue;
				$det2[]=$det1;
				}
			   $det['unitinfo']=$det2;
			   $details[]=$det;
			   $det2=array();
				}
                        $list['status']=true;
				        $list['message']= "Success";
						$list['vendorid']= $vendor;
						$list['requesttype']= 'vendorstock';
                        $list['data']=$details;
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


 public function actionEditstockrequestinfo() 
    
    {
    	
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="edit-stockrequestinfo";
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
		    	$requestcode=$requestInput['requestcode'];
				$branch=$data1->ba_branchid;
				$productinfo=Stockrequest::find()->where(['requestcode'=>$requestcode])->andwhere(['requesttype'=>"vendorstock"])
				->andwhere(['branch_id'=>$branch])->all();
				foreach ($productinfo as $key => $value)
		    	 {
		    	  $productid=$value->productid;
					$vendor=$value->vendorid;
				    $productdata=Product::find()->where(['productid'=>$productid])->one();
			 $type=$productdata->product_typeid;
			 $rows = Stockmaster::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$productid])
			 ->andwhere(['branch_id'=>$branch])->andwhere(['is_active'=>1])->one();
			 if($rows)
			 {
			 	$qty=$rows->total_no_of_quantity;
			 }
           else
           {
           	$qty=0;
           }
			 $data = Productgrouping::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$productid])->andwhere(['is_active'=>1])->one();
			 $brandcode=$value->brandcode;
			 $compositionid=$productdata->composition_id;
			 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
			 $compositionname=$compositiondata->composition_name;
			 $unit=$value->unit;
			 $productgroupdata=Product::find()->where(['productid'=>$productid])->one();
			 $unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			 $stockcode=$data->stock_code;
			 $hsncode=$productgroupdata->hsn_code;
			 $producttypedata=Producttype::find()->where(['product_typeid'=>$type])->one();
			 $producttype=$producttypedata->product_type;
			    $det=array();
				$det['productgroupid']=$data->productgroupid;
				$det['productid']=$productid;
				$det['hsncode']=$hsncode;
				$det['stockcode']=$stockcode;
				$det['brandcode']=$brandcode;
				$det['productname']=$productdata->productname;
				$det['compositionname']=$compositionname;
				$det['producttype']=$producttype;
				$det['availablestock']=$qty;
				$det['quantity']=$value->quantity;
				$det['requestid']=$value->requestid;
				$stockresponsedata=Stockresponse::find()->where(['stockrequestid'=>$value->requestid])->all();
				$det['noofbatches']=count($stockresponsedata);
				
				
				if(count($stockresponsedata)>0)
				{
                      $status=0;						
					foreach($stockresponsedata as $srdata)
					{
						if($srdata->sales_status==1)
						{
							$status=1;
						}
					}
						
					if($status==1)
					{
						$det['receivedstatus']=1;
						$det['receiveddate']=date("d/m/Y",strtotime($srdata->receiveddate));
						
					}	
					else{
						
						$det['receivedstatus']=0;
						$det['receiveddate']="";
					}
					
					
					
					
				}
				else{
					$det['receivedstatus']="ncp";
					$det['receiveddate']="";
					
				}
				
				$unitinfo=Unit::find()->where(['unitname'=>$type])->all();
				foreach($unitinfo as $ll)
				{
				$det1=array();
				$det1['unitid']=$ll->unitid;
				$det1['unitname']=$ll->unitvalue;
				if($value->unitid==$ll->unitid)
				{
					$det1['selected_unitid']=true;
				}
                else
				{$det1['selected_unitid']=false;}
				 $det2[]=$det1;
				}
			   $det['unitinfo']=$det2;
			   $details[]=$det;
			   $det2=array();
			   $det1=array();
			   $det=array();
				}



$productinfo1=Stockrequest::find()->where(['requestcode'=>$requestcode])->andwhere(['requesttype'=>"vendorstock"])
				->andwhere(['branch_id'=>$branch])->one();
if(count($productinfo1)>0)
{
	                    $list['status']=true;
					    $list['message']= "Success";
						$list['vendorid']= $productinfo1->vendorid;
						$vendordata=Vendor::find()->where(['vendorid'=>$productinfo1->vendorid])->one();
						$list['requesttype']= 'vendorstock';
						$list['requestcode']= $productinfo1->requestcode;
						$list['requestdate']= date("d/m/Y",strtotime($productinfo1->requestdate));
						$list['vendorname']= $vendordata->vendorname;
					    $list['data']=$details;
}
						else{ 
	                    $list['status']=true;
					    $list['message']= "Request Is Invalid";
						$list['data']=array();
						
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





 public function actionStockrequestsave() 
    {
    	//error_reporting(0);
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockrequest-save";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','vendorid','productinfo','ipaddress','requesttype');
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
	
	
	$productinfo=$requestInput['productinfo'];
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
		    	
		   
			 $stockrequestdata = Stockrequest::find()->orderBy('requestid DESC') ->limit(1) ->offset(1) ->one();
			if($stockrequestdata)
			{
				$stockincrement=$stockrequestdata->requestincrement+1;
			}
			else{$stockincrement=1;}
		$vendorid=$requestInput['vendorid'];
			$vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
			$vendorcode=$vendordata->vendorcode;
		   foreach($productinfo as $k)
		   {
		     $model = new Stockrequest();
			 $model->requestincrement=$stockincrement;
			 $model->requestcode="PO/".$vendorcode."/".date("Y")."/".date('m')."/".($stockincrement);
			 $model->backorder_requestcode="";
			 $model->requesttype=$requestInput['requesttype'];
			 $model->productgroupid=$k['productgroupid'];
			 $model->branch_id=$data1->ba_branchid;
			 $model->vendorid=$vendorid;
			 $model->productid=$k['productid'];
			 $model->quantity=$k['quantity'];
			 $model->brandcode=$k['brandcode'];
			 $model->unitid=$k['unitid'];
			 $unitdata=Unit::find()->where(['unitid' =>$k['unitid']])->one();
			 $unitqty=$unitdata->no_of_unit;
			 $totalquantity=$k['quantity']*$unitqty;
			 $model->total_no_of_quantity=$totalquantity;
			 $model->requestdate=date("Y-m-d");
			 $model->updated_by=$data1->ba_branchid;
			 $model->updated_on=date("Y-m-d H:i:s");	
			 $model->updated_ipaddress=$requestInput['ipaddress'];
			 $model->is_active=1;
			 $model->save();
		   }
              $list['status']=true;
			 $list['message']= "success";
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


 public function actionUpdatestockrequestsave() 
    {
    	//error_reporting(0);
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="updatestockrequest-save";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','vendorid','productinfo','ipaddress','requesttype');
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
	$productinfo=$requestInput['productinfo'];
	
	
	
	if($is_error=='yes')
	{
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	if($data1)
		    {
			 $stockrequestdata = Stockrequest::find()->orderBy('requestid DESC') ->limit(1) ->offset(1) ->one();
			if($stockrequestdata)
			{
				$stockincrement=$stockrequestdata->requestincrement+1;
			}
			else{$stockincrement=1;}
		    $vendorid=$requestInput['vendorid'];
			$vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
			$vendorcode=$vendordata->vendorcode;
			
		   foreach($productinfo as $k)
		   {
		     $model=Stockrequest::find()->where(['requestid'=>$k['requestid']])->one();
			 $model->quantity=$k['quantity'];
			 $model->unitid=$k['unitid'];
			 $unitdata=Unit::find()->where(['unitid' =>$k['unitid']])->one();
			 $unitqty=$unitdata->no_of_unit;
			 $totalquantity=$k['quantity']*$unitqty;
			 $model->total_no_of_quantity=$totalquantity;
			 $model->requestdate=date("Y-m-d");
			 $model->updated_by=$data1->ba_branchid;
			 $model->updated_on=date("Y-m-d H:i:s");	
			 $model->updated_ipaddress=$requestInput['ipaddress'];
			 $model->is_active=1;
			 $model->save();
		   }
		   
              $list['status']=true;
			 $list['message']= "success";
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




 public function actionFetchpurchaseorderlist()
   {
    $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-purchaseorderlist";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
   $field_check=array('authkey');
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
		$data=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
		if($data)
		{
		 $branchid=$data->ba_branchid;
		 $requestcode=$requestInput['requestcode'];
		 
			if(!empty($requestInput['vendorinfo']))
		{
			$vendordata=$requestInput['vendorinfo'];
			
		    foreach ($vendordata as  $value) 
		    {
				$vendorid[]=$value['vendorid'];
			}
		    $count=count($vendorid);
		}
		else{$count=0;}
	
		if(!empty($requestInput['fromdate']))
		{
			$fromdate=date('Y-m-d', strtotime(strtr($requestInput['fromdate'], '/', '-')));
		}
	   else{
	   	$fromdate="";
	   }
	   
	   
	   if(!empty($requestInput['todate']))
		{$todate=date('Y-m-d', strtotime(strtr($requestInput['todate'], '/', '-')));}
		else{$todate="";}
         
		   if(($count>0) && ($requestcode!="") && ($fromdate!="") && ($todate!="") )
		   {
		     	
		     $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				    ->andWhere(['requestcode'=>$requestcode]) 
				    ->andWhere(["IN",'vendorid',$vendorid])
				    ->andWhere(['between','requestdate',$fromdate,$todate])
					->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
		   
		   else if($count>0 && $requestcode!="" )
		   {
		  
		 	   $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				    ->andWhere(['requestcode'=>$requestcode]) 
				    ->andWhere(["IN",'vendorid',$vendorid])->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
		   
		    else if($count>0  && $fromdate!="" && $todate!="" )
		   {
		      
		         $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				 ->andWhere(['between','requestdate',$fromdate,$todate])
				    ->andWhere(["IN",'vendorid',$vendorid])->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
		    else if($requestcode!=""  && $fromdate!="" && $todate!="" )
		   {
		 	 	
		 	 $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				 ->andWhere(['between','requestdate',$fromdate,$todate])
				   ->andWhere(['requestcode'=>$requestcode]) ->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
		   
		    else if($requestcode!=""   )
		   {
		     	
		   	   $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				  ->andWhere(['requestcode'=>$requestcode]) ->andWhere(['is_active'=>1])
				  
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }

         else if($fromdate!="" && $todate!="" )
		   {
		     
		  	 $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				 ->andWhere(['between','requestdate',$fromdate,$todate])->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }

             else if($count>0)
		   {
		
		      $invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])
				      ->andWhere(["IN",'vendorid',$vendorid])->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
		   
		    else
		   {
		     	$invoice = Stockrequest::find()->where(['branch_id'=>$branchid])->andwhere(['requesttype'=>"vendorstock"])->andWhere(['is_active'=>1])
				    ->groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start)->all();
		   }
	
	 if(count($invoice)>0)
		{
			$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
			foreach($invoice as $data1)
			{
				
		    $det1=array();
			$det1['requestcode']=$data1->requestcode;
			$det1['totalitems']=$data1->Stockrequestcount;
			$vendordata=Vendor::find()->where(['vendorid'=>$data1->vendorid])->one();
		    $vendorname=$vendordata->vendorname;
			$det1['vendorname']=$vendorname;
			$det1['requestdate']=date("d/m/Y",strtotime($data1->requestdate));
			$det1['brandcode']=$data1->brandcode;
			$details1[]=$det1;
		  }
			if(!empty($details1))
		  {
		  	
		     $list['status']=true;
			 $list['message']="success";
			 $list['data']=$details1;
		  }
		}
		
		else
		{
			 $list['status']=true;
			 $list['message']="PO Request Order Not Found";
			 $list['data']=array();
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




 public function actionDeletestockrequestorder() 
    
    {
			    $list=array();
				$postd=(Yii::$app->request->rawBody);
				$requestInput=json_decode($postd,true);
				
				
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="delete-stockrequestinfo";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/




	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','requestcode');
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
		    	$requestcode=$requestInput['requestcode'];
				$branch=$data1->ba_branchid;
				$productinfo=Stockrequest::find()->where(['requestcode'=>$requestcode])->andwhere(['requesttype'=>"vendorstock"])
				->andwhere(['branch_id'=>$branch])->all();
			   
		    	foreach ($productinfo as $key => $value)
		    	 {
		    	  
			       $id=$value->requestid;
				   Stockrequest::findOne($id)->delete();
				}
				        $list['status']=true;
				        $list['message']= "Success";
                       
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




 public function actionDeletestockrequestid() 
    
    {
			    $list=array();
				$postd=(Yii::$app->request->rawBody);
				$requestInput=json_decode($postd,true);
				
				
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="delete-stockrequestid";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/




	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','vendorid','deleteid');
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
		    	$requestid=$requestInput['deleteid'];
				$vendorid=$requestInput['vendorid'];
				$branch=$data1->ba_branchid;
				$productinfo=Stockrequest::find()->where(['requestid'=>$requestid])->andwhere(['vendorid'=>$vendorid])
				->andwhere(['branch_id'=>$branch])->one();
			    $productinfo->delete();
				$list['status']=true;
				$list['message']= "Success";
                       
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







  public function actionStockreceiveinfo() 
    
    {
    	
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-stockreceiveinfo";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','requestid');
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
		    	$requestid=$requestInput['requestid'];
				$branch=$data1->ba_branchid;
			 
			  
			  $stockrequestdata1=Stockrequest::find()->where(['requestid'=>$requestid])->one();
			  $stockresponsedata=Stockresponse::find()->where(['stockrequestid'=>$requestid])->all();
			    $stockrequestdata=Stockrequest::find()->where(['requestid'=>$requestid])->all();
			  if($stockrequestdata)
			  {
			  	 foreach($stockrequestdata as $kk)
			  {
			  	$list["requestquantity"]=$kk->total_no_of_quantity;
			  }
			  }
			  if($stockresponsedata)
			  {
			  	
					  	 foreach($stockresponsedata as $k)
			  {
			  
				$list["stockname"]=$k->stockmaster->product->productname;
				$list["producttype"]=$k->stockmaster->product->producttype->product_type;
				$list["composition"]=$k->stockmaster->composition->composition_name;
				$list["stockcode"]=$k->stockmaster->stockcode;
				$list["brandcode"]=$k->stockmaster->brandcode;
				
			  }
			  	 foreach($stockresponsedata as $k)
			  {
			  	
			  	$det=array();	
			  	$det["stockresponseid"]=$k->stockresponseid;
				$det["stockid"]=$k->stockid;
				$det["stockrequestid"]=$k->stockrequestid;
				$det["batchnumber"]=$k->batchnumber;
				$det["totalunits"]=$k->total_no_of_quantity;
				$det["manufacturedate"]=date("d/m/Y",strtotime($k->manufacturedate));
				$det["expiredate"]=date("d/m/Y",strtotime($k->expiredate));
				$det["purchaseprice"]=$k->purchaseprice;
				$det["gst"]=$k->gstpercent;
				$det["mrp"]=$k->mrp;
				$det["unitid"]=$k->unitid;
				$det["unitname"]=$k->unittype->unitvalue;
				$details[]=$det;
			  }
			  
                        $list['status']=true;
				        $list['message']= "Success";
                        $list['data']=$details;
			  
			  }
            else
            {
            	        $list['status']=true;
				        $list['message']= "No Stock found";
				         $list['data']=array();
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



  public function actionStockreceiveinputinfo() 
    
    {
    	
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="fetch-stockreceiveinputinfo";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/


	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','requestid');
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
		    	$requestid=$requestInput['requestid'];
				$branch=$data1->ba_branchid;
			 
			  $stockrequestdata=Stockrequest::find()->where(['requestid'=>$requestid])->all();
			  if($stockrequestdata)
			  {
			  	
					  	 foreach($stockrequestdata as $k)
			  {
			  $productdata=Product::find()->where(['productid'=>$k->productid])->one();
			  $hsncode=$productdata->hsn_code;
			  $list["stockname"]=$productdata->productname;
			  $unitid=$k->unitid;
			  $unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
			  $list['quantity']=$k->total_no_of_quantity."-".$unitdata->unitvalue;
			  $list['requestid']=$k->requestid;
			   $taxgroupdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->one();
			  if(count($taxgroupdata)>0)
			  {
			  	$tax=$taxgroupdata->tax;
			  }
			  
			  else 
			  {
				  $tax=0;
			  }
			    $list["gst"]=$tax;
			    $unitinfo=Unit::find()->where(['unitname'=>$productdata->product_typeid])->all();
			  
				foreach($unitinfo as $ll)
				{
				$det1=array();
				$det1['unitid']=$ll->unitid;
				$det1['unitname']=$ll->unitvalue;
				$det1['unitquantity']=$ll->no_of_unit;
				$det2[]=$det1;
				}
			    $list['unitinfo']=$det2;
			    $vendorinfo=VendorBranch::find()->where(['vendorid'=>$k->vendorid])->all();
			    $det4=array();
				foreach($vendorinfo as $lk)
				{
				$det3=array();
				$det3['vendorbranchid']=$lk->vendor_branchid;
				$det3['branchname']=$lk->branchname;
				$det4[]=$det3;
				}
			
			   $list['vendorinfo']=$det4;
			  
			    }
			            $list['status']=true;
				        $list['message']= "Success";
			  }
            else
            {
            	        $list['status']=true;
				        $list['message']= "No Stock found";
						$list['vendorinfo']=array();
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




 public function actionStockreceivesave() 
    {
    		
			
    	//error_reporting(0);
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockreceive-save";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','BatchQtyInfo','GstQtyinfo','Rceivedinfo');
	
	
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
	
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$batchqtyinfo=$requestInput['BatchQtyInfo'];
		$gstinfo=$requestInput['GstQtyinfo'];
		$receivedinfo=$requestInput['Rceivedinfo'];
		
	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	if($data1)
		    {
		    	$stockrequestid=$receivedinfo[0]["requestid"];
				$vendorbranchid=$receivedinfo[0]["vendorbranchid"];
				$stockrequestdata=Stockrequest::find()->where(['requestid'=>$stockrequestid])->one();
				$branchid=$stockrequestdata->branch_id;
				$vendorid=$stockrequestdata->vendorid;
				$productid=$stockrequestdata->productid;
				$productgroupid=$stockrequestdata->productgroupid;
				$unitid=$stockrequestdata->unitid;
				if(count($stockrequestdata)>0)
				{
				
				 $stock= Stockmaster::find()->where(['productgroupid'=>$productgroupid])->andwhere(['branch_id'=>$data1->ba_branchid])->one();	
				
				if(count($stock)==0)
				{
			$stock=new Stockmaster();
			
			$stockdata1=Stockmaster::find()->orderBy(['stockid' => SORT_DESC])->one();
			$stock->serialnumber=$stockdata1->stockid+1;
			$stock->branch_id=$data1->ba_branchid;
			$stock->productgroupid=$productgroupid;
			$productgroupdata=Productgrouping::find()->where(['productgroupid'=>$productgroupid])->one();
			$productid=$productgroupdata->productid;
			$stock->productid=$productid;
		    $productdata=Product::find()->where(['productid'=>$productid])->one();
			$stock->vendorid=$productgroupdata->vendorid;
			$stock->vendor_branchid=$vendorbranchid;
			$stock->compositionid=$productdata->composition_id;
			$unit=$productdata->unit;
			$stock->unitid=$unit;
			$stock->brandcode=$productgroupdata->brandcode;
			$stock->stockcode=$productgroupdata->stock_code;
			$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			$unitquantity=$unitdata->no_of_unit;
		    $stock->unitquantity=$unitquantity;
		    $stock->batchnumber=$batchqtyinfo[0]["batchnumber"];
			$stock->manufacturedate=$batchqtyinfo[0]["manufacturedate"];
			$stock->expiredate=$batchqtyinfo[0]["expiredate"];
			$receivedquantity=$receivedinfo[0]["receivedquantity"];
			
			
			$receivedfreequantity1=$receivedinfo[0]["freequantity"];
			if(!empty($receivedfreequantity1))
			{
				$receivedfreequantity=$receivedfreequantity1;
			}
			else {
				$receivedfreequantity=0;
			}
			
			
			
			
			$quantity=$receivedquantity+$receivedfreequantity;
			$stock->quantity=$quantity;
			$stock->total_no_of_quantity=$receivedinfo[0]["addTotalUnits"];
			$stock->price=$receivedinfo[0]["purchaseprice"];
			$stock->priceperqty=$receivedinfo[0]["priceperunit"];
			$stock->is_active=1;
		    $stock->updated_by=$data1->ba_branchid;
		    $stock->updated_ipaddress=$receivedinfo[0]["ipaddress"];
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
			$receivedquantity=$receivedinfo[0]["receivedquantity"];
			$receivedfreequantity=$receivedinfo[0]["freequantity"];
			$quantity=$receivedquantity+$receivedfreequantity;
			$batchnumber=$batchqtyinfo [0]["batchnumber"];
			$totalqty=$quantity*$unitquantity;
			$totalprice=$receivedinfo[0]["purchaseprice"];
			
		
			$stock->batchnumber=$batchnumber;
			$stock->manufacturedate=$batchqtyinfo[0]["manufacturedate"];
			$stock->expiredate=$batchqtyinfo[0]["expiredate"];
			$stock->priceperqty=($stock->price)/($receivedquantity * $unitquantity);
			$receiveddata=Stockresponse::find()->where(['stockrequestid'=>$stockrequestid])->andwhere(['batchnumber'=>$batchnumber])->one();
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
		    $stock->updated_by=$data1->ba_branchid;
		    $stock->updated_ipaddress=$receivedinfo[0]["ipaddress"];
			$stock->updated_on=date("Y-m-d H:i:s");
			
				}
	
			
			
			if($stock->save())
			{
						
		   $model1 = Stockresponse::find()->where(['stockrequestid'=>$stockrequestid])->andwhere(['stockid'=>$stock->stockid])->
		   andwhere(['batchnumber'=>$batchqtyinfo [0]["batchnumber"]])->one();	
	   
	    if($model1=="")
	    {
	   		$model=new Stockresponse();
		}
		else
		    {
			    $model=$model1;
		   }
			$model->receiveddate=date("Y-m-d");
			$expiredate=$batchqtyinfo[0]["expiredate"];
			$model->stockrequestid=$stockrequestid;
			$model->stockid=$stock->stockid;
			$model->request_code=$stockrequestdata->requestcode;
			$model->batchnumber=$stock->batchnumber;
			$model->expiredate=date("Y-m-d",strtotime($expiredate));
			$purchaseddate=$batchqtyinfo[0]["purchasedate"];
			$model->purchasedate=date("Y-m-d",strtotime($purchaseddate));
			$manufacturedate=$batchqtyinfo[0]["manufacturedate"];
			$model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
			$unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
		    $unitreceivedqty=$unitdata->no_of_unit;
			
			
			$model->purchaseprice=$receivedinfo[0]["purchaseprice"];
			$model->receivedquantity=$receivedinfo[0]["receivedquantity"];
			$model->receivedfreequantity=$receivedinfo[0]["freequantity"];
			$model->discountpercent=$batchqtyinfo[0]["discountpercent"];
			$model->mrp=$batchqtyinfo[0]["mrp"];
			$model->mrpperunit=$batchqtyinfo[0]["mrp_perunit"];
			$model->discountvalue=$batchqtyinfo[0]["discountvalue"];
			$model->gstpercent=$gstinfo[0]["gstpercent"];
			$model->gstvalue=$gstinfo[0]["gstvalue"];
			$model->cgstpercent=$gstinfo[0]["cgstpercent"];
			$model->cgstvalue=$gstinfo[0]["cgstvalue"];
			$model->sgstpercent=$gstinfo[0]["sgstpercent"];
			$model->sgstvalue=$gstinfo[0]["sgstvalue"];
			$model->igstpercent=$gstinfo[0]["igstpercent"];
			$model->igstvalue=$gstinfo[0]["igstvalue"];
			$model->priceperquantity=$receivedinfo[0]["priceperunit"];
			
			$model->unitid=$receivedinfo[0]["unitid"];
			$model->total_no_of_quantity=$receivedinfo[0]["addTotalUnits"];
		    $model->updated_by=$data1->ba_branchid;
		    $model->updated_ipaddress=$receivedinfo[0]["ipaddress"];
			$model->updated_on=date("Y-m-d H:i:s");
			
			$model->branch_id=$data1->ba_branchid;
			$model->sales_status=0;
	        $model->save();
			
					}	
					
					 $list['status']=true;
			         $list['message']= "success";
					 $list['data']=1;
					
				}
				
				else{
					 $list['status']=true;
			         $list['message']= "failure";
					 $list['data']=0;
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




 public function actionStockreceivestatussave() 
    {
    		
			
    	//error_reporting(0);
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockreceivestatus-save";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','requestid','receivestatus');
	
	
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
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$requestid=$requestInput['requestid'];
		$receivestatus=$requestInput['receivestatus'];
     	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	    if($data1)
		    {
		        $stockrequestdata=Stockrequest::find()->where(['requestid'=>$requestid])->one();
		        $requestcode=$stockrequestdata->requestcode;
			   
				if(count($stockrequestdata)>0)
				{
				 $stock= Stockresponse::find()->where(['request_code'=>$requestcode])->andwhere(['stockrequestid'=>$requestid])->one();	
				 $stock->sales_status=$receivestatus;
				 $stock->save();
				 $list['status']=true;
			         $list['message']= "success";
					 $list['data']= $receivestatus;
					
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


 public function actionStockreceiveview() 
    {
    
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockreceive-view";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/


	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','responseid');
	
	
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
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$responseid=$requestInput['responseid'];
		
     	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	    if($data1)
		    {
		    
					
				 $k= Stockresponse::find()->where(['stockresponseid'=>$responseid])->one();	
				 if(count($k)>0)
				 {
				 	$list['stockname']=$k->stockbrandcode->product->productname;
					$list['vendorname']=$k->stockbrandcode->vendor->vendorname;
					$list['requestquantity']=$k->batchnumber;
					$list['unitform']=$k->unittype->unitvalue;
					$requestid=$k->stockrequestid;
					$stockrequestdata=Stockrequest::find()->where(["requestid"=>$requestid])->one();
					$list['requestquantity']=$k->receivedquantity;
					
				 	 $list['batchnumber']=$k->batchnumber;
			         $list['receivedquantity']= $k->receivedquantity;
					 $list['freequantity']= $k->receivedfreequantity;
					  $list['expiredate']= date("d-m-Y",strtotime($k->expiredate));
					 $list['totalunits']= $k->total_no_of_quantity;
					 $list['receiveddate']= date("d-m-Y",strtotime($k->receiveddate));
					 $list['purchasedate']= date("d-m-Y",strtotime($k->purchasedate));
					 $list['manufacturedate']= date("d-m-Y",strtotime($k->manufacturedate));
					 $list['purchaseprice']= number_format($k->purchaseprice,2);
					 $list['priceperquantity']= number_format($k->priceperquantity,2);
					 $list['mrp']= number_format($k->mrp,2);
					 $list['mrpperunit']= number_format($k->mrpperunit,2);
				     $list['discountpercent']= $k->discountpercent;
					 $list['discountvalue']= number_format($k->discountvalue,2);
					 $list['gstpercent']= $k->gstpercent;
					 $list['gstvalue']= number_format($k->gstvalue,2);
					 $list['cgstpercent']= $k->cgstpercent;
					 $list['cgstvalue']= number_format($k->cgstvalue,2);
					 $list['sgstpercent']= $k->sgstpercent;
					 $list['sgstvalue']= number_format($k->sgstvalue,2);
					 $list['igstpercent']= $k->igstpercent;
					 $list['igstvalue']= number_format($k->igstvalue,2);
					 $list['receivestatus']= $k->sales_status;
				 	 $list['status']=true;
			         $list['message']= "success";
					
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


 public function actionStockreceivedelete() 
    {
    
	$list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
	
	
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockreceive-delete";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/


	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','responseid');
	
	
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
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$responseid=$requestInput['responseid'];
		
     	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	    if($data1)
		    {
		    	
					
				 $k= Stockresponse::find()->where(["stockresponseid"=>$responseid])->one();	
				 if(count($k)>0)
				 {
				 	 $k->delete();
					  $list['status']=true;
			         $list['message']= "success";
					
				 }
				  else
				 	{
				 		 $list['status']=true;
			         $list['message']= "Invalid Receive Id";
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







 public function actionStockrequeststatussave() 
    {
    	
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="stockrequeststatus-save";
	$log_model->request_data=$postd;
	$log_model->created_at=date("Y-m-d H:i:s");
	$log_model->save();
	$logid=$log_model->autoid;
/********* Log save end **********/
	
	$list['status']=false;
	$list['message']="";
	$field_check=array('authkey','requestcode');
	
	
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
	if($is_error=='yes'){
		$list['status']=false;
		$list['message']=$is_error_note . " is Mandatory.";
	}
	else
	{
		$authkey=$requestInput['authkey'];
		$requestcode=$requestInput['requestcode'];
		
     	$data1=BranchAdmin::find()->where(['auth_key'=>$authkey])->one();
	    if($data1)
		    {
		        $stockrequestdata=Stockrequest::find()->where(['requestcode'=>$requestcode])->all();
		       
			   
				if(count($stockrequestdata)>0)
				{
				foreach ($stockrequestdata as $key => $value) {
					$value->is_active=0;
					$value->updated_by=$data1->ba_branchid;
			        $value->updated_on=date("Y-m-d H:i:s");
					$value->save();
				}
				
				$list['status']=true;
	           $list['message']="Success";
				
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




 public function actionSaleschart() 
    {
    	
	  $list=array();
	$postd=(Yii::$app->request->rawBody);
	$requestInput=json_decode($postd,true);
/********* Log save start **********/	
	$log_model=new ApiLog();
	$log_model->event_key="sales-chart";
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
		       
			 

			 
		
		    $sql="SELECT invoicedate,SUM(overalltotal) as total FROM sales GROUP BY invoicedate order by invoicedate desc limit 0,7";
			$connection = Yii::$app->getDb();
            $command = $connection->createCommand($sql);
            $model = $command->queryAll();
			if(count($model)>0)
				{
				
				$det=array();$total=0;
				
			
					
					foreach ($model as $key => $value) {
						 
							$det["chartdate"]=$value["invoicedate"];
						    $det["chartvalue"]=floor(number_format($value["total"],2));
				            $det1[]=$det;
						    $det=array();
					}
			$list["data"]=$det1;
				
				$list['status']=true;
	            $list['message']="Success";
				
				
				
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

}