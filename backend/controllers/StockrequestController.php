<?php

namespace backend\controllers;

use Yii;
use backend\models\Stockrequest;
use backend\models\Product;
use backend\models\Stockmaster;
use backend\models\StockrequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Vendor;
use backend\models\Unit;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;
use backend\models\CompanyBranch;
use backend\models\Productgrouping;
use backend\models\VendorBranch;
use backend\models\Producttype;
use backend\models\Composition;
use yii\swiftmailer\Mailer;


class StockrequestController extends Controller
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
    		if($_POST)
    		{
    	
    	$Model = Stockrequest::find()->where(['requestid'=>$_POST['editableKey']])->one();
		if(count($Model)>0)
		{
              $post = [];
			 $posted = current($_POST['Stockrequest']);
             $post['Stockrequest'] = $posted;
             if ($Model->load($post)) {
			 $Model->save();
			 $output = '';
           $out = Json_encode(['output'=>$output, 'message'=>'']); 
           }
		      echo $out;
		      return;
			
		}
		
	}
		else
		{
		$searchModel = new StockrequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		
		if($role=="Super")
		{
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		
		else
		{
			$companylist=[];
		}
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,'companylist'=>$companylist,
         'vendorlist'=>$vendorlist,
             'productlist'=>$productlist,
        ]);
			}
       
    }


     public function actionReceive()
    {
    		if($_POST){
    	
    	$Model = Stockrequest::find()->where(['requestid'=>$_POST['editableKey']])->one();
		if(count($Model)>0)
		{
			
			 $post = [];
			 $posted = current($_POST['Stockrequest']);
      $post['Stockrequest'] = $posted;
      if ($Model->load($post))
	   {
      	
			 $Model->save();
			 $output = '';
             $out = Json_encode(['output'=>$output, 'message'=>'']); 
		   
		   
           }
		      echo $out;
		      return;
			
		}
		
	}
		
			else{
				 $searchModel = new StockrequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$session = Yii::$app->session;
		
		$role=$session['authUserRole'];
		if($role=="Super")
		{
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		else{
			$companylist=[];
		}
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');

        return $this->render('receive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'companylist'=>$companylist,
            'vendorlist'=>$vendorlist,
           
        ]);
			}
       
    }
     public function actionReturn()
    {
    		if($_POST){
    	
    	$Model = Stockrequest::find()->where(['requestid'=>$_POST['editableKey']])->one();
		if(count($Model)>0){
			
			$post = [];
			 $posted = current($_POST['Stockrequest']);
      $post['Stockrequest'] = $posted;
      if ($Model->load($post)) {
			
			
			$Model->save();
			 $output = '';
            
           $out = Json_encode(['output'=>$output, 'message'=>'']); 
           }
		      echo $out;
		      return;
			
		}
		
	}
		
			else{
				
				
				 $searchModel = new StockrequestSearch();
        
       // $dataProvider = $searchModel->returnsearch(Yii::$app->request->queryParams);
		 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		if($role=="Super")
		{
			
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		else{
			
			$companylist=[];
		}

        return $this->render('return', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'companylist'=>$companylist,
        ]);
			}
       
    }




	

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [ 'model' => $this->findModel($id)]);
       
    }

    public function actionCreate()
    {
        $model = new Stockrequest();
		
		$vendorbranch = new VendorBranch();
	
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');

        if ($model->load(Yii::$app->request->post())) {
        	
			$date=Yii::$app->request->post('Stockrequest')['requestdate'];
			$unitid=Yii::$app->request->post('Stockrequest')['unitid'];
			$qty=Yii::$app->request->post('Stockrequest')['quantity'];
			$model->unitid=$unitid;
			$model->quantity=$qty;
			
			$unitdata=Unit::find()->where(['unitid' => $unitid])->one();
			$unitqty=$unitdata->no_of_unit;
			$totalquantity=$qty*$unitqty;
			$model->total_no_of_quantity=$totalquantity;
			
			if($date!=""){
				
				$getdate=date('Y-m-d',strtotime($date));
				$model->requestdate=$getdate;
			}
			$maxid=Stockrequest::find()->max('requestid');
			//$model->requestcode="PO/".Yii::$app->request->post('vendorid')."/".date("Y")."/".date('m')."/".($maxid+1);
			$model->requestcode="DMC".($maxid+1);
			
           if($model->save()){
		   return $this->redirect(['index']); 
		   }else{
		   	
			
		   	print_r($model->getErrors());
		   }
        } else {
        	$list=array();
        	$vendorlist=Productgrouping::find()->select('vendorid')->distinct() ->all();
			if(count($vendorlist)>0){
				
			foreach ($vendorlist as $key => $value) {
				$venlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$value->vendorid])->one();
				$list[$venlist->vendorid]=$venlist->vendorname;
				
			}
			}else{
				$list=array();
			}
			$session = Yii::$app->session;
		$role=$session['authUserRole'];
		
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['branch_id'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		
		
			
            return $this->render('create', [
                'model' => $model,
                'list'=>$list,
                'unitlist'=>$unitlist,
                'companylist'=>$companylist,
                'vendorbranch' =>$vendorbranch,
            ]);
        }
    }
    public function actionMulticreate()
    {
        $model = new Stockrequest();
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');

        if ($model->load(Yii::$app->request->post())) {
        	
			$date=Yii::$app->request->post('Stockrequest')['requestdate'];
			$unitid=Yii::$app->request->post('Stockrequest')['unitid'];
			$qty=Yii::$app->request->post('Stockrequest')['quantity'];
			$model->unitid=$unitid;
			$model->quantity=$qty;
			
			$unitdata=Unit::find()->where(['unitid' => $unitid])->one();
			$unitqty=$unitdata->no_of_unit;
			$totalquantity=$qty*$unitqty;
			$model->total_no_of_quantity=$totalquantity;
			
			if($date!=""){
				
				$getdate=date('Y-m-d',strtotime($date));
				$model->requestdate=$getdate;
			}
			$maxid=Stockrequest::find()->max('requestid');
			$model->requestcode="PO/".Yii::$app->request->post('vendorid')."/".date("Y")."/".date('m')."/".($maxid+1);
			
           if($model->save()){
		   return $this->redirect(['index']); 
		   }else{
		   	
			
		   	print_r($model->getErrors());
		   }
        } else {
        	$list="";
        	$vendorlist=Stockmaster::find()->select('vendorid')->distinct() ->all();
			if(count($vendorlist)>0){
				
			foreach ($vendorlist as $key => $value) {
				$venlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$value->vendorid])->one();
				$list[$venlist->vendorid]=$venlist->vendorname;
				
			}
			}else{
				$list=array();
			}
			
            return $this->render('multicreate', [
                'model' => $model,
                'list'=>$list,
                'unitlist'=>$unitlist,
            ]);
        }
    }






    
    public function actionUpdate($id)
    {
        
		 $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	
		$requestid=Yii::$app->request->post('Stockrequest')['requestid'];
			
    	
    	if($requestid!=""){
    		 $session = Yii::$app->session;
    		
			$i=1;
			foreach ($requestid as $key => $value) {
				
				 $model = $this->findModel($value);
			$unitid=Yii::$app->request->post('Stockrequest')['unit'][$key];
			$qty=Yii::$app->request->post('quantity'.$i);
			$model->unitid=$unitid;
			$model->quantity=$qty;
			$unitdata=Unit::find()->where(['unitid' => $unitid])->one();
			$unitqty=$unitdata->no_of_unit;
			$totalquantity=$qty*$unitqty;
			$model->total_no_of_quantity=$totalquantity;
			$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");	
			$model->is_active=1;
			$model->save();
			$i++;
			}
			
    	}
		         Yii::$app->getSession()->setFlash('success','Request Updated successfully');
				 return $this->redirect(['index']);
			
    
        } else {
        	
			
            return $this->render('update', [
                'model' => $model,
               
            ]);
        }
    }
	
	
	public function actionGetproduct($id)
    {
    	
		 $rows = Productgrouping::find()->select(['productid'])->distinct()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
		 
		 $vendorbranchdata=VendorBranch::find()->where(['vendorid'=>$id])->all();
		 
		
		
		$ot=array();
		
        if(count($rows)>0){
            foreach($rows as $row){
            	
            	
				 $rows1 = Product::find()->where(['productid' => $row->productid])->one();
				if($rows1->productid!=""){
                $ot[0][]= "<option value='$rows1->productid'>$rows1->productname</option>";
				}
				
            }
        }
        else{
            $ot[0][]= "<option>Product Not Available for this Vendor.</option>";
        }
		
		if(!empty($vendorbranchdata))
		{
			if(count($vendorbranchdata)>0)
			{
				 foreach($vendorbranchdata as $ven)
				 {
				 	if($ven->vendor_branchid!="")
				 	{
	                	$ot[1][]= "<option value='$ven->vendor_branchid'>$ven->branchname</option>";
					}
				 }
			}
			else{
	            $ot[1][]= "<option>Email Not Provided.</option>";
	        }
		}
		
		
		return json_encode($ot);
	}
	
	
	
	
	
	 public function Getunit($id)
    {
    	
		
		 $rows1 = Unit::find()->all();
		 echo "<option value=''>Select</option>";
         if(count($rows1)>0){
            foreach($rows1 as $row2){
            	echo "<option value='$row2->unitid'>$row2->unitvalue</option>";
                                    }
                             }
        else{
            echo "<option>Product Not Available for this Vendor.</option>";
            }
		
	}
	
	
	 public function actionGetbrand($id,$data)
    {
    	 $rows = Stockmaster::find()->where(['vendorid' => $data])->andwhere(['productid'=>$id])->andwhere(['is_active'=>1])->one();
	     echo $rows->brandcode;
	
	}
	
	
	 public function actionAdd()
    {
    	
	  $model = new Stockrequest();
	  	
		$product=Yii::$app->request->post('Stockrequest')['productid'];
		$vendor=Yii::$app->request->post('Stockrequest')['vendorid'];
		$vendor_branch=Yii::$app->request->post('VendorBranch')['branchname'];
		
	if($vendor!="" && $product!="" && $vendor_branch !="")
	{
		$products=$product;
		$branch=Yii::$app->request->post('Stockrequest')['branch_id'];
		$company_data = CompanyBranch::find()->where(['branch_id' => $branch])->one();
		$branchname=$company_data->branch_name;
		$vendor_branch_conv=implode(',', $vendor_branch);
		 return $this->renderAjax('gridform', [
                'model' => $model,
                  'branch'=>$branch,
                  'products'=>$products,
                  'branchname'=>$branchname,
                  'vendor'=>$vendor,
                  'vendor_branch' => $vendor_branch_conv,
            ]);
	}
	
	}
	
	public function actionBackorder($requestcode)
    {
    	
	  $model = new Stockrequest();	
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		
		$requestdata=Stockrequest::find()->where(['requestcode'=>$requestcode])->all();
		$product=array();
		
		foreach($requestdata as $data)
		{
			$product[]=$data->productid;
		    $vendor=$data->vendorid;
		  
		}
		
		
	if($vendor!="" && $product!=""){
		$products=$product;
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		$company_data = CompanyBranch::find()->where(['branch_id' => $companybranchid])->one();
		$branchname=$company_data->branch_name;
		 return $this->render('backorderform', [
                'model' => $model,
                  'branch'=>$companybranchid,
                  'products'=>$products,
                  'branchname'=>$branchname,
                  'unitlist'=>$unitlist,
                  'vendor'=>$vendor,
                  'requestcode'=>$requestcode,
                 
            ]);
		
		
	
	}
	
	}
	
	public function actionSaverequest()
    {
    	
                $productid=Yii::$app->request->post('Stockrequest')['productid'];
    	
    	if($productid!="")
    	{
    		 $session = Yii::$app->session;
    		$date="";
			$unitid="";
			$qty="";
			$unitdata="";
			$stockrequestdata=	Stockrequest::find()->orderBy(['requestid' => SORT_DESC])->one();
		
			$stockincrement=$stockrequestdata->requestincrement+1;
			$i=1;
			
			$VendorEmail=explode(',', $_POST['VendorEmail']);
				
			foreach ($productid as $key => $value)
			{
				$model = new Stockrequest();
				$unitid=Yii::$app->request->post('Stockrequest')['unit'][$key];
				$qty=Yii::$app->request->post('quantity'.$i);
				$model->unitid=$unitid;
				$model->quantity=$qty;
				$model->branch_id=Yii::$app->request->post('Stockrequest')['branch_id'];
				$unitdata=Unit::find()->where(['unitid' => $unitid])->one();
				$unitqty=$unitdata->no_of_unit;
				$totalquantity=$qty*$unitqty;
				$model->total_no_of_quantity=$totalquantity;
				$model->requestdate=date("Y-m-d");
				$vendorid=Yii::$app->request->post('Stockrequest')['vendorid'][$key];
				$vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
				$vendorcode=$vendordata->vendorcode;
				//$model->requestcode="PO/".$vendorcode."/".date("Y")."/".date('m')."/".($stockincrement);
				$model->requestcode="DMC".($stockincrement);
				$model->vendorid=Yii::$app->request->post('Stockrequest')['vendorid'][$key];
				$model->productid=Yii::$app->request->post('Stockrequest')['productid'][$key];
				$model->brandcode=Yii::$app->request->post('Stockrequest')['brandcode'][$key];
				$model->productgroupid=Yii::$app->request->post('Stockrequest')['productgroupid'][$key];
				$model->updated_by=$session['user_id'];
				$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model->updated_on=date("Y-m-d H:i:s");	
				$model->requestincrement=$stockincrement;
				$model->requesttype="vendorstock";
				$model->is_active=1;
				$model->backorder_requestcode="";
				$model->save();
				$i++;
			}
			//echo "<pre>";
			
			
		
 			/*$vendorbranchemail=VendorBranch::find()->where(['IN','vendor_branchid',$VendorEmail])->all();
			
			
			if(!empty($vendorbranchemail))
			{
				$vendor_id=Yii::$app->request->post('Stockrequest')['vendorid'];
				$productid=Yii::$app->request->post('Stockrequest')['productid'];
				$unit_type=Yii::$app->request->post('Stockrequest')['unit'];
				
				
				$productgroupdata=Product::find()->where(['IN','productid',$productid])->all();
				$product_toArray = ArrayHelper::toArray($productgroupdata);
				$result_prdtype = ArrayHelper::map($product_toArray, 'productid', 'product_typeid');
				
				$producttypedata=Producttype::find()->where(['IN','product_typeid',$result_prdtype])->all();
				$dataPrd = ArrayHelper::index($producttypedata,'product_typeid');
				
				
				 $data_product = Productgrouping::find()->where(['IN','vendorid' , $vendor_id])->andwhere(['IN','productid',$productid])->andwhere(['is_active'=>1])->all();
				 $unitlist=Unit::find()->where(['IN','unitid',$unit_type])->all();
				 //$result_unit = ArrayHelper::index($unitlist, 'unitid');
				 
				 $fetchComposition = ArrayHelper::map($product_toArray, 'productid', 'composition_id');
				 $compositiondata=Composition::find()->where(['IN','composition_id',$fetchComposition])->all();
				 $dataComp = ArrayHelper::index($compositiondata,'composition_id');
				 
					//print_r($unitlist);die;
					
					$ty=1;
				foreach ($vendorbranchemail as $key => $value) 
				{
					$email=$value['branch_emailid'];
					
					$subject = "DMC Tablet Request";
					$message = "
							<body>
								
								<div>Hai Sir,</div>
								<br>
								<div>&nbsp;&nbsp;&nbsp;&nbsp;We are forwarding here with the details of tablet request Quantity. </div>
								<br>
								
								<table border='1'>
								<thead>
								<tr>
								<th>S No</th>
								<th>HSN Code</th>
								<th>Stock Code/Brand</th>
								<th>Stock/Type</th>
								<th>Composition</th>
								<th>Request/Qty</th>
								<th>Unit Type</th>
								</tr></thead><tbody>";
					
					foreach ($productgroupdata as $key => $value)
					{
						$unit_qty=Yii::$app->request->post('quantity'.$ty);
						$message .= "<tr>
										<td>".$value['hsn_code']."</td>
										<td>".$data_product[$key]['stock_code']."/".$data_product[$key]['brandcode']."</td>
										<td>".$value['productname']."/".$dataPrd[$value->product_typeid]['product_type']."</td>
										<td>".$dataComp[$value->composition_id]['composition_name']."</td>
										<td>".$unit_qty."</td>
										<td>".$unitlist[$key]['unitvalue']."</td></tr>";
										
										$ty++;
							
					}
					$message .="</tbody></table></body>";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					$headers .= 'From: <albanbensam.istrides@gmail.com>' . "\r\n";
					$retval=mail($email,$subject,$message,$headers);		
					if( $retval == true ) {echo "Message sent successfully...";
         			}else {
            			echo "Message could not be sent...";
         			}

							
				}
			}*/
			
			
    	}
         	Yii::$app->getSession()->setFlash('success','Request Added successfully');
			return $this->redirect(['index']);
	}


      	 public function actionSavebackorderrequest()
    {
    	
                $productid=Yii::$app->request->post('Stockrequest')['productid'];
    	
    	if($productid!=""){
    		 $session = Yii::$app->session;
    		$date="";
			$unitid="";
			$qty="";
			$unitdata="";
			$stockrequestdata=	Stockrequest::find()->orderBy(['requestid' => SORT_DESC])->one();
		
			$stockincrement=$stockrequestdata->requestincrement+1;
			$backorderrequestcode=$stockrequestdata->requestcode;
			$i=1;
			
			
			foreach ($productid as $key => $value) {
				
				 $model = new Stockrequest();
				$vendorid=Yii::$app->request->post('Stockrequest')['vendorid'][$key];
			$vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
			$vendorcode=$vendordata->vendorcode;
				 if ($model->load(Yii::$app->request->post())) {
			$unitid=Yii::$app->request->post('Stockrequest')['unit'][$key];
			$qty=Yii::$app->request->post('quantity'.$i);
			$model->unitid=$unitid;
			$model->quantity=$qty;
			$model->branch_id=Yii::$app->request->post('Stockrequest')['branch_id'];
			$unitdata=Unit::find()->where(['unitid' => $unitid])->one();
			$unitqty=$unitdata->no_of_unit;
			$totalquantity=$qty*$unitqty;
			$model->total_no_of_quantity=$totalquantity;
			$model->requestdate=date("Y-m-d");
			$model->requestcode="PO/".$vendorcode."/".date("Y")."/".date('m')."/".($stockincrement);
			$model->vendorid=$vendorid;
			$model->productid=Yii::$app->request->post('Stockrequest')['productid'][$key];
			$model->brandcode=Yii::$app->request->post('Stockrequest')['brandcode'][$key];
			$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");	
			$model->requestincrement=$stockincrement;
			$model->requesttype="vendorstock";
			$model->is_active=1;
			$model->backorder_requestcode=Yii::$app->request->post('Stockrequest')['requestcode'][$key];
			$model->productgroupid=Yii::$app->request->post('Stockrequest')['productgroupid'][$key];
		
			
			$model->save();
			}
			$i++;
			}

    	}


 			 $searchModel = new StockrequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           
        ]);
    	
	}
	
	 public function actionAdddetails($vendar,$product)
    {
  
	 $vendar=Vendor::find()->where(['vendorid'=>$vendar])->one();
	 $vendarname="";
	 if($vendar!=""){
	 	$vendarname=$vendar->vendorname;
	 }
		$getproduct=explode(",", $product);
		//print_r($getproduct);
		$product="";
		echo"<table border='0' width='100%'><thead><th>Vendor</th><th>Product</th><th>Brand Code</th><th>Units</th><th>remove</th><tbody>";
		foreach ($getproduct as $key => $value) {
		$product=Product::find()->where(['productid'=>$value])->one();	
	 $rows = Stockmaster::find()->where(['vendorid' => $vendar])->andwhere(['productid'=>$value])->andwhere(['is_active'=>1])->one();
	// $unit;
	
		//echo $product->productname;	
		
		echo"<tr><td>".$vendarname."</td><td>".$product->productname."</td><td>".$rows->brandcode."</td><td><select name='unit[]'>".$this->getunit($value)."</select></td><td>Units</td></tr>";
			
			
		}
		echo"</tbody></table>";
	}

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
	
	
	public function mailfunction($to, $sub, $body,$cc='',$attach='') {
		if (!empty($to)) {
			$message=Yii::$app -> mailer -> compose(); 
			$message-> setTo($to) ;
			$message-> setFrom(['care@tansihonda.com' => 'Tansi Service Report']);
			$message-> setCc($cc) ;
			$message->setBcc('vivekv2v@gmail.com');
			$message-> setSubject($sub) -> setHtmlBody($body) ;
		}
		if($attach!=""){
					$message->attach($attach);
				}
			$message->send();
				

	}

   
    protected function findModel($id)
    {
        if (($model = Stockrequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    
}
