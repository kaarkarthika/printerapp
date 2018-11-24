<?php

namespace backend\controllers;

use Yii;
use backend\models\Salesreturn;
use backend\models\SalesreturnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Sales;
use backend\models\SalesSearch;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\Patienttype;
use backend\models\Patient;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\PatientSearch;
use backend\models\Stockmaster;
use backend\models\Vendor;
use backend\models\Stockrequest;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Product;
use backend\models\Returndetail;
use backend\models\Unit;
use backend\models\Composition;
use backend\models\CompanyBranch;
use backend\models\Saledetail;
use backend\models\BranchAdmin;
use backend\models\SaledetailSearch;
use backend\models\Productgrouping;
use backend\models\Producttype;
use backend\models\Insurance;
use backend\models\company;
use backend\models\AutoidTable;
		
	


/**
 * SalesreturnController implements the CRUD actions for Salesreturn model.
 */
class SalesreturnController extends Controller
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


    /**
     * Lists all Salesreturn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesreturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	 public function actionPatientindex()
    {
        $searchModel=new SalesSearch();
		$model=new Sales();
		$dataProvider=$searchModel->customsearch(Yii::$app->request->queryParams);
        return $this->render('patientindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }
		public function actionSavesalesreturn()
    {
    	
		$model = new Salesreturn();
	

     	if($_POST){
			
     		 $salesdata=Sales::find()->where(['opsaleid'=>$id])->one();
			 
			  $returndatainc=	Salesreturn::find()->orderBy(['return_id' => SORT_DESC])->one();
  $returnincrement=$returndatainc->returnincrement+1;
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
			$model->returnincrement=$returnincrement;
			$model->patient_type=$pt;
			$model->mrnumber=Yii::$app->request->post('Salesreturn')['mrnumber'];
			$session = Yii::$app->session;
			$model->is_active=1;
	        $model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->branch_id=$session['branch_id'];
			$model->total=Yii::$app->request->post('totalprice');
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
			$model->paid_status="UnPaid";
				$model->updated_on=date("Y-m-d H:i:s");
		  $model->saleid=Yii::$app->request->post('saleid');
		  $model->returndate=date('Y-m-d h:i:s');
		 $patientdata=Patient::find()->where(['medicalrecord_number'=>Yii::$app->request->post('Salesreturn')['mrnumber']])->one();
		 $model->name=$patientdata->firstname." ".$patientdata->lastname;
			
			
			
			
			if($model->save()){
				$returnid=$model->return_id;
				$i=1;
				$productid=Yii::$app->request->post('productid');
				foreach ($productid as $key => $value)
				 {
				 	
				$product=Product::find()->where(['productid'=>$value])->one(); 	
				$model1 = new Returndetail();
				$model1->return_id=$returnid;
				$model1->returndate=date('Y-m-d h:i:s');
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
				if($model1->save()){}
				else{$model1->getErrors();die;}
				
				++$i;
				
				}
			
					echo"Y=".$returnid;
			}
			 }

  
		
	}
	
	 public function actionPatientdetails($id)
    {
    	  
		   $productlist="";
$rows = Saledetail::find()->where(['opsaleid'=>$id])->all();
$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
	$model = new Salesreturn();
	$saledetailmodel = new Saledetail();
	
	
	echo $this->renderAjax('saledetailform', [
	'model' => $model,
	'id' => $id,
	'companylist'=>$companylist,
	'productlist'=>$productlist,
	'saledetailmodel'=>$saledetailmodel,
	'searchModel'=>$searchModel,
	'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,
	'unitlist'=>$unitlist,
	
	]);

	}



	public function actionProductdetails()
	{
	$model = new Returndetail();

	$productid=Yii::$app->request->post(
'Stockrequest')['productid'];
		$branch=Yii::$app->request->post('Stockrequest')['branch_id'];
	if($productid!=""){
		
	 // echo $this->renderAjax('productdetail', [
                // 'model' => $model,
                 // 'productid'=>$productid,
                 // 'branch'=>$branch,
            // ]);
 $form = ActiveForm::begin();
				echo '<table id="datatable-buttons" class="table table-striped table-bordered">
				<thead>
				<tr>
				<th>#</th>
				<th>Product</th>
				<th>Composition</th>

				<th>Sale Quantity</th>
				<th>Unit</th>
				<th>Return Quantity</th>
				<th>Price/Qty</th>
				<th>Total Price</th>
				</tr>
				</thead>
				<tbody>';

				
				$i=1;
				$vendor_name=
			"";
		$product_name="";
		$rows="";
		foreach ($productid as $key => $value) {
				
		
			$product_name=Product::find()->where(['productid'=>$value])->one();
			$composition=Composition::find()->where(['composition_id'=>$product_name->composition_id])->one();
			$unitlist=Unit::find()->where(['unitid'=>$product_name->unit])->one();
			$salelist=Saledetail::find()->where(['productid'=>$value])->one();
			 $rows = Stockmaster::find()->where(['productid'=>$value])->andwhere(['branch_id'=>$branch])->andwhere(['is_active'=>1])->one();?>
<tr><td><?php echo $i;?></td>  <td><?php echo $product_name->productname;?></td>
<td><?php echo $composition->composition_name;
echo $form->field($model, 'compositionid[]')->hiddenInput(['value'=>$composition->composition_id])->label(false);?></td>
 
 <td style="text-align:right;"><?php echo $salelist->productqty;?></td>
 <td><?php echo $unitlist->unitvalue;
 echo $form->field($model, 'unitid[]')->hiddenInput(['value'=>$unitlist->unitid])->label(false);?></td>
 <td style="text-align:right;"><?php echo $form->field($model, 'productqty[]')->textInput(['name'=>'productqty'.$i,'id'=>'productqty'.$i,'required'=>true,'class'=>'form-control productqty','datacls'=>'calcprice'.$i,'dataprice'=>$rows->priceperqty])->label(false);?></td>
<td  ><?php echo $form->field($model, 'priceperqty[]')->textInput(['class'=>'form-control priceperqty','readonly'=>'true','style'=>"text-align:right;",'value'=>$rows->priceperqty,'datacls'=>'calcprice'.$i,'dataprice'=>$rows->priceperqty])->label(false);?></td>
<td style="text-align:right;"><?php echo $form->field($model, 'price[]')->textInput(['id'=>'calcprice'.$i.'1','class'=>'form-control pricez','style'=>"text-align:right;",'readonly'=>true,])->label(false);?></td>
</tr><?php $i++;
		}

echo '<td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;" >Total</td><td style="text-align:right;"><span id="total">0</span><input  type="hidden" id="totalprice" name="totalprice" /></td>
		</tbody> 
		</table>';
 ActiveForm::end(); 
		 
	}	
	}



    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Salesreturn();

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->return_id]);
        }  else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->return_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionReturnproductdetail($id,$autonumber)
    {
       
		

       return $this->renderAjax('returnproductdetail', [
	'model' => $model,
	'id' => $id,
	'autonumber'=>$autonumber,
	
	
	]);
    }
	
	
	 public function actionReturnproductdetailupdate($id,$autonumber)
    {
       
		

       return $this->renderAjax('returnproductdetailupdate', ['model' => $model,'id' => $id,'autonumber'=>$autonumber]);
    }
	
	public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	

    public function actionGetproduct($id)
    {
    	
		 $rows = Stockmaster::find()->where(['vendorid' => $id])->andwhere(['is_active'=>1])->all();
	
        if(count($rows)>0){
            foreach($rows as $row){
				 $rows1 = Product::find()->where(['productid' => $row->productid])->one();
				if($rows1->productid!=""){
                echo "<option value='$rows1->productid'>$rows1->productname</option>";
				}
				
            }
        }
        else{
            echo "<option>Product Not Available for this Vendor.</option>";
        }
		
	}
    protected function findModel($id)
    {
        if (($model = Salesreturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionInvoice1($id) {
   
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


$saledata=Salesreturn::find()->where(['return_id'=>$id])->one();
$saledetaildata=Returndetail::find()->where(['return_id'=>$id])->all();
$patientdata=Patient::find()->where(['medicalrecord_number'=>$saledata->mrnumber])->one();
$insurancetype=$patientdata->insurance_type;
$insurancedata=Insurance::find()->where(['insurance_typeid'=>$insurancetype])->one();
$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
$session = Yii::$app->session;
$companybranchid=$session['branch_id'];
$companybranchdata=CompanyBranch::find()->where(['branch_id'=>$companybranchid])->one();
$companydata=Company::find()->where(['company_code'=>'C001'])->one();
$companyname=$companybranchdata->branch_name;
$address=$companybranchdata->address1;
$gstin=$companybranchdata->gst_number;
if (preg_match("/op/i", $saledata->return_invoicenumber)) {
   $pt="OP";
} else {
    $pt="IP";
}
$title="(A UNIT OF CARAMEL HEALTHCAREPVT LTD)";
$headertable='<table cellspacing="0" cellpadding="1" >';
$headertable.='<tr ><td style="text-align:center;font-size:18px;" colspan="12" ><b>'.strtoupper($companyname).'</b></td></tr>';
$headertable.='<tr ><td style="text-align:center;font-size:12px;" colspan="12" >'.$title.'</td></tr>';
$headertable.='<tr ><td style="text-align:center;font-size:12px;" colspan="12" ><p>'.strtoupper($address).'</p></td></tr>';


$headertable.='</table>';
$pdf->writeHTML($headertable, true, false, false, false, '');
$tbl1 = '<table cellspacing="0" cellpadding="1"   style="text-align:center;">
   <tr><td colspan="10" style="border:1px solid #000;">
   <table>
   <tr>
   <td colspan="2" style="text-align:left;" >Date & time </td><td colspan="6" style="text-align:left;"> : '.
date("F j, Y, g:i a",strtotime($saledata->returndate)).'</td> 
   <td colspan="3" style="text-align:left;" >Cin No : '.$companydata->cin.'</td>
   </tr>
    <tr>
   <td colspan="2" style="text-align:left;" >Patient '.$pt.' No/Name  </td><td colspan="6" style="text-align:left;"> :'.$saledata->mrnumber.'/'
    .strtoupper($patientdata->firstname. " ".$patientdata->lastname).'</td> 
   <td colspan="3" style="text-align:left;" >DLN1 : '.$companydata->dln1.'</td>
   </tr>
  <tr>
   <td colspan="2" ></td>
  <td colspan="2"></td> <td colspan="3"></td>  
   <td colspan="3" style="text-align:right;" >DLN2 : '.$companydata->dln2.'</td>
   </tr>
   </table>
   </td>
     </tr>
<tr><td  style="border-bottom:1px solid #000;"><b>Indent no</b></td><td colspan="2" style="border-bottom:1px solid #000;"><b>Item Name</b></td>
<td style="border-bottom:1px solid #000;" ><b>HSN Code</b></td><td  style="border-bottom:1px solid #000;"><b>Batch Number</b></td>
<td style="border-bottom:1px solid #000;"><b>EXP DT</b></td><td style="border-bottom:1px solid #000;"><b>Qty</b></td>
<td style="border-bottom:1px solid #000;"><b>Rate </b></td><td style="border-bottom:1px solid #000;"><b>Tax</b></td><td style="border-bottom:1px solid #000;"><b>Amount</b></td>
</thead></tr>';

$i=0;
$totalrate=0;
$totaldiscount=0;
$totalgst=0;
$netrate=0;
$mrp=0;
$tbl1.= '<tr >
	<td colspan="12" align="left" style="color:#000fff;"><b>Issues</b></td></tr>';
$tbl1.= '<tr >
	<td colspan="3" align="left"><b>BillNo : '.$saledata->return_invoicenumber.'</b></td>
	<td colspan="4" align="left"><b>Billdate : '.$saledata->returndate.'</b></td>
	</tr>';

foreach($saledetaildata as $k)
{
$gstvalueperqty=$k->gstvalueperquantity;
$discountvalueperqty=$k->productqty*$k->discountvalueperquantity;
$mrpperunit=$gstvalueperqty+$k->priceperqty;
$gstvalue=$gstvalueperqty*$k->productqty;
$mrp=$mrpperunit*$k->productqty;
$unitid[]=$k->unitid;
$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
$unitval=array_values($newunitdata);
$productid[]=$k->productid;
$newproductdata=array_intersect_key($productlist, array_flip($productid));
$productval=array_values($newproductdata);
$productdata=Product::find()->where(['productid'=>$k->productid])->one();
$hsncode=$productdata->hsn_code;
$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$k->productid])->one();
$ptypeid=$pdata->product_typeid;
$ptypedata=Producttype::find()->where(['is_active'=>1])->andwhere(['product_typeid'=>$ptypeid])->one();
$type=$ptypedata->product_type;
$mrptotal+=$mrp;


	$tbl1.= '<tr >
	<td > </td><td colspan="2">'.$productval[0].'</td><td>'.$hsncode.'</td><td>'.$k->batchnumber.'</td><td>'.date("d/m/Y",strtotime($k->expiredate)).'</td><td>'.$k->productqty.'</td>
	<td align="center">'.number_format($k->priceperqty,2).'</td><td align="center">'.number_format($gstvalue,2).'</td>
	<td align="center">'.number_format($mrp,2).'</td></tr>';


	
$hsncode="";
$totalrate+=number_format($k->price,2);
$totalgstrate+=($k->gstrate/2);
$totalgstvalue+=($gstvalue/2);
$totaldiscount+=$discountvalueperqty;
$totalgst+=$gstvalue;
$newunitdata=array(); $unitid=array();$unitval="";
$newproductdata=array(); $productid=array();$productval="";
} 
$tbl1.='<tr><td colspan="9" style="text-align:right;border-top:1px solid #000;"> Total Amount  </td><td style="border-top:1px solid #000;">'.number_format($mrptotal,2).'</td>

</thead></tr></table>';
/*<table>
<tr><td style="font-size:10px;">'.$totalgstrate.'</td><td style="">'.$totalgstvalue.'</td>
<td style="font-size:10px;">'.$totalgstrate.'</td><td style="">'.$totalgstvalue.'</td>
<td >0</td><td >0</td>
</tr>
</table>
 * 
 */
$pdf->writeHTML($tbl1, true, false, false, false, '');
$words='<table><tr><td colspan="12" align="left"><b>Amount in Words : </b> Rupees '.ucwords($this->actionReadnumber(round($totalrate))).' only </td></tr></table>';
//$pdf->writeHTML($words, true, false, false, false, '');
$pdf->Output('example_001.pdf');

    }




public function actionInvoice($id) {
   
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
$pdf->AddPage('L');


/*$saledata=Salesreturn::find()->where(['return_id'=>$id])->one();
$saledetaildata=Returndetail::find()->where(['return_id'=>$id])->all();
$patientdata=Patient::find()->where(['medicalrecord_number'=>$saledata->mrnumber])->one();
$insurancetype=$patientdata->insurance_type;
$insurancedata=Insurance::find()->where(['insurance_typeid'=>$insurancetype])->one();
$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
$session = Yii::$app->session;
$companybranchid=$session['branch_id'];
$companybranchdata=CompanyBranch::find()->where(['branch_id'=>$companybranchid])->one();
$companydata=Company::find()->where(['company_code'=>'C001'])->one();
$companyname=$companybranchdata->branch_name;
$address=$companybranchdata->address1;
$gstin=$companybranchdata->gst_number;
if (preg_match("/op/i", $saledata->return_invoicenumber)) {
   $pt="OP";
} else {
    $pt="IP";
}*/

$saledata=Salesreturn::find()->where(['return_id'=>$id])->one();

$sale_return=Returndetail::find()->where(['return_id'=>$id])->all();

//Product
$sale_index=ArrayHelper::map($sale_return,'return_detailid','productid');
$product_map=Product::find()->where(['IN','productid',$sale_index])->all();
$product_index=ArrayHelper::index($product_map,'productid');

$userdata=BranchAdmin::find()->where(['ba_autoid'=>$saledata->updated_by])->one();


$patient_name=$saledata->name;
$bill_number=$saledata->return_invoicenumber;


$auto_get=AutoidTable::find()->where(['auto'=>11])->asArray()->one();
$autoget=$auto_get['start_num'];
$inc_value=$autoget+1;
$rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
$date_now=date('d-m-Y H:i:s');


$tbl1='<div><h2 style="text-align:center;color:red;">Dinesh Medical Center</h2>';
$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">PHARMA RETURN SLIP</p>';
$tbl1.='</div>';

$tbl1.='<table style="border:1px solid #000;padding:5px 10px;" ALIGN="left"><tr>
				<td style="width:15%;"><b>Bill No.  </b></td>';
				$tbl1.='<td style="width:35%;"> : '.$bill_number.' </td>';
				$tbl1.='<td style="width:15%;"><b>Receipt Number</b></td>';
				$tbl1.='<td style="width:35%;"> : '.$rtno.' </td>';
				$tbl1.='</tr>';
				$tbl1.='<tr><td><b>Patient Name </b></td>';
				$tbl1.='<td> : '.$patient_name.'</td>';
				$tbl1.='<td><b>Receipt Date</b></td>';
				$tbl1.='<td> : '.$date_now.'</td>';
				$tbl1.='</tr>';
				$tbl1.='</table>';
				
				$tbl1.='<table style="border:1px solid #000;padding:5px 10px;" class="replace_pro" ALIGN="left"><tr>
				<th style="border:1px solid #000;text-align:left"><b>SI.NO </b></th>';
				$tbl1.='<th  style="border:1px solid #000;text-align:left"><b> Product Name </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:center"><b> BATCHNO </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:center"><b> GST </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:center"><b> EXPDT </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:right"><b> QTY </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:right"><b> RATE </b></th>';
				$tbl1.='<th style="border:1px solid #000;text-align:right"><b> AMOUNT </b></th>';
				$tbl1.='</tr>';
				$i=1;
				$ad_value=0;
				foreach ($sale_return as $key => $value) 
				{
					$tbl1.='<tr><td style="border:1px solid #000;text-align:left">'.$i.'</td>';
					$tbl1.='<td style="border:1px solid #000;text-align:left" >'.$product_index[$value['productid']]['productname'].'</td>';
					$tbl1.='<td style="border:1px solid #000;text-align:center" >'.$value['batchnumber'].'</td>';
					$tbl1.='<th style="border:1px solid #000;text-align:center">'.$value['gst_percentage'].'</th>';
					$tbl1.='<td style="border:1px solid #000;text-align:center">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>';
					
					$tbl1.='<td style="border:1px solid #000;text-align:right">'.$value['productqty'].'</td>';
					$tbl1.='<td style="border:1px solid #000;text-align:right">'.$value['mrp'].'</td>';
					$tbl1.='<td style="border:1px solid #000;text-align:right">'.$value['mrp']*$value['productqty'].'</td></tr>';
					$ad_value=$ad_value+($value['mrp']*$value['productqty']);
					$i++;
				}
				
				$tbl1.='</table>';
				
				$tbl1.='<table style="border:1px solid #000;padding:5px 10px;"  ALIGN="left"><tr>';
				$tbl1.='<td></td><td></td><td></td><td></td><td></td><td></td><td style="text-align:right";><b> Total Amount </b></td>';
				$tbl1.='<td style="text-align:right;border:1px solid #000"> '.$ad_value.'</td>';
				$tbl1.='</tr></table>';
				$tbl1.='<div><p style="width:50%"> User Name : '.$userdata->ba_name.'</span><p style="text-align:right;width:50%">Patient Signature</p>';
				
				AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 11]);
				//print_r($tbl1);die;
				$pdf->writeHTML($tbl1, true, false, false, false, '');
				$pdf->Output('ReturnPharmaSlip.pdf');

    }









public  function actionReadnumber($num, $depth=0)
{
    $num = (int)$num;
    $retval ="";
    if ($num < 0) 
        return "negative " + $this->actionReadnumber(-$num, 0);
    if ($num > 99)
    {
        if ($num > 999) 
            $retval .= $this->actionReadnumber($num/1000, $depth+3);

        $num %= 1000; 
        if ($num > 99) 
            $retval .= $this->actionReadnumber($num/100, 2)." hundred \n";
        $retval .=$this->actionReadnumber($num%100, 1);                   
    }
    else 
    {
        $mod = floor($num / 10);
        if ($mod == 0) 
        {
            if ($num == 1) $retval.="one";
            else if ($num == 2) $retval.="two";
            else if ($num == 3) $retval.="three";
            else if ($num == 4) $retval.="four";
            else if ($num == 5) $retval.="five";
            else if ($num == 6) $retval.="six";
            else if ($num == 7) $retval.="seven";
            else if ($num == 8) $retval.="eight";
            else if ($num == 9) $retval.="nine";
        }
        else if ($mod == 1) 
        {
            if ($num == 10) $retval.="ten";
            else if ($num == 11) $retval.="eleven";
            else if ($num == 12) $retval.="twelve";
            else if ($num == 13) $retval.="thirteen";
            else if ($num == 14) $retval.="fourteen";
            else if ($num == 15) $retval.="fifteen";
            else if ($num == 16) $retval.="sixteen";
            else if ($num == 17) $retval.="seventeen";
            else if ($num == 18) $retval.="eighteen";
            else if ($num == 19) $retval.="nineteen";
        }
        else
        {
            if ($mod == 2) $retval.="twenty ";
            else if ($mod == 3) $retval.="thirty ";
            else if ($mod == 4) $retval.="forty ";
            else if ($mod == 5) $retval.="fifty ";
            else if ($mod == 6) $retval.="sixty ";
            else if ($mod == 7) $retval.="seventy ";
            else if ($mod == 8) $retval.="eighty ";
            else if ($mod == 9) $retval.="ninety ";
            if (($num % 10) != 0)
            {
                $retval = rtrim($retval); 
                $retval .= "-";
            }
            $retval.=$this->actionReadnumber($num % 10, 0);
        }
    }
    if ($num != 0)
    {
        if ($depth == 3)
            $retval.=" thousand\n";
        else if ($depth == 6)
            $retval.=" million\n";
        if ($depth == 9)
            $retval.=" billion\n";
    }
    return $retval;
}
}
