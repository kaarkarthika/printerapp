<?php

namespace backend\controllers;

use Yii;
use backend\models\Stockmaster;
use backend\models\Product;
use backend\models\Productgrouping;
use backend\models\StockmasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Vendor;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\CompanyBranch;
use backend\models\BranchAdmin;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\models\Producttype;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockrequest;
use backend\models\Stockresponse;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorBranch;
use backend\models\Taxgrouping;
use backend\models\PurchaseLog;
use backend\models\TaxgroupingLog;
use backend\models\PurchaseData;
use backend\models\AutoidTable;
use yii\db\Query;

class StockmasterController extends Controller
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
    	
		
    	if($_POST){
    	
    	$Model = Stockmaster::find()->where(['stockid'=>$_POST['editableKey']])->one();
		if(count($Model)>0){
			//print_r($_POST);
			//die;
			$post = [];
			 $posted = current($_POST['Stockmaster']);
      $post['Stockmaster'] = $posted;
      if ($Model->load($post)) {
			//print_r($Model);
		  //die;
			$Model->priceperqty=($Model->price)/($Model->quantity);
			$Model->save();
			 $output = '';
            
           $out = Json_encode(['output'=>$output, 'message'=>'']); 
           }
		      echo $out;
		      return;
			
		}
		
	}
	
	
	else{
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		 $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		if($role=="Super")
		{
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		else{
			$companylist=[];
		}
		
		
		 $model = new Stockmaster();
		 
        $searchModel = new StockmasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'vendorlist' => $vendorlist,
            'productlist'=>$productlist,
             'companylist'=>$companylist,
             'branchlist'=>$branchlist,
             
        ]);
	}
    }
   public function actionAudit()
    {
    	
		
    	if($_POST){
    	
    	$Model = Stockmaster::find()->where(['stockid'=>$_POST['editableKey']])->one();
		if(count($Model)>0){
			//print_r($_POST);
			//die;
			$post = [];
			 $posted = current($_POST['Stockmaster']);
      $post['Stockmaster'] = $posted;
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
		
		
		 
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		
		
		
		 $model = new Stockmaster();
        $searchModel = new StockmasterSearch();
       $dataProvider = $searchModel->auditsearch(Yii::$app->request->queryParams);
	   
	   
	   $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
        return $this->render('audit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,
           
           
            
           
        ]);
	}
    }

   public function actionStockindex()
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
		
		
		 $model = new Stockmaster();
		 
        $searchModel = new StockmasterSearch();
        $dataProvider = $searchModel->stocksearch(Yii::$app->request->queryParams);

        return $this->render('stockindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
           'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,
             
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
        $model = new Stockmaster();
        if ($model->load(Yii::$app->request->post())) 
        {
        	$vendor=Yii::$app->request->post('Stockmaster')['vendorid'];
			$branch=Yii::$app->request->post('Stockmaster')['branch_id'];
			$product=Yii::$app->request->post('Stockmaster')['productid'];
			 $session = Yii::$app->session;
			 $userid=$session['user_id'];
			foreach ($product as  $value) 
			{
				
				$stockmaster=Stockmaster::find()->where(['vendorid'=>$vendor])->andwhere(['productid'=>$value])->andwhere(['branch_id'=>$branch])->one();
				$productgrp=Productgrouping::find()->where(['vendorid'=>$vendor])->andwhere(['productid'=>$value])->one();
				$pgrp=$productgrp->productgroupid;
				//echo $pgrp;die;
				if(count($stockmaster)>0){
					
				}
				else{
				
				     $maxid=Stockmaster::find()->max('stockid');
					
				  $stockdataarray[]=[ 'serialnumber'=>$maxid+1,
									  'branch_id'=>$branch,
									  'productgroupid'=>$pgrp,
									 'vendorid'=>$vendor,
									  'productid'=>$value, 
									  'is_active'=>1,
									  'updated_by'=>$userid,
									  'updated_ipaddress'=>$_SERVER['REMOTE_ADDR'],
									  'updated_on'=>date("Y-m-d H:i:s"),
					 ];
					  
					   $stockarray=['serialnumber','branch_id','productgroupid','vendorid','productid','is_active','updated_by','updated_ipaddress','updated_on'];
                       $insertCount1 = Yii::$app->db->createCommand()->batchInsert('stockmaster', $stockarray, $stockdataarray)->execute();
	                   $stockdataarray=[];
	    	       }
			
			}
			if($insertCount1){
				 Yii::$app->getSession()->setFlash('success','Stock Added successfully');
                return $this->redirect(['index']);
             }
			else{
				 Yii::$app->getSession()->setFlash('success','Stock not saved');
				 return $this->redirect(['index']);
			}
			
			
			
        } 
        
        
        
        else {
        	
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
		 $vendorbranchlist=ArrayHelper::map(VendorBranch::find()->where(['is_active'=>1])->asArray()->all(), 'vendor_branchid', 'branchname');
		
            return $this->render('_createform', [
                'model' => $model,
                'list'=>$vendorlist,
                'companylist'=>$companylist,
                'vendorbranchlist'=>$vendorbranchlist,
            ]);
        }
    }

    /**
     * Updates an existing Stockmaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            
		
			
		    $session = Yii::$app->session;
			
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			
		
			if($model->save())
			{
				echo "Y";
			}
			else{
				echo "N";
			}
			
			
			
			
        }
		 else {
        	$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
			$productlist=$this->getproductz($model->vendorid,$model->productid);
			
			//print_r($productdetail);
			//die;
			//$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->andwhere(['!=','productid',$productdetail])->asArray()->all(), 'productid', 'productname');
			
            return $this->renderAjax('update', [
                'model' => $model,
                'vendorlist'=>$vendorlist,
                'productlist'=>$productlist,
            ]);
        }
    }

    /**
     * Deletes an existing Stockmaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	
	 public function actionGetproduct($id)
    {
		  $rows = Productgrouping::find()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
		  
		 // $checkproduct = Stockmaster::find()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
		 /* $prdouctdetail=array();
		  if(!empty($checkproduct))
		  {
		  
		  foreach ($checkproduct as $key => $value) {
		  	 $productdetail[]=$value->productid;
		  }
		  }else{
		  	
		  	 $productdetail=[];
		  }
		*/
		 $data=Vendor::find()->where(['vendorid'=>$id])->one();
		
		if($data->default_vendor == 1)
		{
			$rows1 = Product::find()->where(['is_active' => 1])->all();
			if(!empty($rows1))
			{
				foreach ($rows1 as $key => $value) {
					 echo "<option value='$value->productid'>$value->productname</option>";
				}
			}
		}
		else 
		{
			if(!empty($rows))
			{
	            foreach($rows as $row)
	            {
	            	//if(!(in_array($row->productid,  $productdetail)))
	            	//{
	            		$rows1 = Product::find()->where(['productid' => $row->productid])->one();
						
						if($rows1->productid!="")
						{
	                		echo "<option value='$rows1->productid'>$rows1->productname</option>";
						}
					//}
				}
        	}	
		}
        
       
		
	}
	
	
	public function actionGetvendorbranch($vendorid)
    {
		 $rows = VendorBranch::find()->where(['vendorid' => $vendorid])->andwhere(['is_active'=>1])->all();
		 
        if($rows){
            foreach($rows as $row){
            	
            	
                echo "<option value='$row->vendor_branchid'>$row->branchname</option>";
				
			}
        }
       
		
	}
	
	
	 public function actionGetvendor($id)
    {
		 $rows = VendorBranch::find()->where(['vendor_branchid' => $id])->andwhere(['is_active'=>1])->one();
		 
	
        if(count($rows)>0){
          
            	      $vendordata=Vendor::find()->where(['vendorid'=>$rows->vendorid])->one();
					  $vendorname=$vendordata->vendorname;
                        echo "<option value='$rows->vendorid'>$vendorname</option>";
				
				}
			
       
		
	}

	
	 public function Getproductz($id,$pro)
    {
    	
		 $rows = Productgrouping::find()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
		 $checkproduct = Stockmaster::find()->where(['vendorid' => $id])->andwhere(['!=','productid',$pro])->andwhere(['is_active'=>1])->all();
		  if(count($checkproduct)>0)
		   {
		      $prdouctdetail="";
		      foreach ($checkproduct as $key => $value)
			   {
		  	  $productdetail[]=$value->productid;
			   }
		  }else{
		  	
		  	 $productdetail=[''];
		    }
	$val=[];
            if(count($rows)>0){
            foreach($rows as $row){
            if(!(in_array($row->productid,  $productdetail))){
            $rows1 = Product::find()->where(['productid' => $row->productid])->one();
			if($rows1->productid!=""){
             $val[$rows1->productid]=$rows1->productname;
				}
				}else
				{
			 }
			}
        }
        else{
          // echo "<option>Product Not Available for this Vendor.</option>";
        }
		return $val;
	}

    /**
     * Finds the Stockmaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Stockmaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stockmaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionExcelexport() {
	
		$objPHPExcel = new \PHPExcel();

		$sheet = 0;

		$objPHPExcel -> setActiveSheetIndex($sheet);
		
	
		$all_post_key = array("Sl. No.","branch_id","productname","vendorid","brandcode", "quantity","price");
		
		$r=0;
		$objPHPExcel -> getActiveSheet() -> setTitle("Stock_Details")				  
		-> setCellValue('A1', $all_post_key[$r]) 
		-> setCellValue('B1', $all_post_key[$r+1]) 
		-> setCellValue('C1', $all_post_key[$r+2])
		-> setCellValue('D1', $all_post_key[$r+3])
		-> setCellValue('E1', $all_post_key[$r+4])
		-> setCellValue('F1', $all_post_key[$r+5])
		-> setCellValue('G1', $all_post_key[$r+6]);
		
		
		$un_send_data = Stockmaster::find()-> all();
		
		
		$row = 2;
		$slno=1;			
		foreach($un_send_data as $one_data){
			$r_a=65;$r_a1=64;			
			foreach($all_post_key as $one_field){
				$cell_char=chr($r_a);
				if($r_a1>=65){
					$cell_char=chr($r_a1).chr($r_a);
				}
				if($one_field=='Sl. No.'){
					
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
				}else{
					
				if($one_field=="branch_id")
					{
						
						$id=$one_data->$one_field;
						$branchdata = CompanyBranch::find()->where(["branch_id"=>$id])->one();
			            $code=$branchdata->branch_code;
			 	   $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $code);
			     }
					
				else if($one_field=="productname")
					{
						//echo '<pre>';
						//print_r($one_field);die;
						$id=$one_data['productid'];
						
						$productdata = Product::find()->where(["productid"=>$id])->one();
						//print_r($productdata->stock_code);die;
						if(!empty($productdata->productname))
						{
							$code=$productdata->productname;	
						}
						else {
							$code='';
						}
			            
			 	   $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $code);
			     }
					else if($one_field=="vendorid")
					{
						
						$id=$one_data->$one_field;
						$vendordata = Vendor::find()->where(["vendorid"=>$id])->one();
			            $code=$vendordata->vendorcode;
			 	   $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $code);
			        }
					else{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $one_data->$one_field);
					}
					
					
				}
				if($r_a>=90){
					$r_a=64;
					$r_a1++;					
				}
				$r_a++;
			}
			$slno++;			
			$row++;
		}
 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
        $filename = "Stock List Details_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');		
		 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');  
			die; 
		
		
}







public function actionExcelimport()
    {
    	
    	$model=new Stockmaster();
		
    	 return $this->render('uploadformexl', [ 'model' => $model]);
       
	}
	
	
	public function actionAddstock()
    {
    	
	  $model = new Stockmaster();	
	  $vendorid=Yii::$app->request->post('Stockmaster')['vendorid'];
	   $products=Yii::$app->request->post('Stockmaster')['productid'];
	  // $branch=Yii::$app->request->post('Stockmaster')['branch_id'];
	   
		
	if( $vendorid!="" &&  $products!=""){
          return $this->renderAjax('stockproduct', [ 'model' => $model,'vendorid'=>$vendorid,'products'=>$products]);
	}
	else{
		 return $this->redirect(['index']);
	}
	
	}
	 
	public function actionSavestock()
    {
    	  
            $productid=Yii::$app->request->post('Stockmaster')['productid'];
            $vendor=Yii::$app->request->post('Stockmaster')['vendorid'];
			$branch=1;
			$vendor_branchid=Yii::$app->request->post('Stockmaster')['vendor_branchid'];
			$stockrequestdata=	Stockrequest::find()->orderBy(['requestid' => SORT_DESC])->one();
			$stockincrement=$stockrequestdata->requestincrement+1;
			
			
    	    if(!empty($productid))
    	    {
    	    $i=1;
			foreach ($productid as $key => $value) 
			{
			$stock=new Stockmaster();
		    $stock->serialnumber=Stockmaster::find()->orderBy(['stockid' => SORT_DESC])->one()+1;
			$stock->branch_id=$branch;
			$stock->vendor_branchid=$vendor_branchid;
			$stock->productgroupid=Yii::$app->request->post('productgroupid'.$i);
			$stock->productid=$value;
			$stock->vendorid=$vendor;
			$stock->compositionid=Yii::$app->request->post('compositionid'.$i);
			//$stock->unitid=Yii::$app->request->post('Stockresponse')["unitid"][$key];
			$stock->brandcode=Yii::$app->request->post('brandcode'.$i);
			$stock->stockcode=Yii::$app->request->post('stockcode'.$i);
			
			if(!empty(Yii::$app->request->post('Stockresponse')["unitid"][$key]))
			{
				$unit=Unit::find()->where(['unitid'=>Yii::$app->request->post('Stockresponse')["unitid"][$key]])->one();
				if($unit->is_tablet == 1)
				{
					$stock->unitid=41;
					$stock->unitquantity=1;
					$stock->quantity=Yii::$app->request->post('totalunits'.$i);
					
					$is_tablet=1;
				}
				else 
				{
					$stock->unitid=Yii::$app->request->post('Stockresponse')["unitid"][$key];
					$stock->unitquantity=Yii::$app->request->post('unitquantity'.$i);
					$stock->quantity=Yii::$app->request->post('quantity'.$i);
					
					$is_tablet=0;
				}
				
				$purchase_unit = Yii::$app->request->post('Stockresponse')["unitid"][$key];
				$size_qty=$unit->no_of_unit;
					
			}
			//Free Qty Add
			$stock->free_qty=Yii::$app->request->post('free_qty'.$i);
			
			
			$stock->batchnumber=Yii::$app->request->post('batchnumber'.$i);
			$stock->manufacturedate=date("Y-m-d",strtotime(Yii::$app->request->post('manufacturedate'.$i)));
			$stock->expiredate=date("Y-m-d",strtotime(Yii::$app->request->post('expiredate'.$i)));
			
			$stock->total_no_of_quantity=Yii::$app->request->post('totalunits'.$i);
			$stock->priceperqty=Yii::$app->request->post('Stockresponse')["priceperquantity"][$key];
			$stock->price=Yii::$app->request->post('Stockresponse')["purchaseprice"][$key];
		    $stock->is_active=1;
			$session = Yii::$app->session;
		    $stock->updated_by=$session['user_id'];
		    $stock->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$stock->updated_on=date("Y-m-d H:i:s");
			
			if($stock->save())
			{
			$stockrequest = new Stockrequest();
			$stockrequest->requestincrement=$stockincrement;
			$vendorid=$stock->vendorid;
			$vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
			$vendorcode=$vendordata->vendorcode;
			$stockrequest->requestcode="DMC".($stockincrement);
			$stockrequest->requesttype="directstock";
			$stockrequest->branch_id=$stock->branch_id;
			$stockrequest->vendorid=$stock->vendorid;
			$stockrequest->productid=$stock->productid;
			$stockrequest->brandcode=$stock->brandcode;
			$stockrequest->quantity=$stock->quantity;
			$stockrequest->unitid=$stock->unitid;
			$stockrequest->total_no_of_quantity=$stock->total_no_of_quantity;
			$stockrequest->requestdate=date("Y-m-d");
			$stockrequest->is_active=1;
			$session = Yii::$app->session;
			$stockrequest->updated_by=$session['user_id'];
			$stockrequest->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$stockrequest->updated_on=date("Y-m-d H:i:s");	
			$stockrequest->productgroupid=$stock->productgroupid;
			if($stockrequest->save())
			{
			 	    $model=new Stockresponse();	
			 		$session = Yii::$app->session;
					$model->stockrequestid=$stockrequest->requestid;
					$model->request_code=$stockrequest->requestcode;
					$model->stockid=$stock->stockid;
					$model->branch_id=$stockrequest->branch_id;
					$model->batchnumber=Yii::$app->request->post('batchnumber'.$i);
					$model->receivedquantity=$stockrequest->quantity;
					$model->total_no_of_quantity=$stockrequest->total_no_of_quantity;
					$model->unitid=$stockrequest->unitid;
					$model->receiveddate=date('Y-m-d');
					
					$model->purchaseprice=$stock->price;
					$model->priceperquantity=$stock->priceperqty;
			        $expiredate=Yii::$app->request->post('expiredate'.$i);
			        $model->expiredate=date("Y-m-d",strtotime($expiredate));
			        $model->purchasedate=date("Y-m-d",strtotime(Yii::$app->request->post('Stockresponse')["purchaseprice"][$key]));
			        $manufacturedate=Yii::$app->request->post('manufacturedate'.$i);
			        $model->manufacturedate=date("Y-m-d",strtotime($manufacturedate));
			        $model->updated_by=$session['user_id'];
			        $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			        $model->updated_on=date("Y-m-d H:i:s");
					$model->receivedfreequantity=Yii::$app->request->post('free_qty'.$i);
					$model->discountpercent=Yii::$app->request->post('Stockresponse')["discountpercent"][$key];
					$model->discountvalue=Yii::$app->request->post('Stockresponse')["discountvalue"][$key];
				
					
				
					$model->gstpercent=Yii::$app->request->post('Stockresponse')["gstpercent"][$key];
					$model->gstvalue=Yii::$app->request->post('Stockresponse')["gstvalue"][$key];
					$model->cgstpercent=Yii::$app->request->post('Stockresponse')["cgstpercent"][$key];
					$model->cgstvalue=Yii::$app->request->post('Stockresponse')["cgstvalue"][$key];
					$model->sgstpercent=Yii::$app->request->post('Stockresponse')["sgstpercent"][$key];
					$model->sgstvalue=Yii::$app->request->post('Stockresponse')["sgstvalue"][$key];
					$model->igstpercent=Yii::$app->request->post('Stockresponse')["igstpercent"][$key];
					$model->igstvalue=Yii::$app->request->post('Stockresponse')["igstvalue"][$key];
					$model->mrpperunit=Yii::$app->request->post('Stockresponse')["mrpperunit"][$key];
					$model->mrp=Yii::$app->request->post('Stockresponse')["mrp"][$key];
					
					//New Code
					
					$model->product_id = $stockrequest->productid;
					$model->purchase_unit =$purchase_unit ;
					$model->size_qty = $size_qty;
					$model->is_tablet =  $is_tablet;
					
					
					
					if($model->save())
					{
						
						$purchase_log = PurchaseLog::find()->where(['stock_res_id' => $model->stockresponseid])->one();
					if(empty($purchase_log))
					{
						$purchase_log = new PurchaseLog();	
					}
					
					$purchase_log->vendor_inv_no=Yii::$app->request->post('Stockresponse')['vendor_inv_no'];
					$purchase_log->stock_res_id =  $model->stockresponseid;
					$purchase_log->stock_req_id =  $model->stockrequestid;
					$purchase_log->req_code = "DMC".($stockincrement); 
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
					$purchase_log->received_date =  date('Y-m-d');
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
            else
				{
					print_r($stock->getErrors());die;
				}
					   ++$i;
    	}
	}

else {
	      echo "product is invalid"; die;
     }


	}
	
	
	public function actionExcelupload(){
		$model=new Stockmaster();
	    if (Yii::$app->request->isPost) {
		$model -> brandcode = UploadedFile::getInstance($model, 'brandcode');
			$data_name=$model -> brandcode -> tempName;	
			$objPHPExcel = \PHPExcel_IOFactory::load($data_name);
			$sheetData = $objPHPExcel -> getActiveSheet() -> toArray(null, true, true, true);
			$sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
         for($row=2; $row<=$highestRow; ++$row)
         {                  
             $model = new Stockmaster;
             $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
             $stockcode = $rowData[0][1];
             $vendorcode= $rowData[0][2];
			 $vendordata = Vendor::find()->where(['LIKE',"vendorcode",$vendorcode])->one();
			 $query=Stockmaster::find()  ->where(['stockid' => Stockmaster::find()->max('stockid')]) ->one();
                    $sno=$query->stockid+1;
			 if(!empty($vendordata))
			 {
			 	$model->vendorid=$vendordata->vendorid;
			 }
			 else{
			 	$model->vendorid="";
			 }
			  $productdata = Product::find()->where(['LIKE',"stock_code",$stockcode])->one();
			 if(!empty($productdata))
			 {
			 	$model->productid=$productdata->productid;
			 }
			 else{
			 	$model->productid="";
			 }
		     $model->brandcode = $rowData[0][3];
			 $model->quantity = $rowData[0][4];
			 $model->price = $rowData[0][5];
			 $model->is_active=$rowData[0][6];
		     $session = Yii::$app->session;
	         $model->updated_by=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updated_on=date("Y-m-d H:i:s");
			 $model->serialnumber=$sno;
			 $model->save();
			
         }
		  return $this->redirect(['index']);
	}
	}
	
	
		public function actionExportexceldownload($productid,$vendorid,$compositionid,$brandcode,$stockcode,$expfrom,$expto,$branchid)
		 {
		$objPHPExcel = new \PHPExcel();
		$sheet = 0;
		$objPHPExcel -> setActiveSheetIndex($sheet);
	    $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
	    $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		$query = Stockmaster::find()->joinwith(['stockresponse']);
		 
		 
		if(!empty($branchid))
		{
			$query->andFilterWhere(['stockresponse.branch_id' =>$branchid]);
		}
		
		if(!empty($productid))
		{
			 $query->andFilterWhere(['productid'=> $productid]);
		}
        if(!empty($vendorid))
		{
			 $query->andFilterWhere(['vendorid'=> $vendorid]);
		}
		if(!empty($compositionid))
		{
			 $query->andFilterWhere(['compositionid'=> $compositionid]);
		}
		if(!empty($brandcode))
		{
			 $query->andFilterWhere(['brandcode'=> $brandcode]);
		}
		if(!empty($stockcode))
		{
			 $query->andFilterWhere(['stockcode'=> $stockcode]);
		}
		
		
		 if(!empty($expdate))
	{
		
	  $fromdate=date("Y-m-d",strtotime($expfrom));
	  $todate=date("Y-m-d",strtotime($expto));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
	
	
		 $dataProvider = new ActiveDataProvider(['query' => $query ]);
         $datatables = $dataProvider->getModels();
						$objPHPExcel -> getActiveSheet() -> setTitle("Stock_Details")				  
		-> setCellValue('A1', "Serial No") 
		-> setCellValue('B1', "Serial No") 
		-> setCellValue('C1', "Vendor") 
		-> setCellValue('D1', "Stock")
		-> setCellValue('E1', "Stock Type")
		-> setCellValue('F1', "Stock Code")
		-> setCellValue('G1', "Drug")
		-> setCellValue('H1', "BrandCode")
		-> setCellValue('I1', "Batch Number")		
		-> setCellValue('J1', "Expire Date")
		-> setCellValue('K1', "Quantity")	
		-> setCellValue('L1', "Unit")-> setCellValue('M1', "Price\Qty")	-> setCellValue('N1', "Price");	
                                	if(count($datatables)>0){
                                		$i=1;
                                			$row = 2;
                                		
                                	foreach ($datatables as $key => $value) {
                                		$stockdata=Stockresponse::find()->where(['stockid'=>$value->stockid])->all();
												
								
										$vendorid=array();$productid=array();$productgroupid=array();$stockcodeid=array();$compositionid=array();$branchid=array();
										
										
										
										$branchid[]=$value->branch_id;
										$newbranchdata=array_intersect_key($branchlist, array_flip($branchid));
									    $branchval=array_values($newbranchdata);
										
										
										
										$vendorid[]=$value->vendorid;
										$newvendordata=array_intersect_key($vendorlist, array_flip($vendorid));
									    $vendorval=array_values($newvendordata);
										
										$productid[]=$value->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										
										$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$value->productid])->one();
										
										$compositionid[]=$value->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										$unitid[]=$value->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										if($pdata)
										{
											
											$producttypeid[]=$pdata->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
										}
										
										if($stockdata)
										{
														foreach($stockdata as $sd)
										{
											
									$r_a=65;
								   	$batchno=$sd->batchnumber;
										$expdate=date("d/m/Y",strtotime($sd->expiredate));
										$priceperqty=$sd->priceperquantity;
										$price=$sd->purchaseprice;
				
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr($r_a).$row, $i);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $branchval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $vendorval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $productval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $producttypeval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $value->stockcode);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $compositionval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $value->brandcode);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$batchno);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$expdate);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$sd->receivedquantity);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$unitval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$priceperqty);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$price);
			            $row++;	
						$i++;
                               } 
										}
										
										else{
												$r_a=65;
											$batchno="";
										$expdate="";
										$price="";$qty="";$priceperqty="";
										$objPHPExcel -> getActiveSheet() -> setCellValue(chr($r_a).$row, $i);
										$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $branchval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $vendorval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $productval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $producttypeval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $value->stockcode);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $compositionval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row, $value->brandcode);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$batchno);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$expdate);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$sd->receivedquantity);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$unitval[0]);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$priceperqty);
						$objPHPExcel -> getActiveSheet() -> setCellValue(chr(++$r_a) . $row,$price);
										
								  $row++;			
											
								 $i++;
											
										}
                                    $newbranchdata=array(); $branchid=array(); $branchval="";
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproductgroupdata=array(); $productgroupid=array();$productgroupval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newstockcodedata=array(); $stockcodeid=array();$unitval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
									
									
									
                               }	} 
                                
                              

		
 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
        $filename = "Stock List Details_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');		
		 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');  
		 return $this->redirect(['index']);
		
	}

		public function actionExportpdfdownload($productid,$vendorid,$compositionid,$brandcode,$stockcode,$expfrom,$expto,$branchid) 
		{
			
			require ('../../vendor/tcpdf/tcpdf.php');
	    $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->AddPage();



	    $vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
	    $query = Stockmaster::find()->joinwith(['stockresponse']);
		$session = Yii::$app->session;
		$companybranchid=$session['branch_id'];
		$role=$session['authUserRole'];
		
		
	
		if(!empty($branchid))
		{
				
			$query->andFilterWhere(['stockresponse.branch_id' =>$branchid]);
			$branchdata=CompanyBranch::find()->where(['branch_id'=>$branchid])->one();
			$branchname=$branchdata->branch_name;
		}
		else{
			$branchname ="All Branches";
		}
		
		
		
		if(!empty($productid))
		{
			 $query->andFilterWhere(['productid'=> $productid]);
		}
        if(!empty($vendorid))
		{
			 $query->andFilterWhere(['vendorid'=> $vendorid]);
		}
		if(!empty($compositionid))
		{
			 $query->andFilterWhere(['compositionid'=> $compositionid]);
		}
		if(!empty($brandcode))
		{
			 $query->andFilterWhere(['brandcode'=> $brandcode]);
		}
		if(!empty($stockcode))
		{
			 $query->andFilterWhere(['stockcode'=> $stockcode]);
		}
 if(!empty($expdate))
	{
		
	  $fromdate=date("Y-m-d",strtotime($expfrom));
	  $todate=date("Y-m-d",strtotime($expto));
	  $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
         $dataProvider = new ActiveDataProvider(['query' => $query,'pagination'=>false]);
         $datatables = $dataProvider->getModels();
          $tbl='<table  cellspacing="1" cellpadding="3" border="0.1">
                                <tr>
                                	<td ><b>#</b></td>
                                    <td><b>Vendor</b></td>
                                    <td><b>Stock</b></td>
                                    <td><b>Type</b></td>
                                    <td><b>Stock Code</b></td>
                                    <td><b>Drug</b></td>
                                    <td><b>Brand Code</b></td>
                                    <td><b>Batch Number</b></td>
                                    <td><b>Expire Date</b></td>
                                    <td ><b>Total Qty</b></td>
                                    <td ><b>Unit</b></td>
                                    <td><b>MRP/Unit<br>(Rs.)</b></td>
                                    <td><b>Price<br>(Rs.)</b></td>
                                </tr>
                              <tbody>';
						if(count($datatables)>0)
                                	{
                                		$i=1;
                                	foreach ($datatables as $key => $value) {
                                		$stockdata=Stockresponse::find()->where(['stockid'=>$value->stockid])->all();
										$vendorid=array();$productid=array();$productgroupid=array();$stockcodeid=array();$compositionid=array();$branchid=array();
										$vendorid[]=$value->vendorid;
										$newvendordata=array_intersect_key($vendorlist, array_flip($vendorid));
									    $vendorval=array_values($newvendordata);
										$productid[]=$value->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$value->productid])->one();
										$compositionid[]=$value->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										$unitid[]=$value->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										if($pdata)
										{
										$producttypeid[]=$pdata->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
										}
										if($stockdata)
										{
										foreach($stockdata as $sd)
										{
											$batchno=$sd->batchnumber;
										$expdate=date("d/m/y",strtotime($sd->expiredate));
										$priceperqty=$sd->mrpperunit;
										$price=$sd->purchaseprice;
										
                                $tbl.= "<tr><td style='width:50px;'>".$i."</td> <td>".$vendorval[0]."</td> <td>".$productval[0]."</td>
                                   <td>".$producttypeval[0]."</td><td>".$value->stockcode."</td> <td>".$compositionval[0]."</td> <td>".$value->brandcode."</td>
                                   <td>".$batchno."</td>
                                  <td>".$expdate."</td>
								<td align='right;'>".$sd->total_no_of_quantity."</td>
								<td>".$unitval[0]."</td>
								<td align='right'>".$priceperqty."</td>
								<td align='right'>".$price."</td>
                               </tr>";
							   
							   
								 $i++;
                               } 
								}
								else
										{
										$batchno="";
										$expdate="";
										$price="";$qty="";
				                   	$tbl.= "<tr><td>".$i."</td>
									<td>".$vendorval[0]."</td> 
								    <td>".$productval[0]."</td>
                                    <td>".$producttypeval[0]."</td>
                                    <td>".$value->stockcode."</td> 
                                    <td>".$compositionval[0]."</td>
                                    <td>".$value->brandcode."</td>
                                    <td>".$batchno."</td><td>".$expdate."</td><td align='right'>".$qty."</td>
                                    <td>".$unitval[0]."</td><td align='right'></td><td align='right'></td>
                                 </tr>";
								 $i++;	
										}
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproductgroupdata=array(); $productgroupid=array();$productgroupval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newstockcodedata=array(); $stockcodeid=array();$unitval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
                               }	
                               } 
                          $tbl.='</tbody></table>';
                          $header="<center><h2 style='text-align:center;'> $branchname - Stocklist</h2><center>";
                          $pdf->writeHTML($header, true, false, false, false, '');
	                      $pdf->writeHTML($tbl, true, false, false, false, '');
                          $pdf->Output('example_001.pdf');
                          
	}

		 public function actionGetunitquantity($id,$dataid)
    {
    	
		$rows=Unit::find()->where(['unitid'=>$id])->one();
		$res["noofunit"]=$rows->no_of_unit;
		$res["dataid"]=$dataid;
		$res["is_tablet"]=$rows->is_tablet;
        return json_encode($res);
		
	}
	
	public function actionGetigstcalculation($id,$dataid)
    {
    	
		$rows=VendorBranch::find()->where(['vendor_branchid'=>$id])->one();
		$res["igstpercent"]=$rows->igstpercent;
		$res["dataid"]=$dataid;
        return json_encode($res);
		
		
	}
	
public function actionNewstockmodule()
{
if($_POST)
{
	//echo '<pre>';
	//print_r($_POST);
	//session declaration
	$session = Yii::$app->session;
	
	//Auto ID Fetched
	$auto_get=AutoidTable::find()->where(['auto'=>19])->asArray()->one();
	$autoget=$auto_get['start_num'];
    $inc_value=$autoget+1;
    $rtno = str_pad($autoget, 6, "0", STR_PAD_LEFT);
	
	//vendortable
	$vendor_branch=VendorBranch::find()->where(['vendorid'=>$_POST['VENDORNAME']])->asArray()->one();
	
	
	$purchase_data=new PurchaseData();
	$purchase_data->bill_no =$rtno;
	$purchase_data->vendor =$_POST['VENDORNAME'];
	$purchase_data->vendor_branch_id =$vendor_branch['vendor_branchid'];
	$purchase_data->invoice_no =$_POST['INVOICEBILL'];
	$purchase_data->invoice_date =date('Y-m-d',strtotime($_POST['INVOICEDATE']));
	$purchase_data->sub_total =$_POST['OverallSubTotal'];
	$purchase_data->discount_amount =$_POST['DiscountAmount'];
	$purchase_data->gst_amount =$_POST['OVERALLGSTAMOUNT'];
	$purchase_data->cgst_amount =$_POST['OVERALLGSTAMOUNT']/2;
	$purchase_data->sgst_amount =$_POST['OVERALLGSTAMOUNT']/2;
	$purchase_data->total_expenses =$_POST['TOTALEXPENSES'];
	$purchase_data->net_amount =$_POST['NETAMOUNT'];
	$purchase_data->round_off =$_POST['ROUNDOFF'];
	$purchase_data->total_amount =$_POST['OVERALLTOTALAMOUNT'];
	$purchase_data->created_at =date('Y-m-d H:i:s');
	$purchase_data->updated_by =$session['user_id'];
	$purchase_data->updated_ipaddress =$_SERVER['REMOTE_ADDR'];
	
	if($purchase_data->save())
	{
		$branch=1;
		$product=Product::find()->where(['IN','productid',$_POST['PRODUCT_NAME']])->asArray()->all();
		$product_index=ArrayHelper::index($product,'productid');
		
		$unit_maping=ArrayHelper::map($product,'productid','unit');
		$unit=Unit::find()->where(['IN','unitid',$unit_maping])->asArray()->all();
		$unit_index=ArrayHelper::index($unit,'unitid');
		
		
		
		$stockmaster_push=array();
		foreach ($_POST['PRODUCT_NAME'] as $key => $value) 
		{
			if(!empty($product_index[$_POST['PRODUCT_NAME'][$key]]))
			{
				$get_unit_id=$product_index[$_POST['PRODUCT_NAME'][$key]]['unit'];
				if(!empty($get_unit_id))
				{
					$get_is_tablet=$unit_index[$get_unit_id]['is_tablet'];
					if($get_is_tablet == 1)
					{
						$unit_id=41;
						$unitquantity=1;
						$total_unit=$_POST['TOTAL_UNIT'][$key];
						$is_tablet=1;
					}
					else
					{
						$unit_id=$get_unit_id;
						$unitquantity=$unit_index[$get_unit_id]['no_of_unit'];
						$total_unit=$_POST['TOTAL_UNIT'][$key];
						$is_tablet=0;
					}
				}
			}
			
			if(empty($_POST['QUANTITY'][$key]))
			{
				$quantity=0;
			}
			else {
				$quantity=$_POST['QUANTITY'][$key];
			}
			
			if(empty($_POST['FREE_QUANTITY'][$key]))
			{
				$free_qty=0;
			}
			else {
				$free_qty=$_POST['FREE_QUANTITY'][$key];
			}
			
			$stock_master=new Stockmaster();
			
			$stock_master->branch_id=$branch;
			$stock_master->productid=$_POST['PRODUCT_NAME'][$key];
			$stock_master->vendorid=$_POST['VENDORNAME'];
			$stock_master->vendor_branchid=$vendor_branch['vendor_branchid'];
			$stock_master->vendor_inv_no=$_POST['INVOICEBILL'];
			$stock_master->compositionid=$product_index[$_POST['PRODUCT_NAME'][$key]]['composition_id'];
			$stock_master->unitid=$unit_id;
			$stock_master->purchase_unitid=$get_unit_id;
			$stock_master->purchase_no_of_unit=$unit_index[$get_unit_id]['no_of_unit'];
			$stock_master->purchase_qty=$total_unit;
			$stock_master->total_no_of_quantity=$total_unit;
			$stock_master->batchnumber=$_POST['BATCH_NO'][$key];
			$stock_master->expiredate=date('Y-m-d',strtotime($_POST['EXPIRED_DATE'][$key]));
			$stock_master->unitquantity=$unitquantity;
			$stock_master->quantity=$quantity*$_POST['PACK_SIZE'][$key];
			$stock_master->free_qty=$free_qty*$_POST['PACK_SIZE'][$key];
			$stock_master->sub_total_amount=$_POST['SUBTOTALAMOUNT'][$key];
			$stock_master->price=$_POST['TOTALAMOUNT'][$key];
			$stock_master->priceperqty=$_POST['RATE_PER_UNIT'][$key];
			$stock_master->is_active=1;
			$stock_master->created_at=date('Y-m-d H:i:s');
			$stock_master->updated_by=$session['user_id'];
			$stock_master->updated_on=date('Y-m-d H:i:s');
			$stock_master->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			if($stock_master->save())
			{
				$stock_response=new Stockresponse();
				$stock_response->stockid=$stock_master->stockid;
				$stock_response->branch_id=$stock_master->branch_id;
				$stock_response->vendor_inv_no=$stock_master->vendor_inv_no;
				$stock_response->batchnumber=$stock_master->batchnumber;
				$stock_response->receivedquantity=$stock_master->purchase_qty;
				$stock_response->total_no_of_quantity=$stock_master->total_no_of_quantity;
				$stock_response->unitid=$stock_master->unitid;
				$stock_response->product_id=$stock_master->productid;
				$stock_response->purchase_unit=$stock_master->purchase_unitid;
				$stock_response->size_qty=$stock_master->purchase_no_of_unit;
				$stock_response->is_tablet=$is_tablet;
				$stock_response->receiveddate=date('Y-m-d',strtotime($_POST['INVOICEDATE']));
				$stock_response->purchaseprice=$stock_master->price;
				$stock_response->priceperquantity=$stock_master->priceperqty;
				$stock_response->except_free_qty=$stock_master->quantity;
				$stock_response->receivedfreequantity=$stock_master->free_qty;
				$stock_response->discountpercent=$_POST['DISCOUNT_PERCENT'][$key];
				$stock_response->discountvalue=$_POST['DISCOUNT_AMOUNT'][$key];
				$stock_response->gstpercent=$_POST['GST_PERCENT'][$key];
				$stock_response->gstvalue=$_POST['GST_AMOUNT'][$key];
				$stock_response->cgstpercent=$_POST['GST_PERCENT'][$key]/2;
				$stock_response->cgstvalue=$_POST['GST_AMOUNT'][$key]/2;
				$stock_response->sgstpercent=$_POST['GST_PERCENT'][$key]/2;
				$stock_response->sgstvalue=$_POST['GST_AMOUNT'][$key]/2;
				$stock_response->mrpperunit=$_POST['MRP'][$key];
				$stock_response->mrp=$_POST['MRP'][$key]*$_POST['QUANTITY'][$key];
				$stock_response->expiredate=date('Y-m-d',strtotime($_POST['EXPIRED_DATE'][$key]));
				$stock_response->updated_by=$session['user_id'];
				$stock_response->created_at=date('Y-m-d H:i:s');
				$stock_response->updated_on=date('Y-m-d H:i:s');
				$stock_response->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				if($stock_response->save())
				{
					$purchase_log=new PurchaseLog();
					$purchase_log->purchase_data_id=$purchase_data->id;
					$purchase_log->	stock_res_id=$stock_response->stockresponseid;
					$purchase_log->	stock_id=$stock_response->stockid;
					$purchase_log->	productid=$stock_response->product_id;
					$purchase_log->	vendor_id=$stock_master->vendorid;
					$purchase_log->	vendor_branch_id=$stock_master->vendor_branchid;
					$purchase_log->	vendor_inv_no=$stock_master->vendor_inv_no;
					$purchase_log->	composition_id=$stock_master->compositionid;
					$purchase_log->	branch_id=$stock_response->branch_id;
					$purchase_log->	batch_number=$stock_master->batchnumber;
					$purchase_log->	received_qty=$stock_response->receivedquantity;
					$purchase_log->	total_qty=$stock_response->total_no_of_quantity;
					$purchase_log->	unit_id=$stock_master->unitid;
					$purchase_log->	purchase_unit_id=$stock_master->purchase_unitid;
					//$purchase_log->	sales_no_of_unit=
					$purchase_log->	purchase_no_of_unit=$stock_master->purchase_no_of_unit;
					$purchase_log->	is_tablet=$is_tablet;
					$purchase_log->	received_date=date('Y-m-d',strtotime($_POST['INVOICEDATE']));
					$purchase_log->	purchase_price=$stock_response->purchaseprice;
					$purchase_log->	priceperquantity=$stock_response->priceperquantity;
					$purchase_log->	except_free_qty=$stock_response->except_free_qty;
					$purchase_log->	receivedfreequantity=$stock_response->receivedfreequantity;
					$purchase_log->	discountpercent=$stock_response->discountpercent;
					$purchase_log->	discountvalue=$stock_response->discountvalue;
					$purchase_log->	gstpercent=$stock_response->gstpercent;
					$purchase_log->	gstvalue=$stock_response->gstvalue;
					$purchase_log->	cgstpercent=$stock_response->cgstpercent;
					$purchase_log->	cgstvalue=$stock_response->cgstvalue;
					$purchase_log->	sgstpercent=$stock_response->sgstpercent;
					$purchase_log->	sgstvalue=$stock_response->sgstvalue;
					$purchase_log->	mrpperunit=$stock_response->mrpperunit;
					$purchase_log->	mrp=$stock_response->mrp;
					$purchase_log->	expiredate=date('Y-m-d',strtotime($_POST['EXPIRED_DATE'][$key]));
					$purchase_log->	purchasedate=date('Y-m-d',strtotime($_POST['INVOICEDATE']));
					$purchase_log->	updated_by=$session['user_id'];
					$purchase_log->	created_at=date('Y-m-d H:i:s');
					$purchase_log->	updated_on=date('Y-m-d H:i:s');
					$purchase_log->	updated_ipaddress=$_SERVER['REMOTE_ADDR'];
					if($purchase_log->save())
					{
						
					}
				}
				
			}
/*$stockmaster_push[]=[$branch,$_POST['PRODUCT_NAME'][$key],$_POST['VENDORNAME'],$vendor_branch['vendor_branchid'],$_POST['INVOICEBILL'],
	$product_index[$_POST['PRODUCT_NAME'][$key]]['composition_id'],$unit_id,$get_unit_id,$unit_index[$get_unit_id]['no_of_unit'],
	$total_unit,$total_unit,$_POST['BATCH_NO'][$key],date('Y-m-d',strtotime($_POST['EXPIRED_DATE'][$key])),$unitquantity,
	$quantity*$_POST['PACK_SIZE'][$key],$free_qty*$_POST['PACK_SIZE'][$key],$_POST['SUBTOTALAMOUNT'][$key],
	$_POST['TOTALAMOUNT'][$key],$_POST['RATE_PER_UNIT'][$key],date('Y-m-d H:i:s'),$session['user_id'],date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']
	];*/
		}


/*Yii::$app->db->createCommand()->batchInsert('stockmaster', ['branch_id','productid', 'vendorid','vendor_branchid','vendor_inv_no',
'compositionid','unitid','purchase_unitid','purchase_no_of_unit','purchase_qty','total_no_of_quantity','batchnumber','expiredate',
'unitquantity','quantity','free_qty','sub_total_amount','price','priceperqty','created_at','updated_by','updated_on','updated_ipaddress'],$stockmaster_push)->execute();*/		
				AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 19]);
				$stockmaster_push[0]='save';
				$stockmaster_push[1]=$autoget;
				return json_encode($stockmaster_push,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
	
}
else 
{
	$model = new Stockmaster();

	$vendor=Vendor::find()->asArray()->all();
	$vendor_map=ArrayHelper::map($vendor, 'vendorid', 'vendorid');
	
	$vendor_branch=VendorBranch::find()->where(['IN','vendorid',$vendor_map])->asArray()->all();
	$vendor_branch_index=ArrayHelper::index($vendor_branch,'vendorid');
	
	$vendor_branch_json=json_encode($vendor_branch_index, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	
	return $this->render('_newstockadd', [
            'model' => $model,
           	'vendor' => $vendor,
           	'vendor_branch_json' => $vendor_branch_json,
        ]);
}
}
	
	public function actionProductfetch()
    {
    	if($_POST)
		{
			
			$product_master=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['LIKE','productname',$_POST['query']])->all();
			
			if(!empty($product_master))
			{
				$fetch_array=array();
				foreach ($product_master as $key => $value) 
				{
					$fetch_array[]=array('productid'=>$value['productid'],'productname'=>$value['productname']);
				}
				return json_encode($fetch_array);
			}		
	
		}
	}

	public function actionProductfetchselect()
    {
    	
			
			if($_GET)
			{
				
			$product_master=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['LIKE','productname',$_GET['term']['term']])->asArray()->all();
	
			if(!empty($product_master))
			{
				$fetch_array=array();
				foreach ($product_master as $key => $value) 
				{
					$fetch_array['results'][]=array('id'=>$value['productid'],'text'=>$value['productname']);
					//$fetch_array[]='<option value='.$value['productid'].'>'.$value['productname'].'</option>';
				}
				return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			}		
			}
	}

	public function actionSingleproductfetchselect($id)
    {
    	
    	$product_master=Product::find()->select(['productid'=>'productid','productname'=>'productname','unit'=>'unit','hsn_code'=>'hsn_code','product_typeid'=>'product_typeid'])->where(['productid'=>$id])->asArray()->one();
		$unit_master=Unit::find()->where(['unitid'=>$product_master['unit']])->asArray()->one();
		$product_type=Producttype::find()->where(['product_typeid'=>$product_master['product_typeid']])->asArray()->one();
		$tax_grouping=TaxgroupingLog::find()->where(['taxgroupid'=>$product_master['hsn_code']])->andWhere(['is_active'=>1])->asArray()->one();
		
		if(!empty($product_master))
		{
			$fetch_array=array();
			$fetch_array[0]=$product_master;
			$fetch_array[1]=$unit_master;
			$fetch_array[2]=$product_type;
			$fetch_array[3]=$tax_grouping;
			
			return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		}		
			
	}
	
	public function actionPurchasebilldetails($from_date,$todate)
    {
    	
		$from_date=date('Y-m-d',strtotime($from_date));
		$todate=date('Y-m-d',strtotime($todate));
		
		
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
		
		
		
		
		$query = new Query;
		$query	->select([
        'purchase_data.id','purchase_data.bill_no','purchase_data.invoice_no','vendor.vendorname','purchase_data.invoice_date'])  
        ->from('purchase_data')
        ->join('LEFT OUTER JOIN', 'vendor',
            'purchase_data.vendor =vendor.vendorid')		
        ->where(['BETWEEN','purchase_data.invoice_date',$from_date,$todate])
        ->andWhere(['or',
		['like','purchase_data.bill_no',$s_val],
		['like','purchase_data.created_at',$s_val],
		['like','vendor.vendorname',$s_val]]
		)
        ->limit(100000)->all(); 
		$command = $query->createCommand();
		$data = $command->queryAll();
		
		$query_da = new Query;
		$query_da	->select([
        'purchase_data.id','purchase_data.bill_no','purchase_data.invoice_no','vendor.vendorname','purchase_data.invoice_date'])  
        ->from('purchase_data')
        ->join('LEFT OUTER JOIN', 'vendor',
            'purchase_data.vendor =vendor.vendorid')		
        ->where(['BETWEEN','purchase_data.created_at',$from_date.' 00:00:00',$todate.' 23:59:59'])
        ->andWhere(['or',
		['like','purchase_data.bill_no',$s_val],
		['like','purchase_data.invoice_no',$s_val],
		['like','vendor.vendorname',$s_val]]
		)
      ->limit($length)
		->offset($sfd)->all();
		$command1 = $query_da->createCommand();
		$data1 = $command1->queryAll();
		//echo '<pre>';
    	//echo $query->createCommand()->getRawSql();
		//die;
		
			
			
			if(!empty($data1))
			{
				$response=array();
				
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($query);
				foreach ($data1 as $key => $value) 
				{
					// $responce->rows[$i]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
													// 'par_relationname'=>$value['par_relationname'],'pat_mobileno'=>$value['pat_mobileno']);
					$responce['data'][]=array("DT_RowId"=>$value['id'],"purchaseno"=>$value['bill_no'],"invno"=>$value['invoice_no'],"suppliername"=>$value['vendorname'],"invoice_date"=>date('d-m-Y',strtotime($value['invoice_date'])));
					$i++;
				}
			
				return json_encode($responce);
				die;	
				
			}

			
	}

	public function actionBilldetailsfetch($id)
	{
		if($id != '')
		{
			$purchase_data=PurchaseData::find()->where(['id'=>$id])->asArray()->one();
			
			$vendor=Vendor::find()->where(['vendorid'=>$purchase_data['vendor']])->asArray()->one();
			$vendor_branch=VendorBranch::find()->where(['vendor_branchid'=>$purchase_data['vendor_branch_id']])->asArray()->one();
			
			
			$purchase_data_fetch=PurchaseLog::find()->where(['purchase_data_id'=>$id])->asArray()->all();
			
			$product_map=ArrayHelper::map($purchase_data_fetch,'purchase_id','productid');
			$product=Product::find()->where(['IN','productid',$product_map])->asArray()->all();
			$product_index=ArrayHelper::index($product,'productid');
			
if(!empty($purchase_data_fetch))
{
	$fetch_array=array();
	$tbl='';
	foreach ($purchase_data_fetch as $key => $value) 
	{
		$tbl.='<tr id="tr_fetch_table1" class="tr_fetch_table" data-id="1">';
        $tbl.='<td style="width:6%"><button type="button" onclick="Add_Grid();" class="freezed add_grid btn btn-xs btn-success" disabled>Add</button>';
        $tbl.='<button type="button" data-id="1" onclick="Del_Grid(1);" class="freezed del_grid btn btn-xs btn-success" disabled>Del</button></td>';
        $tbl.='<td style="width:18%"><div class="input-group input-group-sm product-select ">';
		$tbl.='<select id="product_name1" name="PRODUCT_NAME[]" style=" " data-id="1" class="product_name   freezed form-control tabind " disabled required="">';
        $tbl.='<option value='.$product_index[$value['productid']]['productid'].'>'.$product_index[$value['productid']]['productname'].'</option>';           	
        $tbl.='</select>'; 								  		 					 
        $tbl.='<span class="ipt input-group-btn " value=" ">';
        $tbl.='<button type="button" class="btn inp btn-default"><i class="glyphicon glyphicon-plus"></i></button></span></div></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['except_free_qty'].'" id="quantity1" data-id="1" required="" onkeypress="return isNumberKey(event);" onkeyup="Quantity(this.value,event,1);" class=" freezed quantity text-right ip-btn-style f-11" name="QUANTITY[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['receivedfreequantity'].'" id="free_quantity1" data-id="1" onkeypress="return isNumberKey(event);" onkeyup="FreeQuantity(this.value,event,1);" class=" freezed free_quantity text-right ip-btn-style f-11" name="FREE_QUANTITY[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['purchase_no_of_unit'].'" id="pack_size1" data-id="1" required="" readonly="" onkeypress="return isNumberKey(event);" class=" freezed pack_size text-right ip-btn-style f-11" name="PACK_SIZE[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['received_qty'].'" id="total_unit1" data-id="1" readonly="" required="" onkeypress="return isNumberKey(event);" class=" freezed total_unit text-right ip-btn-style f-11" name="TOTAL_UNIT[]"></td>';
        $tbl.='<td style="width:6%"><input type="text" disabled value="'.$value['priceperquantity'].'" id="rate_per_unit1" data-id="1" required="" onkeypress="return isNumberKey(event);" onkeyup="RateCalculation(this.value,event,1);" class=" freezed rate_per_unit text-right ip-btn-style f-11" name="RATE_PER_UNIT[]"></td>';
        $tbl.='<td style="width:6%"><input type="text" disabled value="'.$value['batch_number'].'"  id="batch_no1" data-id="1" required="" class=" freezed batch_no ip-btn-style f-11" name="BATCH_NO[]"></td>';
        $tbl.='<td style="width:6%"><input type="text" disabled value="'.date('d-m-Y',strtotime($value['expiredate'])).'" id="expired_date1" data-id="1" required="" onkeypress="return isNumberKey(event);" class=" freezed expired_date ip-btn-style f-11" name="EXPIRED_DATE[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['discountpercent'].'"  id="discount_percent1" data-id="1" onkeypress="return isNumberKey(event);" onkeyup="DiscountCalculation(this.value,event,1);" class=" freezed discount_percent text-right ip-btn-style f-11" name="DISCOUNT_PERCENT[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['discountvalue'].'"  id="discount_amount1" data-id="1" readonly="" onkeypress="return isNumberKey(event);" class=" freezed discount_amount text-right ip-btn-style f-11" name="DISCOUNT_AMOUNT[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['gstpercent'].'"  id="gst_percent1" data-id="1" required="" readonly="" onkeypress="return isNumberKey(event);" class=" freezed gst_percent text-right ip-btn-style f-11" name="GST_PERCENT[]"></td>';
        $tbl.='<td style="width:4%"><input type="text" disabled value="'.$value['gstvalue'].'"  id="gst_amount1" data-id="1" readonly="" onkeypress="return isNumberKey(event);" class=" freezed gst_amount text-right ip-btn-style f-11" name="GST_AMOUNT[]"></td>';
        $tbl.='<td style="width:6%"><input type="text" disabled value="'.$value['mrpperunit'].'"  id="mrp1" data-id="1" required="" onkeypress="return isNumberKey(event);" onkeyup="MRPCalculation(this.value,event,1);" onblur="MRPCalculation(this.value,event,1);" class=" freezed mrp ip-btn-style text-right f-11" name="MRP[]"></td>';
        $tbl.='<td style="width:6%"><input type="text" disabled value="'.$value['purchase_price'].'"  id="total_amount1" data-id="1" required="" readonly="" onkeypress="return isNumberKey(event);" class=" freezed total_amount text-right ip-btn-style f-11" name="TOTALAMOUNT[]">';
        $tbl.='<input type="hidden" id="sub_total_amount1" data-id="1" class="sub_total_amount text-right ip-btn-style f-11" name="SUBTOTALAMOUNT[]"></td></tr>';
    	
	}

	
	$fetch_array[0]=$tbl;
	$fetch_array[1]=$purchase_data;
	$fetch_array[2]=$vendor;
	$fetch_array[3]=$vendor_branch;
	
	return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}
		}
	}
	
	
	
	public function actionProductdetails()
    {
    	
		
		
    	$sfd=0;
    	if(isset($_POST['start']) && $_POST['start']!="0"){
    		$sfd=$_POST['start'];
    	}
    	$draw=0;
		if(isset($_POST['draw']) && $_POST['draw']!=""){
		  $draw=$_POST['draw'];
		}
		$length=10;
		if(isset($_POST['length']) && $_POST['length']!=""){
		  $length=$_POST['length'];
		}
		$s_val='';
		if(isset($_POST['search'])){
		  $s_val=$_POST['search']['value'];
		}
		
		
		
		
		$query = new Query;
		$query	->select([
        'product.productid','product.productname','product.product_typeid','product.hsn_code','producttype.product_typeid','producttype.product_type','taxgrouping_log.taxgroupid','taxgrouping_log.tax'])  
        ->from('product')
        ->join('LEFT OUTER JOIN', 'producttype',
            'product.product_typeid =producttype.product_typeid')
		->join('LEFT OUTER JOIN', 'taxgrouping_log',
            'product.hsn_code =taxgrouping_log.taxgroupid')
					
        ->where(['taxgrouping_log.is_active'=>'1'])
        ->where(['or',
		['like','product.productname',$s_val],
		['like','producttype.product_type',$s_val],
		['like','taxgrouping_log.tax',$s_val]]
		)
        ->limit(100000)->all(); 
		$command = $query->createCommand();
		$data = $command->queryAll();
		
		//echo $query->createCommand()->sql;
		
		$query_da = new Query;
		$query_da	->select([
        'product.productid','product.productname','product.product_typeid','product.hsn_code','producttype.product_typeid','producttype.product_type','taxgrouping_log.taxgroupid','taxgrouping_log.tax'])  
        ->from('product')
        ->join('LEFT OUTER JOIN', 'producttype',
            'product.product_typeid =producttype.product_typeid')
		->join('LEFT OUTER JOIN', 'taxgrouping_log',
            'product.hsn_code =taxgrouping_log.taxgroupid')
					
        ->where(['taxgrouping_log.is_active'=>'1'])
        ->where(['or',
		['like','product.productname',$s_val],
		['like','producttype.product_type',$s_val],
		['like','taxgrouping_log.tax',$s_val]]
		)
         ->limit($length)
		->offset($sfd)->all();
		$command1 = $query_da->createCommand();
		$data1 = $command1->queryAll();
		
		
			$response=array();
			
			if(!empty($data1))
			{
				$fetch_array=array();
				$i=0;
				$responce['draw']=$draw;
				$responce['recordsTotal']= $length;
				$responce['recordsFiltered']= count($data);
				foreach ($data1 as $key => $value) 
				{
					// $responce->rows[$i]=array('mr_no'=>$value['mr_no'],'patientname'=>$value['patientname'],
													// 'par_relationname'=>$value['par_relationname'],'pat_mobileno'=>$value['pat_mobileno']);
					$responce['data'][]=array("DT_RowId"=>$value['productid'],"productname"=>$value['productname'],"producttype"=>$value['product_type'],"gst"=>$value['tax']);
					$i++;
				}
			
				return json_encode($responce);
			die;
				
			}

			
	}
	
	public function actionProductdetailsfetch()
    {
    	
		
    	
	}
	
	
}