<?php
namespace backend\controllers;
use Yii;
use backend\models\Product;
use backend\models\Unit;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\Producttype;
use backend\models\Composition;
use backend\models\BranchAdmin;
use backend\models\Manufacturermaster;
use backend\models\Taxgrouping;
use backend\models\Taxmaster;
use backend\models\TaxgroupingLog;
use yii\data\Pagination;

class ProductController extends Controller
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
    	if (isset($_GET['pageSize'])) 
    	{
                   Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
   		}
		
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$items = ArrayHelper::map(Producttype::find()->all(), 'product_typeid', 'product_type');
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'pages' => $pages,
            
            'items'=>$items,
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
        	$model = new Product();
		    $items = ArrayHelper::map(Producttype::find()->where(['is_active'=>'1'])->all(), 'product_typeid', 'product_type');
			$composition = ArrayHelper::map(Composition::find()->where(['is_active'=>'1'])->all(), 'composition_id', 'composition_name');
			$unit = ArrayHelper::map(Unit::find()->where(['is_active'=>'1'])->all(), 'unitid', 'unitvalue');
			$manufacturerlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$taxgrouping_map=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
			
			$taxgrouping_index=ArrayHelper::index(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid');
			
			$taxgrouping=Taxgrouping::find()->where(['is_active'=>1])->asArray()->all();
			
			$tax_hsn_code=array();
			if(!empty($taxgrouping))
			{
				foreach ($taxgrouping as $key => $value) 
				{
					$tax_hsn_code[$value['taxgroupid']]=$value['hsncode'].' - (GST '.$value['tax'].' )';
							
				}
				
			}
			
			$product_max = Product::find()->max('productid');
			$product_max=$product_max+1;

        if ($model->load(Yii::$app->request->post()))
		 {
		 	
				$productname=trim(ucwords(Yii::$app->request->post('Product')['productname']));
				$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model->updatedon=date("Y-m-d H:i:s");
				$model->updatedby=$session['user_id'];
				$model->productname=$productname;
				
				$model->product_typeid=$_POST['Product']['product_typeid'];
				$model->hsn_code=$_POST['Product']['hsn_code'];
				$model->gst=$taxgrouping_index[$_POST['Product']['hsn_code']]['tax'];
				$model->composition_id=$_POST['Product']['composition_id'];
				
				//Unit ID Inserted
				$model->unit=$_POST['Product']['unit'];
				
				$model->manufacturer_id=$_POST['Product']['manufacturer_id'];
				$model->minstock=$_POST['Product']['minstock'];
				$model->maxstock=$_POST['Product']['maxstock'];
				$model->reorderlevelstock=$_POST['Product']['reorderlevelstock'];
				$model->sort_description=$_POST['Product']['sort_description'];
				$model->product_code=$_POST['Product']['product_code'];
				$model->is_active=$_POST['Product']['is_active'];
				//$model->pack_size=$_POST['Product']['pack_size'];
				
				//Unit ID Inserted
				$model->unit=$_POST['Product']['unit'];
				
				if($model->save())
				{
					Yii::$app->getSession()->setFlash('success','Product Added successfully');
					return $this->redirect(['index']);
				}
				else 
				{
					print_r($model->getErrors());die;
					Yii::$app->getSession()->setFlash('error','Product Already Been Taken');
					return $this->render('create',[
			    		'model' => $model, 'items'=>$items,  'composition'=>$composition, 'product_max'=>$product_max, 'unit'=>$unit, 'manufacturerlist'=>$manufacturerlist,'taxgrouping'=>$taxgrouping
			  			,'tax_hsn_code' => $tax_hsn_code,
			      ]);
				}	
			
			
		 }
         else 
         {
			      return $this->render('create',[
			    		'model' => $model, 'items'=>$items,  'composition'=>$composition, 'product_max'=>$product_max, 'unit'=>$unit, 'manufacturerlist'=>$manufacturerlist,'taxgrouping'=>$taxgrouping
			    		,'tax_hsn_code' => $tax_hsn_code,
				
				  ]);
         }
    }



  
    public function actionUpdate($id)
    {
            $model = $this->findModel($id);
			
			
			$unit_prime_id=$model->unit;
		   
		    $items = ArrayHelper::map(Producttype::find()->where(['is_active'=>'1'])->all(), 'product_typeid', 'product_type');
			$composition = ArrayHelper::map(Composition::find()->where(['is_active'=>'1'])->all(), 'composition_id', 'composition_name');
			$unit = ArrayHelper::map(Unit::find()->where(['is_active'=>'1'])->all(), 'unitid', 'unitvalue');
			$manufacturerlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$taxgrouping_map=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
			
			$taxgrouping_index=ArrayHelper::index(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid');
			
			$taxgrouping=Taxgrouping::find()->where(['is_active'=>1])->asArray()->all();
			
			$tax_hsn_code=array();
			if(!empty($taxgrouping))
			{
				foreach ($taxgrouping as $key => $value) 
				{
					$tax_hsn_code[$value['taxgroupid']]=$value['hsncode'].' - (GST '.$value['tax'].' )';
							
				}
				
			}
			
			
	        if ($model->load(Yii::$app->request->post()))
			{
		 			
		 		$productname=trim(ucwords(Yii::$app->request->post('Product')['productname']));
				$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model->updatedon=date("Y-m-d H:i:s");
				$model->updatedby=$session['user_id'];
				$model->productname=$productname;
				
				$model->product_typeid=$_POST['Product']['product_typeid'];
				$model->hsn_code=$_POST['Product']['hsn_code'];
				$model->gst=$_POST['Product']['gst'];
				$model->composition_id=$_POST['Product']['composition_id'];
				
				//Unit ID Inserted
				$model->unit=$_POST['Product']['unit'];
				
				$model->manufacturer_id=$_POST['Product']['manufacturer_id'];
				$model->minstock=$_POST['Product']['minstock'];
				$model->maxstock=$_POST['Product']['maxstock'];
				$model->reorderlevelstock=$_POST['Product']['reorderlevelstock'];
				$model->sort_description=$_POST['Product']['sort_description'];
				$model->product_code=$_POST['Product']['product_code'];
				$model->is_active=$_POST['Product']['is_active'];
				
			
				if($model->save())
				{
					
					Yii::$app->getSession()->setFlash('success','Product Updated successfully');
					return $this->redirect(['index']);
				}
				else {
					Yii::$app->getSession()->setFlash('error','Product Already Been Taken');
					return $this->render('create',[
			    		'model' => $model, 'items'=>$items,  'composition'=>$composition, 'product_max'=>$product_max, 'unit'=>$unit, 'manufacturerlist'=>$manufacturerlist,'taxgrouping'=>$taxgrouping,'tax_hsn_code'=>$tax_hsn_code,
			      ]);
				}
			} 
		 else {
		      return $this->render('create', [
    'model' => $model, 'items'=>$items,  'composition'=>$composition, 'product_max'=>$product_max, 'unit'=>$unit, 'manufacturerlist'=>$manufacturerlist,'taxgrouping'=>$taxgrouping,'tax_hsn_code'=>$tax_hsn_code,
            ]);
        }
    }

 
      public function actionGetunit($id)
    {
    	
		$rows = Unit::find()->where(['is_active'=>'1'])->andwhere(['unitname'=>$id])->all();
	
	echo "<option value=''>--Select Unit--</option>";
	  if(count($rows)>0){
            foreach($rows as $row){
            	echo "<option value='$row->unitid'>$row->unitvalue</option>";
			
            }
        }
        else{
            echo "<option>Unit Not Available for this Product.</option>";
        }
	

	}
	
	public function actionGetgst($id)
    {
    	
		$tax_log=TaxgroupingLog::find()->where(['taxgroupid'=>$id])->andWhere(['is_active'=>'1'])->asArray()->one();
	
		if(!empty($tax_log))
		{
			echo $tax_log['tax']+$tax_log['additional_tax'];
		}
	}
     
    public function actionDelete($id)
    {
			     /*  $del= $this->findModel($id);
			if($del->delete()){
				echo "Y";
			}*/
			$this->findModel($id)->delete();

        return $this->redirect(['index']);
      
    }

	public function actionBulkdelete(){
 	
   
    $selection=(array)Yii::$app->request->post('selection');
	//print_r($selection);
	foreach($selection as $id){
		$this->findModel($id)->delete();
	}	
	return "Y";
    }

 	
 	
 	
 	
	 public function actionCreateproduct()
    {
        $model = new Composition();

        if ($model->load(Yii::$app->request->post())) {
        	$model->composition_name=trim(ucwords(Yii::$app->request->post('Composition')['composition_name']));
        	$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$agestart=Yii::$app->request->post('Composition')['agestart'];
			$ageend=Yii::$app->request->post('Composition')['age_end'];
			$model->agestart=$agestart;
			$model->age_end=$ageend;
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($agestart<$ageend)
			{
			if($model->save()){
				$fetch_array[0]="Y";
				$fetch_array[1]=ArrayHelper::index(Composition::find()->select(['composition_id'=>'composition_id','composition_name'=>'composition_name'])->where(['is_active'=>1])->asArray()->all(), 'composition_id');
				return json_encode($fetch_array);	
			}else{
				//print_r($model->getErrors());die;
				//echo "N";
				$fetch_array[0]="N";
				return json_encode($fetch_array);
			}	
			}
			else{
				$fetch_array[0]="W";
				return json_encode($fetch_array);
				//echo "W";
			}
			
           
        } 
        
        
        else {
            return $this->renderAjax('createcomposition', [ 'model' => $model, ]);
        }
    }
	
	
	public function actionCreatemanufacturer()
    {
    	$model = new Manufacturermaster();
		if (Yii::$app->request->post()) 
	    {
	    	 $session = Yii::$app->session;
		     $manufacturername=trim(ucwords(Yii::$app->request->post('Manufacturermaster')['manufacturer_name']));
			 $manufacturerdescription=trim(Yii::$app->request->post('Manufacturermaster')['manufacturer_description']);
			 $model->updatedby=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updatedon=date("Y-m-d H:i:s");
			 $model->manufacturer_name=$manufacturername;
			 $model->manufacturer_description=$manufacturerdescription;
			 $model->is_active=Yii::$app->request->post('Manufacturermaster')['is_active'];
			 
			 if($model->save())   
			 {
			 	$fetch_array[0]="S";
				$fetch_array[1]=ArrayHelper::index(Manufacturermaster::find()->select(['id'=>'id','manufacturer_name'=>'manufacturer_name'])->where(['is_active'=>1])->asArray()->all(), 'id');
				return json_encode($fetch_array);	
			 }
             else 
             {
             	$fetch_array[0]="N";
             	return json_encode($fetch_array);
			 }
        }
        else 
        {
        	return $this->renderAjax('createmanufacturer', ['model' => $model ]);
        }
    }
	
	
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
   	public function actionPrint()
    {
    					    ini_set('memory_limit', '-1');
							$product=Product::find()->where(['is_active'=> '1'])->orderBy(['product_typeid'=>SORT_ASC])->asArray()->all();
							
							//Product Type Fetch
							$product_type_map = ArrayHelper::map($product, 'productid', 'product_typeid');
							$product_type_in = Producttype::find()->where(['IN','product_typeid',$product_type_map])->asArray()->all(); 
							$product_type_index=ArrayHelper::index($product_type_in,'product_typeid');
							
							//composition Fetch
							$composition_map = ArrayHelper::map($product, 'productid', 'composition_id');
							$composition_type_in = Composition::find()->where(['IN','composition_id',$composition_map])->asArray()->all(); 
							$composition_type_index=ArrayHelper::index($composition_type_in,'composition_id');
							
							//manufacturer Fetch
							$manufacturer_map = ArrayHelper::map($product, 'productid', 'manufacturer_id');
							$manufacturer_in = Manufacturermaster::find()->where(['IN','id',$manufacturer_map])->asArray()->all(); 
							$manufacturer_index=ArrayHelper::index($manufacturer_in,'id');
							
							//Unit Fetch
							$unit_map = ArrayHelper::map($product, 'productid', 'unit');
							$unit_in = Unit::find()->where(['IN','unitid',$unit_map])->asArray()->all(); 
							$unit_index=ArrayHelper::index($unit_in,'unitid');
							
							
							//Total Code
							$filter_prd=array();
							foreach ($product as $key => $value) 
							{
								$filter_prd[]=$value['product_typeid'];	
							}
							$filter_prd_rem=array_unique($filter_prd);
							
							//Value Product
							$val_product='';
							
							//Value Product Array
							$fill_value_product=array();
							$prd_inc=0;
							foreach ($filter_prd_rem as $key => $value) 
							{
								$product_all=Product::find()->where(['is_active'=> '1'])->andWhere(['product_typeid'=>$value])->asArray()->all();
								$fill_value_product[]=count($product_all);
							}
							
							
						if(!empty($product))
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
								$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
								$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
								$pdf->setFontSubsetting(true);
								//$pdf->SetFont('helvetica', '', 8, '', true);
								//$fontname = $pdf->addTTFfont('/path-to-font/FontName.ttf', 'TrueTypeUnicode', '', 96);
								
								$pdf->SetFont('Times', '', 14, '', false);
								
								
								
								
								$pdf->AddPage("L");
								
								$tbl1='<html><body>
								<div><h2 style="text-align:center;color:red;">Dinesh Medical Center</h2>';
							
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
								$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">PRODUCT REPORT</p>';
								$tbl1.='<p style="border-top:1px solid #000;"></p>';
								
								$tbl1.='</div>';
								
								$tbl1.='<table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
								$tbl1.='<tr>
						                  <td  ><b>SNo</b></td>
						                  <td width="15%" ><b>Product Name</b></td>
						                  <td width="14%"><b>Product Code</b></td>
						                  <td width="13%" ><b>HSN Code</b></td>
						                  <td width="14%" ><b>GST</b></td>
						                  <td width="14%" ><b>Unit Type</b></td>
						               </tr></table><hr>';
									   
								$tyu=$product[0]['product_typeid'];		   
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                  <td  width="100%" style="font-size:12px;color:red;" >'.$product_type_index[$tyu]['product_type'].'</td>
							               </tr></table>';
								
								$sno=1;
								$prd_type_val=0;
								foreach ($product as $key => $value) 
								{
									$order_id=$value['product_typeid'];
									if($order_id == $tyu)
									{
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                  <td  width="100%" style="font-size:10px;color:green;" >Composition Name:'.$composition_type_index[$value['composition_id']]['composition_name'].'</td>
							               </tr></table>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                  <td  width="100%" style="font-size:10px;color:blue;" >Manufacturer Name:'.$manufacturer_index[$value['manufacturer_id']]['manufacturer_name'].'</td>
							               </tr></table>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
										$tbl1.='<tr>
										
						                 
										  <td  >'.$sno.'</td>
						                  <td  width="15%">'.$value['productname'].'</td>
						                  
						                  
						                  <td width="14%">'.$value['product_code'].'</td>
						                  <td width="13%" >'.$value['hsn_code'].'</td>
						                  <td  width="14%"  >'.$value['gst'].'</td>
						                  <td width="14%"  >'.$unit_index[$value['unit']]['unitvalue'].'</td>
						               </tr></table>';
							        }
									else if($order_id != $tyu)
									{
										
										
										$tyu=$value['product_typeid'];
										
										$tbl1.='<hr>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                 <td  width="100%" style="font-size:14px;color:purple;" ><b>Total: '.$fill_value_product[$prd_type_val].'</b></td>
							               </tr></table>';
										$tbl1.='<hr>';   
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                 <td  width="100%" style="font-size:12px;color:red;" >'.$product_type_index[$value['product_typeid']]['product_type'].'</td>
							               </tr></table>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                  <td  width="100%" style="font-size:10px;color:green;" >Comp Name:'.$composition_type_index[$value['composition_id']]['composition_name'].'</td>
							               </tr></table>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                  <td  width="100%" style="font-size:10px;color:blue;" >Manu Name:'.$manufacturer_index[$value['manufacturer_id']]['manufacturer_name'].'</td>
							               </tr></table>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
										$tbl1.='<tr>
						                  <td >'.$sno.'</td>
						                  <td  width="15%">'.$value['productname'].'</td>
						                  <td width="14%">'.$value['product_code'].'</td>
						                  <td  width="13%">'.$value['hsn_code'].'</td>
						                  <td  width="14%">'.$value['gst'].'</td>
						                  <td  width="14%">'.$unit_index[$value['unit']]['unitvalue'].'</td>
						               </tr></table>';
									   $prd_type_val++;
									}
									$sno++;	
								}

									$tbl1.='<hr>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							                 <td  width="100%" style="font-size:14px;color:purple;" ><b>Total: '.end($fill_value_product).'</b></td>
							               </tr></table>';
										$tbl1.='<hr>';
										
										$tbl1.='<hr>';
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
							               <tr>
							               	
							                 <td  width="100%" style="font-size:14px;color:red;" ><b>Grand Total: '.array_sum($fill_value_product).'</b></td>
							               </tr></table>';
										$tbl1.='<hr>';
									
										   
									$tbl1.='</body></html>'; 
									
									
						
									
									  
								  //error_reporting(0);
								$pdf->writeHTML($tbl1, true, false, false, false, '');
				    			$pdf->Output('example_001.pdf');
								
								die;
				    	}
	}
   
    
    public function actionExcel()
    {
    		$objPHPExcel = new \PHPExcel();
						
						
		$styleArray = array(
				    	'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	));
				
				
								$styleArray5 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'ffe88c',
						        ),
						        ),
						      
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				        'wrap' => true
				    	),
						        
								
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);	
				
				
				
					$styleArray6 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						     
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				       // 'wrap' => true
				    	),
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray7 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
	$styleCalibri = array(
				   	'font'  => array(
				       // 'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	),
				    	
					
						        
									'alignment' => array(
				      //  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);	
				
				
				
							$styledotted = array(
				  
						 'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
									'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       //'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);
							
							
							$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'f78f8f',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
							
							$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				
							$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("Product Report")	
						-> setCellValue('A1', 'SNO')
						-> setCellValue('B1', 'Product Type')
						-> setCellValue('C1', 'Product Name')
						-> setCellValue('D1', 'Composition Name')
						-> setCellValue('E1', 'Manufacturer Name')
						-> setCellValue('F1', 'Product Code')
						-> setCellValue('G1', 'HSN Code')
						-> setCellValue('H1', 'GST')
						-> setCellValue('I1', 'Unit Type')
						-> setCellValue('J1', 'Short Description');
						
							$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray7);
						
							$product=Product::find()->where(['is_active'=> '1'])->orderBy(['product_typeid'=>SORT_ASC])->asArray()->all();
							
							//Product Type Fetch
							$product_type_map = ArrayHelper::map($product, 'productid', 'product_typeid');
							$product_type_in = Producttype::find()->where(['IN','product_typeid',$product_type_map])->asArray()->all(); 
							$product_type_index=ArrayHelper::index($product_type_in,'product_typeid');
							
							//composition Fetch
							$composition_map = ArrayHelper::map($product, 'productid', 'composition_id');
							$composition_type_in = Composition::find()->where(['IN','composition_id',$composition_map])->asArray()->all(); 
							$composition_type_index=ArrayHelper::index($composition_type_in,'composition_id');
							
							//manufacturer Fetch
							$manufacturer_map = ArrayHelper::map($product, 'productid', 'manufacturer_id');
							$manufacturer_in = Manufacturermaster::find()->where(['IN','id',$manufacturer_map])->asArray()->all(); 
							$manufacturer_index=ArrayHelper::index($manufacturer_in,'id');
							
							//Unit Fetch
							$unit_map = ArrayHelper::map($product, 'productid', 'unit');
							$unit_in = Unit::find()->where(['IN','unitid',$unit_map])->asArray()->all(); 
							$unit_index=ArrayHelper::index($unit_in,'unitid');
							
							//Tax HSN Code Fetch
							$tax_grouping_map = ArrayHelper::map($product, 'productid', 'hsn_code');
							$tax_grouping_in = Taxgrouping::find()->where(['IN','taxgroupid',$tax_grouping_map])->asArray()->all(); 
							$tax_group_index=ArrayHelper::index($tax_grouping_in,'taxgroupid');
							
							$tyu=$product[0]['product_typeid'];
							
							$all_post_key = array("SNO","Product_type", "Product_name", "Comp_name", "Manu_name", "Product_code","HSN_code","GST", "Unit", "Short_desc");
							
							$slno=1;
							$row = 3;
							
							$machine_row=2;
							if(isset($product_type_index[$tyu]))
							{
								$product_type_initial=$product_type_index[$tyu]['product_type'];
								$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $machine_row, 'Product Type : '.$product_type_initial);
								$objPHPExcel->getActiveSheet()->getStyle('A' . $machine_row.':'.'J' . $machine_row)->applyFromArray($styleArray8);
								
							} 
							
							//Total Code
							$filter_prd=array();
							foreach ($product as $key => $value) 
							{
								$filter_prd[]=$value['product_typeid'];	
							}
							$filter_prd_rem=array_unique($filter_prd);
							
							//Value Product
							$val_product='';
							
							//Value Product Array
							$fill_value_product=array();
							$prd_inc=0;
							foreach ($filter_prd_rem as $key => $value) 
							{
								$product_all=Product::find()->where(['is_active'=> '1'])->andWhere(['product_typeid'=>$value])->asArray()->all();
								
								$fill_value_product[]=count($product_all);							
							
							}
							
							
							foreach($product as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								$order_id=$one_data['product_typeid'];
								if($order_id == $tyu)
								{
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
								
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="Product_type")
		    				 				{
		    				 					if(isset($product_type_index[$one_data['product_typeid']]))
												{
													$product_type_value=$product_type_index[$one_data['product_typeid']]['product_type'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_type_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Product_name")
		    				 				{
		    				 					if(isset($one_data['productname']))
												{
													$product_value=$one_data['productname'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Comp_name")
		    				 				{
		    				 					if(isset($composition_type_index[$one_data['composition_id']]))
												{
													$composition_value=$composition_type_index[$one_data['composition_id']]['composition_name'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $composition_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Manu_name")
		    				 				{
		    				 					if(isset($manufacturer_index[$one_data['manufacturer_id']]))
												{
													$manufacturer_value=$manufacturer_index[$one_data['manufacturer_id']]['manufacturer_name'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $manufacturer_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
		        							else if($one_field=="Product_code")
		    				 				{
		    				 					if(isset($one_data['product_code']))
												{
													$product_code_value=$one_data['product_code'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_code_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="HSN_code")
		    				 				{
		    				 					if(isset($tax_group_index[$one_data['hsn_code']]['hsncode']))
												{
													$product_hsn_value=$tax_group_index[$one_data['hsn_code']]['hsncode'];
													if($product_hsn_value != '')
													{
														$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_hsn_value);
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
													}
													else
													{
														$code='-';
														$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $code);
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);	
													}
													
												} 
		       									
		        							}
											else if($one_field=="GST")
		    				 				{
		    				 					if(isset($one_data['gst']))
												{
													$product_gst_value=$one_data['gst'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_gst_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Unit")
		    				 				{
		    				 					if(isset($unit_index[$one_data['unit']]))
												{
													$product_unit_value=$unit_index[$one_data['unit']]['unitvalue'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_unit_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Short_desc")
		    				 				{
		    				 					if(isset($one_data['sort_description']))
												{
													$product_short_value=$one_data['sort_description'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_short_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								else if($order_id != $tyu) 
								{
									$tyu=$one_data['product_typeid'];
									
									$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row, 'Total');
									$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $fill_value_product[$prd_inc]);
									$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'J' . $row)->applyFromArray($styleArray5);
									
									$prd_inc++;
									$row++;	
									if(isset($product_type_index[$tyu]))
									{
										$product_type_initial=$product_type_index[$tyu]['product_type'];
										$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row, 'Product Type : '.$product_type_initial);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'J' . $row)->applyFromArray($styleArray8);
									} 
									
									
									$row++;	
									
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
								
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=='SNO')
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="Product_type")
		    				 				{
		    				 					if(isset($product_type_index[$one_data['product_typeid']]))
												{
													$product_type_value=$product_type_index[$one_data['product_typeid']]['product_type'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_type_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Product_name")
		    				 				{
		    				 					if(isset($one_data['productname']))
												{
													$product_value=$one_data['productname'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Comp_name")
		    				 				{
		    				 					if(isset($composition_type_index[$one_data['composition_id']]))
												{
													$composition_value=$composition_type_index[$one_data['composition_id']]['composition_name'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $composition_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Manu_name")
		    				 				{
		    				 					if(isset($manufacturer_index[$one_data['manufacturer_id']]))
												{
													$manufacturer_value=$manufacturer_index[$one_data['manufacturer_id']]['manufacturer_name'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $manufacturer_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
		        							else if($one_field=="Product_code")
		    				 				{
		    				 					if(isset($one_data['product_code']))
												{
													$product_code_value=$one_data['product_code'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_code_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="HSN_code")
		    				 				{
		    				 					if(isset($one_data['hsn_code']))
												{
													$product_hsn_value=$one_data['hsn_code'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_hsn_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="GST")
		    				 				{
		    				 					if(isset($one_data['gst']))
												{
													$product_gst_value=$one_data['gst'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_gst_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Unit")
		    				 				{
		    				 					if(isset($unit_index[$one_data['unit']]))
												{
													$product_unit_value=$unit_index[$one_data['unit']]['unitvalue'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_unit_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
											else if($one_field=="Short_desc")
		    				 				{
		    				 					if(isset($one_data['sort_description']))
												{
													$product_short_value=$one_data['sort_description'];
													$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_short_value);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												} 
		       									
		        							}
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;						
										}
										$r_a++;
									}
									
								}
								$slno++;			
								$row++;
							
							}
							
							$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row, 'Total');
							$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, end($fill_value_product));
							$objPHPExcel -> getActiveSheet() -> getStyle('A' .$row.':'.'J'.$row) -> applyFromArray($styleArray5);
							
							
						//Grant Total Element
						$row_total_final=$row+1;
						$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row_total_final, 'Grant Total');
						$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row_total_final, array_sum($fill_value_product));
						$objPHPExcel -> getActiveSheet() -> getStyle('A' .$row_total_final.':'.'J'.$row_total_final) -> applyFromArray($styleArray6);
						
							
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						header('Content-Type: application/vnd.ms-excel');
				        $filename = "Product Report".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
						
							
	}
}
