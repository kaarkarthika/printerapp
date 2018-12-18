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
use backend\models\CompositionSearch;
use backend\models\StockrequestSearch;
use backend\models\VendorBranch;
use backend\models\Manufacturermaster;
use backend\models\StockresponseSearch;
use backend\models\SalesSearch;
use backend\models\SalesreturnSearch;
use backend\models\StockreturnSearch;
use backend\models\Stockreturn;
use backend\models\Sales;
use yii\data\ActiveDataProvider;
use backend\models\Salesreturn;
use backend\models\Patienttype;
use backend\models\Insurance;
use backend\models\Saledetail;
use backend\models\PurchaseLog;
use backend\models\NewPatient;
use backend\models\Returndetail;
use backend\models\InSales;
use backend\models\InSaledetail;
use backend\models\InRegistration;
use backend\models\InSalesreturn;
use backend\models\InReturndetail;


class ReportController extends \yii\web\Controller
{
public function actionComposition()
{
$searchModel = new CompositionSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

return $this->render('composition', [
'searchModel' => $searchModel,
'dataProvider' => $dataProvider,
]);
}
public function behaviors()
{
return [
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [
'delete' => ['POST'],
],
],
'access' => [ 'class' => AccessControl::className(),'rules' => [ ['allow' => true, 'roles' => ['@' ]  ]] ],
];
}


public function actionSalereport() 
    {
		$searchModel = new SalesSearch();
		$dataProvider = $searchModel -> reportsearch(Yii::$app -> request -> queryParams);
		$patienttypelist=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');
		$insurancetypelist=ArrayHelper::map(Insurance::find()->asArray()->all(), 'insurance_typeid', 'insurance_type');
		return $this -> render('salereport', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,'patienttypelist'=>$patienttypelist,
		"insurancetypelist"=>$insurancetypelist
		]);
	}



public function actionReturnreport() {
		$searchModel = new SalesreturnSearch();
		$dataProvider = $searchModel -> reportsearch(Yii::$app -> request -> queryParams);
		return $this -> render('returnreport', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
	}


public function beforeAction($action) {
return BranchAdmin::checkbeforeaction();
}

				public function actionStocklist()
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
				return $this->render('po_report', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'model' => $model,
				'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
				'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
				'stockcodelist' =>$stockcodelist,

				]);

				}

				public function actionPurchaseorder()
				{

				$searchModel = new StockrequestSearch();
				$dataProvider = $searchModel->reportsearch(Yii::$app->request->queryParams);
				$session = Yii::$app->session;
				$role=$session[
			'authUserRole'];
				if($role=="Super")
				{
				$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
				}
				else{
				$companylist=[];
				}

				$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
				$requestcodelist=ArrayHelper::map(Stockrequest::find()->asArray()->all(), 'requestcode', 'requestcode');

				return $this->render('purchaseorder', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'companylist'=>$companylist,
				'vendorlist'=>$vendorlist,
				'requestcodelist' =>$requestcodelist,
				]);

				}
				
				
				    public function actionPoreceive()
    {
        	
		        $searchModel = new StockresponseSearch();
				$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				$session = Yii::$app->session;
				$role=$session['authUserRole'];
				if($role=="Super")
				{
				$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
				$requestcodelist=ArrayHelper::map(Stockrequest::find()->where(['requesttype'=>'vendorstock'])->asArray()->all(), 'requestcode', 'requestcode');
				}
				else{
				$companylist=[];
					$requestcodelist=ArrayHelper::map(Stockrequest::find()->where(['requesttype'=>'vendorstock','branch_id'=>$session['branch_id']])->asArray()->all(), 'requestcode', 'requestcode');
				}

				$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
				return $this->render('po-receive', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'companylist'=>$companylist,
				'vendorlist'=>$vendorlist,
				'requestcodelist' =>$requestcodelist,
				]);
    
    }


				    public function actionPoreturn()
             {
        	    $searchModel = new StockreturnSearch();
				$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				$session = Yii::$app->session;
				$role=$session['authUserRole'];
				if($role=="Super")
				{
				$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
				$requestcodelist=ArrayHelper::map(Stockrequest::find()->where(['requesttype'=>'vendorstock'])->asArray()->all(), 'requestcode', 'requestcode');
				}
				else{
				$companylist=[];
					$requestcodelist=ArrayHelper::map(Stockrequest::find()->where(['requesttype'=>'vendorstock','branch_id'=>$session['branch_id']])->asArray()->all(), 'requestcode', 'requestcode');
				}

				$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
				return $this->render('po_return', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'companylist'=>$companylist,
				'vendorlist'=>$vendorlist,
				'requestcodelist' =>$requestcodelist,
				]);
              }
				

				public function actionViewproduct($id)
				{
				$model=Composition::findOne($id);
				return $this->renderAjax(
			    'viewproducts',['model' =>$model]);
				}
				

				public function actionPoexcelexport($requestcode,$vendorid,$requestdate)
				{
				$obj = new \PHPExcel();
				$sheet = 0;
				$obj -> setActiveSheetIndex($sheet);

				if((empty($vendorid)) && (empty($requestdate)))
				{
				$requestdata=Stockrequest::find()->where([
			'requestcode'=>$requestcode])->orderBy(['requestcode'=>'ASC'])->one();
			$vendorid=$requestdata->vendorid;
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
			}
			else{
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			}
			$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
			$address=$vbdata->address1;
			$contactperson=$vbdata->contact_person;
			$contactno=$vbdata->person_mobilenumber;
			$contactemailid=$vbdata->branch_emailid;

			$obj -> getActiveSheet() -> setTitle("Purchase Order Details")-> setCellValue('A1', "Vendor Name")-> setCellValue('A2', "Vendor Complete Address") -> setCellValue('A3', "Purchase Order Number")
			-> setCellValue('A4', "Purchase Order Date")-> setCellValue('A5', "Contact Person Name")-> setCellValue('A6', "Contact Person Mobile Number")-> setCellValue('A7', "Contact Person Email ID");

			$obj -> getActiveSheet() ->setCellValue('B1',$vendorname) -> setCellValue('B2', $address) -> setCellValue('B3', $requestcode)-> setCellValue('B4', $requestdate)
			-> setCellValue('B5', $contactperson)-> setCellValue('B6', $contactno)-> setCellValue('B7', $contactemailid);
			$obj -> getActiveSheet() ->setCellValue('A9',"Purchase Order");
			$obj->getActiveSheet()->mergeCells('A9:Z9');
			$obj->getActiveSheet()->getStyle("A9:Z9")->getFont()->setBold(true)->setName('Verdana')->setSize(15)->getColor()->setRGB('ff0000');
			
			$obj -> getActiveSheet()-> setCellValue('A11', "S.No")-> setCellValue('B11', "Hsn Code") 
			-> setCellValue('C11', "Stock Name")-> setCellValue('D11', "Stock Composition")-> setCellValue('E11', "Manufacturer")
			->setCellValue('F11', "Stock Type")->setCellValue('G11', "Quantity")->setCellValue('H11', "Units");
			

			$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');

			$requestdata=Stockrequest::find()->where(['requestcode'=>$requestcode])->all();
			
			$row=12;
			$increment=1;
			
			foreach($requestdata as $data)
			{
			$pdata=Product::find()->where(['productid'=>$data->productid])->one();
			$stockdata=Stockmaster::find()->where(['vendorid'=>$data->vendorid])->andwhere(['productid'=>$data->productid])->andwhere([branch_id=>$data->branch_id])->one();

			$compositionid[]=$stockdata->compositionid;
			$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
			$compositionval=array_values($newcompositiondata);
			$unitid[]=$data->unitid;
			$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
			$unitval=array_values($newunitdata);
			if($pdata)
			{

			$producttypeid[]=$pdata->product_typeid;
			$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
			$producttypeval=array_values($newproducttypedata);

			$mid[]=$pdata->manufacturer_id;
			$mdata=array_intersect_key($mlist, array_flip($mid));
			$mval=array_values($mdata);
			}
			$obj -> getActiveSheet()-> setCellValue('A'.$row, $increment)-> setCellValue('B'.$row, $pdata->hsn_code) -> 
			 setCellValue('C'.$row, $pdata->productname)-> setCellValue('D'.$row, $compositionval[0])-> setCellValue('E'.$row,$mval[0])
			->setCellValue('F'.$row, $producttypeval[0])->setCellValue('G'.$row, $data->quantity)->setCellValue('H'.$row, $unitval[0]);
			$row++;
			$increment++;
			$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
			$newcompositiondata=array(); $compositionid=array();$compositionval="";
			$mdata=array(); $mid=array();$mval="";
			$newunitdata=array(); $unitid=array();$stockcodeval="";
			}
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			$filename = "Purchase Order_".date("d-m-Y-His").".xls";
			header('Content-Disposition: attachment;filename='.$filename .' ');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			$objWriter->save('php://output');
			return $this->redirect(['index']);

			}


            public function actionPopdfexport($requestcode,$vendorid,$requestdate)
				{
				

				if((empty($vendorid)) && (empty($requestdate)))
				{
				$requestdata=Stockrequest::find()->where([
			'requestcode'=>$requestcode])->orderBy(['requestcode'=>'ASC'])->one();
			$vendorid=$requestdata->vendorid;
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
			}
			else{
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			}
			$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
			$address=$vbdata->address1;
			$contactperson=$vbdata->contact_person;
			$contactno=$vbdata->person_mobilenumber;
			$contactemailid=$vbdata->branch_emailid;

			$tbl="";
			$tbl.='<table border="0.1" style="text-align:center;"><tr><td>Purchase Order Number</td><td>Purchase Order Date
			</td></tr>';

			$tbl.='<tr><td>'.$requestcode.'</td><td>'.$requestdate.'</td></tr></table>';
			
			$tbl1="";
			$tbl1.='<table border="0.1" style="text-align:center;"><tr><td>S.No</td><td>Vendor Name</td><td>Hsn Code</td>
			<td>Stock </td><td> Composition</td><td>Manufacturer</td><td>Stock Type</td><td>Quantity</td><td>Units</td><td>Total Qty</td></tr>';

			$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');

			$requestdata=Stockrequest::find()->where(['requestcode'=>$requestcode])->all();
			
			$row=12;
			$increment=1;
			
			foreach($requestdata as $data)
			{
			$pdata=Product::find()->where(['productid'=>$data->productid])->one();
			$stockdata=Stockmaster::find()->where(['vendorid'=>$data->vendorid])->andwhere(['productid'=>$data->productid])->andwhere([branch_id=>$data->branch_id])->one();

			$compositionid[]=$stockdata->compositionid;
			$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
			$compositionval=array_values($newcompositiondata);

			$unitid[]=$data->unitid;
			$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
			$unitval=array_values($newunitdata);
			if($pdata)
			{

			$producttypeid[]=$pdata->product_typeid;
			$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
			$producttypeval=array_values($newproducttypedata);

			$mid[]=$pdata->manufacturer_id;
			$mdata=array_intersect_key($mlist, array_flip($mid));
			$mval=array_values($mdata);
			}
         $vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$data->vendorid])->one();
			$vendorname=$vendorlist->vendorname;

		$tbl1.='<tr><td>'.$increment.'</td><td>'.$vendorname.'</td><td>'.$pdata->hsn_code.'</td><td>'.$pdata->productname.'</td>
		<td>'.$compositionval[0].'</td><td>'.$mval[0].'</td><td>'.$producttypeval[0].'</td><td>'.$data->quantity.'</td><td>'.$unitval[0].'</td><td>'.$data->total_no_of_quantity.'</td></tr>';	

			$row++;
			$increment++;
			

			$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
			$newcompositiondata=array(); $compositionid=array();$compositionval="";
			$mdata=array(); $mid=array();$mval="";
			$newunitdata=array(); $unitid=array();$stockcodeval="";
			
			}
            $tbl1.='</table>';
			
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
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->AddPage();

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->writeHTML("<h3>Purchase Order Request</h3>", true, false, false, false, '');
$pdf->writeHTML($tbl1, true, false, false, false, '');

$pdf->Output('example_001.pdf');


			}



public function actionPoconfirmexcelexport($request_code)
				{
				$obj = new \PHPExcel();
				$sheet = 0;
				$obj -> setActiveSheetIndex($sheet);

				if((!empty($request_code)))
				{
				$requestdata=Stockrequest::find()->where([
			'requestcode'=>$request_code])->orderBy(['requestcode'=>'ASC'])->one();
			$vendorid=$requestdata->vendorid;
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
			$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
			$address=$vbdata->address1;
			$contactperson=$vbdata->contact_person;
			$contactno=$vbdata->person_mobilenumber;
			$contactemailid=$vbdata->branch_emailid;
			}
			$obj -> getActiveSheet() -> setTitle("Purchase Order Details")-> setCellValue('A1', "Vendor Name")-> setCellValue('A2', "Vendor Complete Address") -> setCellValue('A3', "Purchase Order Number")
			-> setCellValue('A4', "Purchase Order Date")-> setCellValue('A5', "Contact Person Name")-> setCellValue('A6', "Contact Person Mobile Number")-> setCellValue('A7', "Contact Person Email ID");

			$obj -> getActiveSheet() ->setCellValue('B1',$vendorname) -> setCellValue('B2', $address) -> setCellValue('B3', $request_code)-> setCellValue('B4', $requestdate)
			-> setCellValue('B5', $contactperson)-> setCellValue('B6', $contactno)-> setCellValue('B7', $contactemailid);
			$obj -> getActiveSheet() ->setCellValue('A9',"Purchase Order Confiramtion");
			$obj->getActiveSheet()->mergeCells('A9:Z9');
			$obj->getActiveSheet()->getStyle("A9:Z9")->getFont()->setBold(true)->setName('Verdana')->setSize(15)->getColor()->setRGB('ff0000');
			$obj -> getActiveSheet()-> setCellValue('C11', "S.No")-> setCellValue('D11', "Hsn Code") -> setCellValue('E11', "Stock Name")-> setCellValue('F11', "Stock Composition")-> setCellValue('G11', "Manufacturer")
			->setCellValue('H11', "Stock Type")->setCellValue('I11', " Ordered Quantity")->setCellValue('J11', "Units")
			->setCellValue('K11', " Received Billed Quantity ")->setCellValue('L11', "Units")
			->setCellValue('M11', " Received Free Quantity ")->setCellValue('N11', "Units")
			->setCellValue('O11', " Total Units ")->setCellValue('P11', "Batch Number")
			->setCellValue('Q11', " Rate ")->setCellValue('R11', "Discount Percent")->setCellValue('S11', "Discount Value")
			->setCellValue('T11', " GST Percent ")->setCellValue('U11', "Gst Value")->setCellValue('V11', " CGST Percent ")->setCellValue('W11', "CGst Value")
			->setCellValue('X11', " SGST Percent ")->setCellValue('Y11', "SGst Value")->setCellValue('Z11', " IGST Percent ")->setCellValue('AA11', "IGst Value")
			->setCellValue('AB11', " MRP")->setCellValue('AC11', "Expiry Date")->setCellValue('AD11', " MRP Per Unit ");
			$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$requestdata=Stockresponse::find()->where(['request_code'=>$request_code])->all();
			$row=12;
			$increment=1;
			$dval=0;
			$gstval=0;
			$cgstval=0;
			$sgstval=0;
			$igstval=0;
			$purchaserate=0;
			foreach($requestdata as $data)
			{
		    $stockdata=Stockmaster::find()->where(['stockid'=>$data->stockid])->one();		
			$pdata=Product::find()->where(['productid'=>$stockdata->productid])->one();
			$hsncode=$pdata->hsn_code;
			$productname=$pdata->productname;
			$stockcode=$stockdata->stockcode;
			$brandcode=$stockdata->brandcode;
			$requestdata=Stockrequest::find()->where(['requestid'=>$data->stockrequestid])->one();
			$req_qty=$requestdata->total_no_of_quantity;
			$compositionid[]=$stockdata->compositionid;
			$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
			$compositionval=array_values($newcompositiondata);
			$unitid[]=$data->unitid;
			$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
			$unitval=array_values($newunitdata);
			if($pdata)
			{

			$producttypeid[]=$pdata->product_typeid;
			$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
			$producttypeval=array_values($newproducttypedata);
			$mid[]=$pdata->manufacturer_id;
			$mdata=array_intersect_key($mlist, array_flip($mid));
			$mval=array_values($mdata);
			}
			$obj -> getActiveSheet()-> setCellValue('C'.$row, $increment)-> setCellValue('D'.$row, $hsncode)
			->setCellValue('E'.$row, $productname)-> setCellValue('F'.$row, $compositionval[0])-> setCellValue('G'.$row, $mval[0])
			->setCellValue('H'.$row, $producttypeval[0])->setCellValue('I'.$row, $req_qty)->setCellValue('J'.$row, $unitval[0])
			->setCellValue('K'.$row, $data->receivedquantity)->setCellValue('L'.$row, $unitval[0])
			->setCellValue('M'.$row,$data->receivedfreequantity)->setCellValue('N'.$row, $unitval[0])
			->setCellValue('O'.$row,$data->total_no_of_quantity )->setCellValue('P'.$row, $data->batchnumber)
			->setCellValue('Q'.$row, $data->purchaseprice)->setCellValue('R'.$row, $data->discountpercent)->setCellValue('S'.$row,$data->discountvalue)
			->setCellValue('T'.$row, $data->gstpercent)->setCellValue('U'.$row, $data->gstvalue)->setCellValue('V'.$row, $data->cgstpercent)->setCellValue('W'.$row,$data->cgstvalue)
			->setCellValue('X'.$row,$data->sgstpercent)->setCellValue('Y'.$row, $data->sgstvalue)->setCellValue('Z'.$row, $data->igstpercent)->setCellValue('AA'.$row, $data->igstvalue)
			->setCellValue('AB'.$row, $data->mrp)->setCellValue('AC'.$row,date("d/m/Y",strtotime($data->expiredate)))->setCellValue('AD'.$row, $data->mrpperunit);
			$dval+=$data->discountvalue;
			$gstval+=$data->gstvalue;
			$cgstval+=$data->cgstvalue;
			$sgstval+=$data->sgstvalue;
			$igstval+=$data->igstvalue;
			$purchaserate+=$data->purchaseprice;
		    $row++;
			$increment++;
		    $newproducttypedata=array(); $producttypeid=array();$producttypeval="";
			$newcompositiondata=array(); $compositionid=array();$compositionval="";
			$mdata=array(); $mid=array();$mval="";
			$newunitdata=array(); $unitid=array();$stockcodeval="";
		}
		         $obj -> getActiveSheet()-> setCellValue('B'.$row, "Total");
				 $obj -> getActiveSheet()-> setCellValue('Q'.$row, $purchaserate);
		         $obj -> getActiveSheet()-> setCellValue('S'.$row, $dval);
				 $obj -> getActiveSheet()-> setCellValue('U'.$row, $gstval);
				 $obj -> getActiveSheet()-> setCellValue('W'.$row, $cgstval);
				 $obj -> getActiveSheet()-> setCellValue('Y'.$row, $sgstval);
				 $obj -> getActiveSheet()-> setCellValue('AA'.$row, $igstval);
               error_reporting(0);
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			$filename = "Purchase Order_".date("d-m-Y-His").".xls";
			header('Content-Disposition: attachment;filename='.$filename .' ');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			$objWriter->save('php://output');
			return $this->redirect(['index']);

			}

			
			
			public function actionPoreturnexcelexport($request_code)
				{
					
				$obj = new \PHPExcel();
				$sheet = 0;
				$obj -> setActiveSheetIndex($sheet);

				if((!empty($request_code)))
				{
		    $requestdata=Stockrequest::find()->where(['requestcode'=>$request_code])->orderBy(['requestcode'=>'ASC'])->one();
		    $vendorid=$requestdata->vendorid;
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
			$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
			$address=$vbdata->address1;
			$contactperson=$vbdata->contact_person;
			$contactno=$vbdata->person_mobilenumber;
			$contactemailid=$vbdata->branch_emailid;
			}
		
			

			$obj -> getActiveSheet() -> setTitle("Purchase Order Details")-> setCellValue('A1', "Vendor Name")-> setCellValue('A2', "Vendor Complete Address") -> setCellValue('A3', "Purchase Order Number")
			-> setCellValue('A4', "Purchase Order Date")-> setCellValue('A5', "Contact Person Name")-> setCellValue('A6', "Contact Person Mobile Number")-> setCellValue('A7', "Contact Person Email ID");

			$obj -> getActiveSheet() ->setCellValue('B1',$vendorname) -> setCellValue('B2', $address) -> setCellValue('B3', $request_code)-> setCellValue('B4', $requestdate)
			-> setCellValue('B5', $contactperson)-> setCellValue('B6', $contactno)-> setCellValue('B7', $contactemailid);
			$obj -> getActiveSheet() ->setCellValue('A9',"Purchase Order Return");
			$obj->getActiveSheet()->mergeCells('A9:Z9');
			$obj->getActiveSheet()->getStyle("A9:Z9")->getFont()->setBold(true)->setName('Verdana')->setSize(15)->getColor()->setRGB('ff0000');
			

			
			
			$obj -> getActiveSheet()-> setCellValue('C11', "S.No")-> setCellValue('D11', "Hsn Code") -> setCellValue('E11', "Stock Name")-> setCellValue('F11', "Stock Composition")-> setCellValue('G11', "Manufacturer")
			->setCellValue('H11', "Stock Type")->setCellValue('I11', " Ordered Quantity")->setCellValue('J11', "Units")
			->setCellValue('K11', " Received Billed Quantity ")->setCellValue('L11', "Units")
			->setCellValue('M11', " Received Free Quantity ")->setCellValue('N11', "Units")
			->setCellValue('O11', " Total Units ")->setCellValue('P11', "Batch Number")
			->setCellValue('Q11', " Rate ")->setCellValue('R11', " Return Quantity ")->setCellValue('S11', "Discount Percent")->setCellValue('T11', "Discount Value")
			->setCellValue('U11', " GST Percent ")->setCellValue('V11', "Gst Value")->setCellValue('W11', " CGST Percent ")->setCellValue('X11', "CGst Value")
			->setCellValue('Y11', " SGST Percent ")->setCellValue('Z11', "SGst Value")->setCellValue('AA11', " IGST Percent ")->setCellValue('AB11', "IGst Value")
			->setCellValue('AC11', " MRP")->setCellValue('AD11', "Expiry Date")->setCellValue('AE11', " MRP Per Unit ");
			
			
			
			$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$requestdata=Stockreturn::find()->where(['request_code'=>$request_code])->all();
			
			$row=12;
			$increment=1;
			$dval=0;
			$gstval=0;
			$cgstval=0;
			$sgstval=0;
			$igstval=0;
			$purchaserate=0;
			
			
			
			foreach($requestdata as $data)
			{
		    $stockdata=Stockmaster::find()->where(['stockid'=>$data->stockid])->one();	
			$pdata=Product::find()->where(['productid'=>$stockdata->productid])->one();
			$hsncode=$pdata->hsn_code;
			$productname=$pdata->productname;
			$stockcode=$stockdata->stockcode;
			$brandcode=$stockdata->brandcode;
			
			$requestdata=Stockrequest::find()->where(['requestid'=>$data->stockrequestid])->one();
			$req_qty=$requestdata->total_no_of_quantity;
			
			
			$responsedata=Stockresponse::find()->where(['stockrequestid'=>$data->stockrequestid])->one();
			$compositionid[]=$stockdata->compositionid;
			$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
			$compositionval=array_values($newcompositiondata);

			$unitid[]=$data->unitid;
			$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
			$unitval=array_values($newunitdata);
			if($pdata)
			{

			$producttypeid[]=$pdata->product_typeid;
			$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
			$producttypeval=array_values($newproducttypedata);

			$mid[]=$pdata->manufacturer_id;
			$mdata=array_intersect_key($mlist, array_flip($mid));
			$mval=array_values($mdata);
			}
$discountpercent=$responsedata->discountpercent;
$purchaseprice=$data->purchaseprice;
$gstpercent=$responsedata->gstpercent;
$discountvalue=(0.01*$discountpercent*$purchaseprice);
$gstvalue=(0.01*$gstpercent*$purchaseprice);
$igstpercent=$responsedata->igstpercent;
$igstvalue=(0.01*$igstpercent*$purchaseprice);
$mrp=$responsedata->mrpperunit * $data->returnquantity;
			
			$obj -> getActiveSheet()-> setCellValue('C'.$row, $increment)-> setCellValue('D'.$row, $hsncode)
			->setCellValue('E'.$row, $productname)-> setCellValue('F'.$row, $compositionval[0])-> setCellValue('G'.$row, $mval[0])
			->setCellValue('H'.$row, $producttypeval[0])->setCellValue('I'.$row, $req_qty)->setCellValue('J'.$row, $unitval[0])
			->setCellValue('K'.$row, $data->receivedquantity)->setCellValue('L'.$row, $unitval[0])
			->setCellValue('M'.$row,$responsedata->receivedfreequantity)->setCellValue('N'.$row, $unitval[0])
			->setCellValue('O'.$row,$data->total_no_of_quantity )->setCellValue('P'.$row, $data->batchnumber)
			->setCellValue('Q'.$row, $purchaseprice)->setCellValue('R'.$row, $data->returnquantity)->setCellValue('S'.$row, $discountpercent)->setCellValue('T'.$row,$discountvalue)
			->setCellValue('U'.$row, $gstpercent)->setCellValue('V'.$row, $gstvalue)->setCellValue('W'.$row, ($gstpercent/2))->setCellValue('X'.$row,($gstvalue/2))
			->setCellValue('Y'.$row,($gstpercent/2))->setCellValue('Z'.$row, ($gstvalue/2))->setCellValue('AA'.$row, $igstpercent)->setCellValue('AB'.$row, $igstvalue)
			->setCellValue('AC'.$row, $mrp)->setCellValue('AD'.$row,date("d/m/Y",strtotime($responsedata->expiredate)))->setCellValue('AE'.$row, $responsedata->mrpperunit);
			
			
			$dval+=$discountvalue;
			$gstval+=$gstvalue;
			$cgstval+=$gstvalue/2;
			$sgstval+=$gstvalue/2;
			$igstval+=$igstvalue;
			$purchaserate+=$purchaseprice;

			$row++;
			$increment++;
			

			$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
			$newcompositiondata=array(); $compositionid=array();$compositionval="";
			$mdata=array(); $mid=array();$mval="";
			$newunitdata=array(); $unitid=array();$stockcodeval="";
			
			}
		         $obj -> getActiveSheet()-> setCellValue('B'.$row, "Total");
				 $obj -> getActiveSheet()-> setCellValue('Q'.$row, $purchaserate);
		         $obj -> getActiveSheet()-> setCellValue('T'.$row, $dval);
				 $obj -> getActiveSheet()-> setCellValue('V'.$row, $gstval);
				 $obj -> getActiveSheet()-> setCellValue('X'.$row, $cgstval);
				 $obj -> getActiveSheet()-> setCellValue('Z'.$row, $sgstval);
				 $obj -> getActiveSheet()-> setCellValue('AB'.$row, $igstval);
				 
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			$filename = "Purchase Order_".date("d-m-Y-His").".xls";
			header('Content-Disposition: attachment;filename='.$filename .' ');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			$objWriter->save('php://output');
			return $this->redirect(['index']);

			}



			

			   public function actionPoconfirmpdfexport($request_code)
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
						if((!empty($request_code)))
				{
				$requestdata=Stockrequest::find()->where(['requestcode'=>$request_code])->orderBy(['requestcode'=>'ASC'])->one();
					$vendorid=$requestdata->vendorid;
					$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
					$vendorname=$vendorlist->vendorname;
					$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
					$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
					$address=$vbdata->address1;
					$contactperson=$vbdata->contact_person;
					$contactno=$vbdata->person_mobilenumber;
					$contactemailid=$vbdata->branch_emailid;
			}
	     $pdf->writeHTML("<h3>Purchase Order Confirmation</h3>", true, false, false, false, '');
		 $tbl='<table border="0.1" cellspacing="1" cellpadding="5" ><tr><td>Vendor Name </td><td> '.$vendorname.'</td></tr>
		  <tr><td> Vendor Complete Address </td><td> '.$address.'</td></tr>
		   <tr><td> Request Code </td><td> '.$request_code.'</td></tr>
		    <tr><td> Request Date </td><td> '.$requestdate.'</td></tr>
		    <tr><td> Contact Person</td><td> '.$contactperson.'</td></tr>
		     <tr><td> Contact No </td><td> '.$contactno.'</td></tr>
		      <tr><td> Contact Email </td><td>'.$contactemailid.'</td></tr></table>';
		  $pdf->writeHTML($tbl, true, false, false, false, '');
		  $tbl1='<table cellspacing="0" cellpadding="1"  border="0.1" style="text-align:center;">
		  <tr><td ><b>S.No</b></td><td ><b>Stock <br>Name</b></td><td width="50"><b>HSN Code</b></td><td width="50" ><b>Batch No</b></td><td width="60"><b>EXP DT</b></td><td width="30"><b>Qty</b></td>
		  <td width="30"><b>Vendor Rate</b></td><td width="40"><b>Vendor Amount</b></td>
<td width="30"><b>MRP per unit </b></td><td width="40"><b>Tax</b></td><td width="40"><b>Amount</b></td><td width="206">
<table>
<tr ><td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>CGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>SGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;"><b>IGST</b></td>
</tr>
<tr><td style="font-size:10px;">Rate</td><td style="">Amt</td>
<td>Rate</td><td >Amt</td>
<td>Rate</td><td >Amt</td>
</tr>
</table>
</td>
</tr>';
 $producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$requestdata=Stockresponse::find()->where(['request_code'=>$request_code])->all();
			$row=12;
			$increment=1;
			$dval=0;
			$gstval=0;
			$cgstval=0;
			$sgstval=0;
			$igstval=0;
			$purchaserate=0;
			$vendorrate=0;
			$vendorpp=0;
			foreach($requestdata as $data)
			{
		    $stockdata=Stockmaster::find()->where(['stockid'=>$data->stockid])->one();	
			$pdata=Product::find()->where(['productid'=>$stockdata->productid])->one();
			$hsncode=$pdata->hsn_code;
			$productname=$pdata->productname;
			$stockcode=$stockdata->stockcode;
			$brandcode=$stockdata->brandcode;
			$requestdata=Stockrequest::find()->where(['requestid'=>$data->stockrequestid])->one();
			$req_qty=$requestdata->total_no_of_quantity;
			$compositionid[]=$stockdata->compositionid;
			$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
			$compositionval=array_values($newcompositiondata);
			$unitid[]=$data->unitid;
			$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
			$unitval=array_values($newunitdata);
			if($pdata)
			{
			$producttypeid[]=$pdata->product_typeid;
			$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
			$producttypeval=array_values($newproducttypedata);
			$mid[]=$pdata->manufacturer_id;
			$mdata=array_intersect_key($mlist, array_flip($mid));
			$mval=array_values($mdata);
			}
	


 $tbl1.='<tr><td >'.$increment.'</td><td >'.$productname.'</td><td width="50">'.$hsncode.'</td><td width="50" >
 '.$data->batchnumber.'</td><td width="60">'.date("d/m/Y",strtotime($data->expiredate)).'</td><td width="30">'.$data->total_no_of_quantity.'</td><td width="30">'.$data->priceperquantity.'</td><td width="40">'.$data->purchaseprice.'</td>
<td width="30">'.$data->mrpperunit.'</td><td width="40">'.$data->discountvalue.'</td><td width="40">'.$data->mrp.'</td><td width="206">
<table>

<tr><td style="font-size:10px;">'.$data->cgstpercent.'</td><td style="">'.$data->cgstvalue.'</td>
<td>'.$data->sgstpercent.'</td><td >'.$data->sgstvalue.'</td>
<td>'.$data->igstpercent.'</td><td>'.$data->igstvalue.'</td>
</tr>
</table>
</td>
</tr>';

	        $dval+=$data->discountvalue;
			$gstval+=$data->gstvalue;
			$cgstval+=$data->cgstvalue;
			$sgstval+=$data->sgstvalue;
			$igstval+=$data->igstvalue;
			$vendorrate+=$data->priceperquantity;
			$vendorpp+=$data->purchaseprice;
			$mrp+=$data->mrp;
			$row++;
			$increment++;
			$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
			$newcompositiondata=array(); $compositionid=array();$compositionval="";
			$mdata=array(); $mid=array();$mval="";
			$newunitdata=array(); $unitid=array();$stockcodeval="";
			}

 $tbl1.='<tr><td ></td><td></td><td width="50"></td><td width="50" >
</td><td width="60"></td><td width="30">Total</td><td width="30">'.$vendorrate.'</td><td>'.$vendorpp.'</td>
<td width="30"></td><td width="40">'.$dval.'</td><td width="40">'.$purchaserate.'</td><td width="206">
<table>

<tr><td style="font-size:10px;"></td><td style="">'.$cgstval.'</td>
<td></td><td >'.$sgstval.'</td>
<td></td><td>'.$igstval.'</td>
</tr>
</table>
</td>
</tr>';




$tbl1.='</table>';
  error_reporting(0);
 $pdf->writeHTML($tbl1, true, false, false, false, '');
 $pdf->Output('example_001.pdf');
 
 
 
		  
			}



		public function actionPoreturnpdfexport($request_code)
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
				if((!empty($request_code)))
				{
		    $requestdata=Stockrequest::find()->where(['requestcode'=>$request_code])->orderBy(['requestcode'=>'ASC'])->one();
		    $vendorid=$requestdata->vendorid;
			$vendorlist=Vendor::find()->where(['is_active'=>1])->andwhere(['vendorid'=>$vendorid])->one();
			$vendorname=$vendorlist->vendorname;
			$requestdate=date("d/m/Y",strtotime($requestdata->requestdate));
			$vbdata=VendorBranch::find()->where(['vendorid'=>$vendorid])->andwhere(['vendor_branchid'=>1])->one();
			$address=$vbdata->address1;
			$contactperson=$vbdata->contact_person;
			$contactno=$vbdata->person_mobilenumber;
			$contactemailid=$vbdata->branch_emailid;
			}
	 $pdf->writeHTML("<h3>Purchase Order Confirmation</h3>", true, false, false, false, '');
		 $tbl='<table border="0.1" cellspacing="1" cellpadding="5" ><tr><td>Vendor Name </td><td> '.$vendorname.'</td></tr>
		  <tr> <td> Vendor Complete Address </td><td> '.$address.'</td></tr>
		   <tr> <td> Request Code </td><td> '.$request_code.'</td></tr>
		    <tr> <td> Request Date </td><td> '.$requestdate.'</td></tr>
		    <tr>  <td> Contact Person</td><td> '.$contactperson.'</td></tr>
		     <tr>   <td> Contact No </td><td> '.$contactno.'</td></tr>
		      <tr>     <td> Contact Email </td><td>'.$contactemailid.'</td></tr></table>';
		    $pdf->writeHTML($tbl, true, false, false, false, '');
			$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
			$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
			$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
			$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
			$requestdata=Stockreturn::find()->where(['request_code'=>$request_code])->all();
			$increment=1;
			$dval=0;
			$gstval=0;
			$cgstval=0;
			$sgstval=0;
			$igstval=0;
			$purchaserate=0;
		 $tbl1='<table cellspacing="0" cellpadding="1"  border="1" style="text-align:center;">
		  <tr><td><b>S.No</b></td><td style="width:100px;"><b>Stock <br>Name</b></td><td width="50"><b>HSN Code</b></td><td width="50" ><b>Batch No</b></td><td width="60"><b>EXP DT</b></td><td width="30"><b>Qty</b></td>
<td width="30"><b>Rate </b></td><td width="40"><b>Tax</b></td><td width="40"><b>Amount</b></td><td width="206"><table>
<tr><td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>CGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>SGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;"><b>IGST</b></td></tr>
<tr><td style="font-size:10px;">Rate</td><td style="">Amt</td>
<td >Rate</td><td >Amt</td>
<td >Rate</td><td >Amt</td>
</tr>
</table>
</td>
</tr>';
			foreach($requestdata as $data)
			{
		    $stockdata=Stockmaster::find()->where(['stockid'=>$data->stockid])->one();	
			$pdata=Product::find()->where(['productid'=>$stockdata->productid])->one();
			$hsncode=$pdata->hsn_code;
			$productname=$pdata->productname;
			$stockcode=$stockdata->stockcode;
			$brandcode=$stockdata->brandcode;
			$requestdata=Stockrequest::find()->where(['requestid'=>$data->stockrequestid])->one();
			$req_qty=$requestdata->total_no_of_quantity;
			$responsedata=Stockresponse::find()->where(['stockrequestid'=>$data->stockrequestid])->one();
			$discountpercent=$responsedata->discountpercent;
			$purchaseprice=$data->purchaseprice;
			$gstpercent=$responsedata->gstpercent;
			$discountvalue=(0.01*$discountpercent*$purchaseprice);
			$gstvalue=(0.01*$gstpercent*$purchaseprice);
			$igstpercent=$responsedata->igstpercent;
			$igstvalue=(0.01*$igstpercent*$purchaseprice);
			$mrp=$responsedata->mrpperunit * $data->returnquantity;
			$tbl1.='<tr><td>'.$increment.'</td><td style="width:100px;">'.$productname.'</td><td width="50">'.$hsncode.'</td><td width="50" >
			'.$data->batchnumber.'</td><td width="60">'.$responsedata->expiredate.'</td><td width="30">'.$data->total_no_of_quantity.'</td>
<td width="30">'.$responsedata->mrpperunit.'</td><td width="40">'.$responsedata->discountvalue.'</td><td width="40">'.$responsedata->mrp.'</td><td width="206"><table>

<tr><td style="font-size:10px;">'.$gstpercent.'</td><td style="">'.$gstvalue.'</td>
<td>'.($gstpercent/2).'</td><td>'.($gstvalue/2).'</td>
<td >'.($gstpercent/2).'</td><td>'.($gstvalue/2).'</td>
</tr>
</table>
</td>
</tr>';
			
			$dval+=$discountvalue;
			$gstval+=$gstvalue;
			$cgstval+=$gstvalue/2;
			$sgstval+=$gstvalue/2;
			$igstval+=$igstvalue;
			$purchaserate+=$purchaseprice;
			$increment++;
			}
            $tbl1.='</table>';
			error_reporting(0);
            $pdf->writeHTML($tbl1, true, false, false, false, '');
		    $pdf->Output('example_001.pdf');
			}

         public function actionInvoicepdfdownload($name,$mrnumber,$billnumber,$paid_status,$from,$to,$type,$ptype,$itype)
				{
				        
	 $query = Sales::find()->orderBy(['opsaleid'=>SORT_DESC]);
     $session = Yii::$app->session;
	$role=$session['authUserRole'];
	if($role=="Super"){}
		else{$query->andFilterWhere(['branch_id'=>$session['branch_id']]);}
if(!empty($from) && !empty($to))
	{
	    $fromdate=date("Y-m-d",strtotime($from));
	    $todate=date("Y-m-d",strtotime($to));
	    $query->andFilterWhere(['between', 'invoicedate',$fromdate, $todate]);
	}
$query->andFilterWhere(['like', 'name', trim($name)]) ->andFilterWhere(['like', 'mrnumber', trim($mrnumber)])->andFilterWhere(['like', 'billnumber', $billnumber])
	->andFilterWhere([ 'paid_status'=>$paid_status]);
	
	$query->andFilterWhere([ 'patienttype'=>$ptype]);
	$query->andFilterWhere(['insurancetype'=>$itype]);
	
	if($ptype==1)
	{
		$patienttype="InPatient";
	}
	else
	{
		$patienttype="OutPatient";
	}
	
	
	
	
	

        $dataProvider = new ActiveDataProvider([ 'query' => $query,'pagination' => false ]);
  $datatables = $dataProvider -> getModels();
  
  if($type=="pdf")
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
						
						$insurancedata=Insurance::find()->where(['insurance_typeid'=>$itype])->one();
						if(!empty($insurancedata)){
							$insurance_type	= $insurancedata->insurance_type;
						}else{
							$insurance_type	= "";
						}
		
				$tbl1= '<table cellspacing="0" cellpadding="1"  border="0.1" style="text-align:center;">';
 $tbl1.='<tr><td ><b>Name</b></td><td ><b>MRNumber</b></td><td ><b>Bill Number</b></td>	
		  <td ><b>Paid Status</b></td> <td ><b>From Date</b></td> <td ><b>To Date</b></td><td ><b>Patient Type</b></td><td ><b>Insurance Type</b></td></tr>';
		  
		   $tbl1.="<tr><td >".$name."</td><td >".$mrnumber."</td><td >".$billnumber."</td>	
		  <td >".$paid_status."</td> <td >".$from."</td> <td>".$to."</td><td>".$patienttype."</td><td>".$insurance_type."</td></tr>";
		  
 
           
 $tbl1.='<tr><td ><b>S.No</b></td><td ><b>Patient Name</b></td><td ><b>Medical Record Number</b></td>	
		  <td ><b>Bill Number</b></td> <td ><b>Paid Status</b></td> <td ><b>Total Gst</b></td><td ><b>Total Discount</b></td><td ><b>Total Amount</b></td></tr>';
  $l=1;			
  
  $total=0;
			foreach($datatables as $k)
			{
				$paidstatus=$k->paid_status;
if($paidstatus=="Paid"){$paid_status="Invoice Paid";}
else {$paid_status="Invoice Generated";}
$tbl1.='
<tr>
	<td >'.$l.'</td><td>'.$k->name.'</td><td >'.$k->mrnumber.'</td>
	<td>'.$k->billnumber.'</td><td >'.$paid_status.'</td><td>'.$k->totalgstvalue.'</td><td>'.$k->totaldiscountvalue.'</td><td>'.$k->total.'</td>
</tr>
'; 
$total+=$k->total;
	$l++;	
			}	
 $tbl1.='<tr><td ></td><td ></td><td ></td>	
		  <td></td> <td></td> <td></td><td>Amount :</td><td>'.number_format($total,2).'</td></tr>';
	
            $tbl1.="</table>";
			// $pdf->writeHTML($tbl11, true, false, false, false, '');
			 $pdf->writeHTML($tbl1, true, false, false, false, '');
			
		    $pdf->Output('example_001.pdf');
			
			
			
  }




else{
	
	$obj = new \PHPExcel();
	$sheet = 0;
	$obj -> setActiveSheetIndex($sheet);
			$obj -> getActiveSheet() -> setTitle("Sales Invoice Report")
			-> setCellValue('A1', "S.No")-> setCellValue('B1', "Patient Name") -> setCellValue('C1', "Medical Record Number")
			-> setCellValue('D1', "Bill Number")-> setCellValue('E1', "Paid Status")->setCellValue('F1', "Total Amount")->
			 setCellValue('G1', "Total Gst")-> setCellValue('H1', "Total Discount");
			 
			  $l=1;			
			  $row=2;
			foreach($datatables as $k)
			{
				$paidstatus=$k->paid_status;
if($paidstatus=="Paid"){$paid_status="Invoice Paid";}
else {$paid_status="Invoice Generated";}

$obj -> getActiveSheet()->setCellValue('A'.$row, $l)->  setCellValue('B'.$row, $k->name) -> setCellValue('C'.$row, $k->mrnumber)
			-> setCellValue('D'.$row, $k->billnumber)-> setCellValue('E'.$row,$paid_status)->setCellValue('F'.$row, $k->total)->
			 setCellValue('G'.$row, $k->totalgstvalue)->setCellValue('H'.$row, $k->totaldiscountvalue);
			 	$row++;
	$l++;	
			}	
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			$filename = "Purchase Order_".date("d-m-Y-His").".xls";
			header('Content-Disposition: attachment;filename='.$filename .' ');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			$objWriter->save('php://output');
			return $this->redirect(['index']);
}		
			
			
			}


public function actionInvoicereturnpdfdownload($name,$mrnumber,$return_invoicenumber,$paid_status,$from,$to,$type)
				{     
	  $query = Salesreturn::find()->orderBy(['return_id'=>SORT_DESC]);
		if(!empty($this->returndate) && !empty($this->updated_on))
	{
					$f=$this->returndate;
					$t=$this->updated_on;
				    $fromdate=date("Y-m-d",strtotime($f));
				    $todate=date("Y-m-d",strtotime($t));
				    $query->andFilterWhere(['between', 'returndate',$fromdate, $todate]);
	}

        $query->andFilterWhere(['like', 'return_invoicenumber', $return_invoicenumber]) ->andFilterWhere(['like', 'mrnumber', $mrnumber])
       ->andFilterWhere(['like', 'name', $name])->
		andFilterWhere(['like', 'paid_status', $paid_status]);
      $dataProvider = new ActiveDataProvider(['query' => $query,'pagination'=>false]);
  $datatables = $dataProvider -> getModels();
  if($type=="pdf")
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
$tbl1= '<table cellspacing="0" cellpadding="1"  border="0.1" style="text-align:center;">';
 $tbl1.='<tr><td ><b>S.No</b></td><td ><b>Patient Name</b></td><td ><b>Medical Record Number</b></td>	
		  <td ><b>Bill Number</b></td> <td ><b>Paid Status</b></td> <td ><b>Total Amount</b></td><td ><b>Total Gst</b></td><td ><b>Total Discount</b></td></tr>';
  $l=1;			
			foreach($datatables as $k)
			{
				$paidstatus=$k->paid_status;
if($paidstatus=="Paid"){$paid_status="Invoice Paid";}
else {$paid_status="Invoice Generated";}
$tbl1.='
<tr><td >'.$l.'</td><td>'.$k->name.'</td><td >'.$k->mrnumber.'</td>
	<td>'.$k->return_invoicenumber.'</td><td >'.$paid_status.'</td><td>'.$k->total.'</td><td>'.$k->totalgstvalue.'</td><td>'.$k->totaldiscountvalue.'</td>
</tr>'; 
	$l++;	
			}	
	        $tbl1.="</table>";
			error_reporting(0);
            $pdf->writeHTML($tbl1, true, false, false, false, '');
		    $pdf->Output('example_001.pdf');
  }
else{
	
	$obj = new \PHPExcel();
	$sheet = 0;
	$obj -> setActiveSheetIndex($sheet);
			$obj -> getActiveSheet() -> setTitle("Sales Invoice Report")
			-> setCellValue('A1', "S.No")-> setCellValue('B1', "Patient Name") -> setCellValue('C1', "Medical Record Number")
			-> setCellValue('D1', "Bill Number")-> setCellValue('E1', "Paid Status")->setCellValue('F1', "Total Amount")->
			 setCellValue('G1', "Total Gst")-> setCellValue('H1', "Total Discount");
			  $l=1;			
			  $row=2;
			foreach($datatables as $k)
			{
$paidstatus=$k->paid_status;
if($paidstatus=="Paid"){$paid_status="Invoice Paid";}
else {$paid_status="Invoice Generated";}
$obj -> getActiveSheet()->setCellValue('A'.$row, $l)->  setCellValue('B'.$row, $k->name) -> setCellValue('C'.$row, $k->mrnumber)
			-> setCellValue('D'.$row, $k->return_invoicenumber)-> setCellValue('E'.$row,$paid_status)->setCellValue('F'.$row, $k->total)->
			 setCellValue('G'.$row, $k->totalgstvalue)->setCellValue('H'.$row, $k->totaldiscountvalue);
			 	$row++;
	$l++;	
			} 
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			$filename = "Purchase Order_".date("d-m-Y-His").".xls";
			header('Content-Disposition: attachment;filename='.$filename .' ');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');
			$objWriter->save('php://output');
			return $this->redirect(['index']);
}			
			
			}

 public function actionPricelist()
  {
  	
	    $companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		$branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$model = new Stockmaster();
        $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		$searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch_np(Yii::$app->request->queryParams);
			
        return $this->render('pricelist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'companylist'=>$companylist,'brandlist'=>$brandlist,
        ]);
	 } 
		
		
	public function actionPricelist1()
  	{
  		
	    $companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		$branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$model = new Stockmaster();
        $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		$searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch_np(Yii::$app->request->queryParams);
		
        return $this->render('pricelistreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'companylist'=>$companylist,'brandlist'=>$brandlist,
        ]);
	 }

	
	
	public function actionItemwise()
  	{
  		
		if($_POST)
		{
			
			$fromDate=date('Y-m-d',strtotime($_POST['fromDate']));
			$toDate=date('Y-m-d',strtotime($_POST['toDate']));
			$Productname=$_POST['Productname']['id'];
			
			
			$PurchaseLog=PurchaseLog::find()->where(['IN','productid',$Productname])->andWhere(['BETWEEN','received_date',$fromDate,$toDate])->orderBy(['productid'=>SORT_ASC])->all();
			//print_r($Productname);die;
			$PurchaseLog_add=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['IN','productid',$Productname])->andWhere(['BETWEEN','received_date',$fromDate,$toDate])->groupBy(['productid'])->orderBy(['productid'=>SORT_ASC])->all();
			
			$PurchaseLog_add_last=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['IN','productid',$Productname])->andWhere(['BETWEEN','received_date',$fromDate,$toDate])->one();
		
			$resultProduct = ArrayHelper::map($PurchaseLog, 'purchase_id', 'productid');
			$resultCompany = ArrayHelper::map($PurchaseLog, 'purchase_id', 'branch_id');
			
			$resultVendor = ArrayHelper::map($PurchaseLog, 'purchase_id', 'vendor_id');
			
			$resultVendorBranch = ArrayHelper::map($PurchaseLog, 'purchase_id', 'vendor_branch_id');
			
			
			$indexMaster=ArrayHelper::index($PurchaseLog,'purchase_id');
			$Product=Product::find()->where(['IN','productid',$resultProduct])->asArray()->all();
			$dataProduct = ArrayHelper::index($Product,'productid');
			$CompanyBranch=CompanyBranch::find()->where(['IN','branch_id',$resultProduct])->asArray()->all();
			$dataCompany = ArrayHelper::index($CompanyBranch,'branch_id');
			
			$vendor=Vendor::find()->where(['is_active'=>1])->andWhere(['IN','vendorid',$resultVendor])->asArray()->all();
			$dataVendor = ArrayHelper::index($vendor,'vendorid');
			
			$data_group=0;
			if(!empty($PurchaseLog))
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
				$pdf->SetFont('helvetica', '', 8, '', true);
				$pdf->AddPage("L");
				

				$tbl1='<div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h2>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
				$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">ITEM WISE PURCHASE REPORT</p>';
				$tbl1.='</div>';
				$tbl1.='<div><h3><span>From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>To Date '.date('d-m-Y',strtotime($toDate)).'</span></h3><hr>';
				$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td ALIGN="RIGHT"  ><b>SI No</b></td>';
				$tbl1.='<td  ALIGN="CENTER"  ><B>Batch No</b></td>';
				$tbl1.='<td  ALIGN="RIGHT" ><b>Qty</b></td>';
				$tbl1.='<td  ALIGN="RIGHT"  ><b>Free</b></td>';
				$tbl1.='<td  ALIGN="RIGHT"   ><b>Rate</b></td>';
				$tbl1.='<td  ALIGN="RIGHT" ><b>GST(%)</b></td>';
				$tbl1.='<td  ALIGN="RIGHT" ><b>GST(Amt)</b></td>';
				$tbl1.='<td  ALIGN="RIGHT" ><b>MRP/Unit</b></td>';
				$tbl1.='<td  ALIGN="RIGHT"  ><b>Total</b></td></tr></table><hr>';
						
						
				$i=1;
				$total=0;
				$freetotal=0;
				$overtotal=0;
					
				$vendorNamestatic=$dataProduct[$PurchaseLog[0]['productid']]['productname'];	
				$date_received=$PurchaseLog[0]['productid'];
				$inc=0;
				
				$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="left"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$vendorNamestatic.'</font></b></td></tr></table>';
				foreach ($PurchaseLog as $key => $value) 
				{
					if(isset($indexMaster[$value['purchase_id']]))
					{
						$vendor_id=$indexMaster[$value['purchase_id']]['vendor_id'];
						
						if($vendor_id !="")
						{
							if(isset($dataVendor[$vendor_id]))
							{
								$vendorName=$dataVendor[$vendor_id]['vendorname'];
								$vendorCode=$dataVendor[$vendor_id]['vendorcode'];
							}
						}
					}
					
					if($date_received == $value['productid'])
					{
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td  ALIGN="RIGHT"  >'.$i.'</td><td  ALIGN="CENTER"  >'.$value['batch_number'].'</td><td ALIGN="RIGHT" >'.$value['received_qty'].'</td><td  ALIGN="RIGHT"  >'.$value['receivedfreequantity'].'</td><td ALIGN="RIGHT"  >'.$this->computevalue($value['priceperquantity']).'</td><td  ALIGN="RIGHT"  >'.$value['gstpercent'].'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['gstvalue']).'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrpperunit']).'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrp']).'</td></tr></table>';
						$tbl1.='<hr>';
					}
					else if($date_received != $value['productid']) 
					{
						$date_received=$value['productid'];
						$tbl1.='<hr>';
							
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="left"><tr><td  ALIGN="RIGHT"  ><b style="color:green;">Total</b></td><td  ALIGN="CENTER"  ></td><td ALIGN="RIGHT" style="color:green;">'.$PurchaseLog_add[$inc]['received_qty'].'</td><td  ALIGN="RIGHT"  style="color:green;">'.$PurchaseLog_add[$inc]['receivedfreequantity'].'</td><td ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['priceperquantity']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$PurchaseLog_add[$inc]['gstpercent'].'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['mrpperunit']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</td></tr></table>';
					
						$tbl1.='<hr>';
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="CENTER"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$dataProduct[$date_received]['productname'].'</font></b></td></tr></table>';
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td  ALIGN="RIGHT"  >'.$i.'</td><td  ALIGN="CENTER"  >'.$value['batch_number'].'</td><td ALIGN="RIGHT" >'.$value['received_qty'].'</td><td  ALIGN="RIGHT"  >'.$value['receivedfreequantity'].'</td><td ALIGN="RIGHT"  >'.$this->computevalue($value['priceperquantity']).'</td><td  ALIGN="RIGHT"  >'.$value['gstpercent'].'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['gstvalue']).'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrpperunit']).'</td><td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrp']).'</td></tr></table>';
						$tbl1.='<hr>';
						$inc++;
					}
					
					$i++;
				}
					
				$tbl1.='<hr>';
				$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"  ><tr><td  ALIGN="left"  ><b style="color:green;">Total</b></td><td  ALIGN="CENTER"  ></td><td ALIGN="RIGHT" style="color:green;">'.$PurchaseLog_add[$inc]['received_qty'].'</td><td  ALIGN="RIGHT" style="color:green;" >'.$PurchaseLog_add[$inc]['receivedfreequantity'].'</td><td ALIGN="RIGHT"  style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['priceperquantity']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$PurchaseLog_add[$inc]['gstpercent'].'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['mrpperunit']).'</td><td  ALIGN="RIGHT" style="color:green;" >'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</td></tr></table>';
				$tbl1.='<hr>';
				$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT" ><tr><td  ALIGN="left"  ><b style="color:red;">  Grand Total</b></td><td></td><td ALIGN="RIGHT" style="color:red;">'.$PurchaseLog_add_last['received_qty'].'</td><td  ALIGN="RIGHT" style="color:red;" >'.$PurchaseLog_add_last['receivedfreequantity'].'</td><td ALIGN="RIGHT" style="color:red;" >'.$this->computevalue($PurchaseLog_add_last['priceperquantity']).'</td><td  ALIGN="RIGHT" style="color:red;" >'.$PurchaseLog_add_last['gstpercent'].'</td><td  ALIGN="RIGHT" style="color:red;"  >'.$this->computevalue($PurchaseLog_add_last['gstvalue']).'</td><td  ALIGN="RIGHT" style="color:red;"  >'.$this->computevalue($PurchaseLog_add_last['mrpperunit']).'</td><td  ALIGN="RIGHT" style="color:red;" >'.$this->computevalue($PurchaseLog_add_last['mrp']).'</td></tr></table>';
				$tbl1.='<hr>';
					
				
				$pdf->writeHTML($tbl1, true, false, false, false, '');
		    	$pdf->Output('example_001.pdf');
			}
		}
		else 
		{
			$product=new Product();
			$company= new CompanyBranch();
	  		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
			$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
			$username = ArrayHelper::map(BranchAdmin::find()->asArray()->all(),'ba_autoid','ba_name');
			$vendorname = ArrayHelper::map(Vendor::find()->asArray()->all(),'vendorid','vendorname');
			
			return $this->render('itemwisereport', [
	            'productlist' => $productlist,
	            'companylist' => $companylist,
	            'product' => $product,
	            'company' => $company,
	            'username' => $username,
	            'vendorname' => $vendorname,
	        ]);
		}
  	}
	
	
  // passing by reference
  function  computevalue($param)
  {
  	 $param= number_format($param,2, '.', '');
	 return $param;
  }
 

	public function actionExpiryreport()
  	{
		if($_POST)
		{
			
		
			$from=date('Y-m-d',strtotime($_POST['fromDate3']));
			$to=date('Y-m-d', strtotime($from. ' + 90 day'));
			
			$branch_id=$_POST['Branch']['branchnamepricelist'];
			$Stock_brand=Stockmaster::find() -> where(['BETWEEN','expiredate',$from,$to]) -> andWhere(['is_active' => 1])-> andWhere(['branch_id'=> $branch_id])->andWhere(['!=', 'total_no_of_quantity', 0])->orderBy(['expiredate'=>SORT_DESC])-> asArray() -> all();
			
			$Stock_brand_group=Stockmaster::find()->select(['total_no_of_quantity'=>'SUM(total_no_of_quantity)','price'=>'SUM(price)','priceperqty'=>'SUM(priceperqty)'])
						 -> where(['BETWEEN','expiredate',$from,$to]) -> andWhere(['is_active' => 1])-> andWhere(['branch_id'=> $branch_id])->andWhere(['!=', 'total_no_of_quantity', 0])->orderBy(['productid'=>SORT_ASC])-> asArray() -> one();
		
			//Mapping
			$resultStockid = ArrayHelper::map($Stock_brand, 'stockid', 'stockid');
			$resultComp = ArrayHelper::map($Stock_brand, 'stockid', 'compositionid');
			$resultProduct = ArrayHelper::map($Stock_brand, 'stockid', 'productid');
			$resultUnit = ArrayHelper::map($Stock_brand, 'stockid', 'unitid');
			$resultVendor = ArrayHelper::map($Stock_brand, 'stockid', 'vendorid');
			
			
			//Mapping Fetch
			$Composition=Composition::find()->where(['is_active'=>1])->andWhere(['IN','composition_id',$resultComp])->asArray()->all();
			$Unit=Unit::find()->where(['is_active'=>1])->andWhere(['IN','unitid',$resultUnit])->asArray()->all();
			$Product=Product::find()->where(['IN','productid',$resultProduct])->asArray()->all();
			$Stockresponse=Stockresponse::find()->where(['IN','stockid',$resultStockid])->asArray()->all();
			$Vendor=Vendor::find()->where(['IN','vendorid',$resultVendor])->asArray()->all();
			
			//Indexing Fetch
			$CompIndex=ArrayHelper::index($Composition,'composition_id');
			$UnitIndex=ArrayHelper::index($Unit,'unitid');
			$ProductIndex=ArrayHelper::index($Product,'productid');
			$StockMasterIndex=ArrayHelper::index($Stock_brand,'stockid');
			$VendorMasterIndex=ArrayHelper::index($Vendor,'vendorid');
			
			//Product Type
			$resultProductmap = ArrayHelper::map($Product, 'productid', 'product_typeid');
			$Producttype=Producttype::find()->where(['is_active'=>1])->andWhere(['IN','product_typeid',$resultProductmap])->asArray()->all();
			$ProducttypeIndex=ArrayHelper::index($Producttype,'product_typeid');
			if(!empty($Stock_brand))
			{		//set_time_limit(0);
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage('L');
					
					
						$tbl1='<div><h1 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h1>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
						$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">NEARING EXPIRY REPORT</p>';
						$tbl1.='</div><hr>';
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT">';
						$tbl1.='<thead><tr><th  ALIGN="left" width="5%"><b>SNO</b></th>';
						$tbl1.='<th ALIGN="left" width="23%"><b>Vendor Name</b></th>';
						$tbl1.='<th ALIGN="center"><b>Batch No</b></th>';
						$tbl1.='<th ALIGN="right"><b>Price</b></th>';
						$tbl1.='<th ALIGN="right"><b>Price/Qty</b></th>';
						$tbl1.='<th ALIGN="center"><b>Expire Date</b></th>';
						$tbl1.='<th ALIGN="right"><b>Available Stock</b></th></tr></thead></table><hr>';
						$tot_mrp=0;
						$total_available_quantity1=0;
						
						
						$fisrt_id=$Stock_brand[0]['productid'];
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$ProductIndex[$fisrt_id]['productname'].' - '.$CompIndex[$Stock_brand[0]['compositionid']]['composition_name'].'</font></b></td></tr></table>';
						$i=1;
						$inc=0;
					
						
					
						foreach ($Stock_brand as $key => $value) 
						{
							
							if(isset($StockMasterIndex[$value['stockid']]))
							{
								$productid=$StockMasterIndex[$value['stockid']]['productid'];
								$compositionid=$StockMasterIndex[$value['stockid']]['compositionid'];
								$unitid=$StockMasterIndex[$value['stockid']]['unitid'];
								
								//Stock Master Fetch
								$batchno=$StockMasterIndex[$value['stockid']]['batchnumber'];
								$stockcode=$StockMasterIndex[$value['stockid']]['stockcode'];
								$brandcode=$StockMasterIndex[$value['stockid']]['brandcode'];
								$priceperqty=$StockMasterIndex[$value['stockid']]['priceperqty'];
								$priceperqty=round($priceperqty, 2);
								$tot_mrp+=$priceperqty;
								
								$purchaseprice=$StockMasterIndex[$value['stockid']]['price'];
								
								$total_no_of_quantity=$StockMasterIndex[$value['stockid']]['total_no_of_quantity'];
								
								
								$expiredate=$StockMasterIndex[$value['stockid']]['expiredate'];
								$exp=date('d-m-Y',strtotime($expiredate));
								$total_available_quantity=$StockMasterIndex[$value['stockid']]['total_no_of_quantity'];
								$total_available_quantity1+=$total_available_quantity;
								
								if($productid != "")
								{
									if(isset($ProductIndex[$productid]))
									{
										$product_name=$ProductIndex[$productid]['productname'];
										$product_type=$ProductIndex[$productid]['product_typeid'];
										$prd_type=$ProducttypeIndex[$product_type]['product_type'];				
									}
								}
								
								if($compositionid != "")
								{
									if(isset($CompIndex[$compositionid]))
									{
										$compositionname=$CompIndex[$compositionid]['composition_name'];
									}
								}
								
								if($unitid != "")
								{
									if(isset($UnitIndex[$unitid]))
									{
										$unitname=$UnitIndex[$unitid]['unitvalue'];
									}
								}
							}
							if($fisrt_id == $value['productid'])
							{
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
									<tr><td ALIGN="left" width="5%">'.$i.'</td>
									<td ALIGN="left" width="23%">'.$VendorMasterIndex[$value['vendorid']]['vendorname'].'</td>
									<td ALIGN="center">'.$batchno.'</td>
									<td ALIGN="right">'.$purchaseprice.'</td>
									<td ALIGN="right">'.$priceperqty.'</td>
									
									<td ALIGN="center">'.$exp.'</td>
									<td ALIGN="right">'.$total_no_of_quantity.'</td></tr></table><hr>';
							}
							else if($fisrt_id != $value['productid'])
							{
									$fisrt_id=$value['productid'];
									
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$ProductIndex[$fisrt_id]['productname'].' - '.$CompIndex[$value['compositionid']]['composition_name'].'</font></b></td></tr></table>';
									
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
									<tr><td ALIGN="left" width="5%">'.$i.'</td>
									<td ALIGN="left" width="23%">'.$VendorMasterIndex[$value['vendorid']]['vendorname'].'</td>
									<td ALIGN="center">'.$batchno.'</td>
									<td ALIGN="right">'.$purchaseprice.'</td>
									<td ALIGN="right">'.$priceperqty.'</td>
									
									<td ALIGN="center">'.$exp.'</td>
									<td ALIGN="right">'.$total_no_of_quantity.'</td></tr></table><hr>';
							}
						$i++;
						
						}
						
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								<tr><td ALIGN="left" style="color:red;">Total</td>
								<td ALIGN="left" ></td>
								<td ALIGN="center"></td>
								<td ALIGN="right" style="color:red;">'.$this->computevalue($Stock_brand_group['price']).'</td>
								<td ALIGN="right" style="color:red;">'.$this->computevalue($Stock_brand_group['priceperqty']).'</td>
								
								<td ALIGN="center"></td>
								<td ALIGN="right" style="color:red;">'.$Stock_brand_group['total_no_of_quantity'].'</td></tr></table><hr>';
					
					//$html = drupal_render(node_view($tbl1));
					$pdf->writeHTML($tbl1, true, false, false, false, '');
		    		$pdf->lastPage();
					$pdf->Output('example_001.pdf');
					die;	
		}

	}
  }
	

	public function actionPricelistpdf()
  	{	
		if($_POST)
		{
				
			
			$branch_id=$_POST['Branch']['branchnamepricelist'];
			$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['branch_id'=> $branch_id])->andWhere(['!=', 'total_no_of_quantity', 0])->orderBy(['productid'=>SORT_ASC])-> asArray() -> all();
			
			$Stock_brand_group=Stockmaster::find()->select(['total_no_of_quantity'=>'SUM(total_no_of_quantity)','price'=>'SUM(price)','priceperqty'=>'SUM(priceperqty)'])
						 -> where(['is_active' => 1])-> andWhere(['branch_id'=> $branch_id])->andWhere(['!=', 'total_no_of_quantity', 0])->orderBy(['productid'=>SORT_ASC])-> asArray() -> one();
		//	echo '<pre>';
			//print_r($Stock_brand_group);die;
			//Mapping
			$resultStockid = ArrayHelper::map($Stock_brand, 'stockid', 'stockid');
			$resultComp = ArrayHelper::map($Stock_brand, 'stockid', 'compositionid');
			$resultProduct = ArrayHelper::map($Stock_brand, 'stockid', 'productid');
			$resultUnit = ArrayHelper::map($Stock_brand, 'stockid', 'unitid');
			$resultVendor = ArrayHelper::map($Stock_brand, 'stockid', 'vendorid');
			
			
			//Mapping Fetch
			$Composition=Composition::find()->where(['is_active'=>1])->andWhere(['IN','composition_id',$resultComp])->asArray()->all();
			$Unit=Unit::find()->where(['is_active'=>1])->andWhere(['IN','unitid',$resultUnit])->asArray()->all();
			$Product=Product::find()->where(['IN','productid',$resultProduct])->asArray()->all();
			$Stockresponse=Stockresponse::find()->where(['IN','stockid',$resultStockid])->asArray()->all();
			$Vendor=Vendor::find()->where(['IN','vendorid',$resultVendor])->asArray()->all();
			
			//Indexing Fetch
			$CompIndex=ArrayHelper::index($Composition,'composition_id');
			$UnitIndex=ArrayHelper::index($Unit,'unitid');
			$ProductIndex=ArrayHelper::index($Product,'productid');
			$StockMasterIndex=ArrayHelper::index($Stock_brand,'stockid');
			$VendorMasterIndex=ArrayHelper::index($Vendor,'vendorid');
			
			//Product Type
			$resultProductmap = ArrayHelper::map($Product, 'productid', 'product_typeid');
			$Producttype=Producttype::find()->where(['is_active'=>1])->andWhere(['IN','product_typeid',$resultProductmap])->asArray()->all();
			$ProducttypeIndex=ArrayHelper::index($Producttype,'product_typeid');
			if(!empty($Stock_brand))
			{		//set_time_limit(0);
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage('L');
					
					
						$tbl1='<div><h1 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h1>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
						$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">MEDICINE WISE REPORT</p>';
						$tbl1.='</div><hr>';
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT">';
						$tbl1.='<thead><tr><th  ALIGN="left" width="5%"><b>SNO</b></th>';
						$tbl1.='<th ALIGN="left" width="23%"><b>Vendor Name</b></th>';
						$tbl1.='<th ALIGN="center"><b>Batch No</b></th>';
						$tbl1.='<th ALIGN="right"><b>Price</b></th>';
						$tbl1.='<th ALIGN="right"><b>Price/Qty</b></th>';
						$tbl1.='<th ALIGN="center"><b>Expire Date</b></th>';
						$tbl1.='<th ALIGN="right"><b>Available Stock</b></th></tr></thead></table><hr>';
						$tot_mrp=0;
						$total_available_quantity1=0;
						
						
						$fisrt_id=$Stock_brand[0]['productid'];
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$ProductIndex[$fisrt_id]['productname'].' - '.$CompIndex[$Stock_brand[0]['compositionid']]['composition_name'].'</font></b></td></tr></table>';
						$i=1;
						$inc=0;
					
						
					
						foreach ($Stock_brand as $key => $value) 
						{
							
							if(isset($StockMasterIndex[$value['stockid']]))
							{
								$productid=$StockMasterIndex[$value['stockid']]['productid'];
								$compositionid=$StockMasterIndex[$value['stockid']]['compositionid'];
								$unitid=$StockMasterIndex[$value['stockid']]['unitid'];
								
								//Stock Master Fetch
								$batchno=$StockMasterIndex[$value['stockid']]['batchnumber'];
								$stockcode=$StockMasterIndex[$value['stockid']]['stockcode'];
								$brandcode=$StockMasterIndex[$value['stockid']]['brandcode'];
								$priceperqty=$StockMasterIndex[$value['stockid']]['priceperqty'];
								$priceperqty=round($priceperqty, 2);
								$tot_mrp+=$priceperqty;
								
								$purchaseprice=$StockMasterIndex[$value['stockid']]['price'];
								
								$total_no_of_quantity=$StockMasterIndex[$value['stockid']]['total_no_of_quantity'];
								
								
								$expiredate=$StockMasterIndex[$value['stockid']]['expiredate'];
								$exp=date('d-m-Y',strtotime($expiredate));
								$total_available_quantity=$StockMasterIndex[$value['stockid']]['total_no_of_quantity'];
								$total_available_quantity1+=$total_available_quantity;
								
								if($productid != "")
								{
									if(isset($ProductIndex[$productid]))
									{
										$product_name=$ProductIndex[$productid]['productname'];
										$product_type=$ProductIndex[$productid]['product_typeid'];
										$prd_type=$ProducttypeIndex[$product_type]['product_type'];				
									}
								}
								
								if($compositionid != "")
								{
									if(isset($CompIndex[$compositionid]))
									{
										$compositionname=$CompIndex[$compositionid]['composition_name'];
									}
								}
								
								if($unitid != "")
								{
									if(isset($UnitIndex[$unitid]))
									{
										$unitname=$UnitIndex[$unitid]['unitvalue'];
									}
								}
							}
							if($fisrt_id == $value['productid'])
							{
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
									<tr><td ALIGN="left" width="5%">'.$i.'</td>
									<td ALIGN="left" width="23%">'.$VendorMasterIndex[$value['vendorid']]['vendorname'].'</td>
									<td ALIGN="center">'.$batchno.'</td>
									<td ALIGN="right">'.$purchaseprice.'</td>
									<td ALIGN="right">'.$priceperqty.'</td>
									
									<td ALIGN="center">'.$exp.'</td>
									<td ALIGN="right">'.$total_no_of_quantity.'</td></tr></table><hr>';
							}
							else if($fisrt_id != $value['productid'])
							{
									$fisrt_id=$value['productid'];
									
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$ProductIndex[$fisrt_id]['productname'].' - '.$CompIndex[$value['compositionid']]['composition_name'].'</font></b></td></tr></table>';
									
									$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
									<tr><td ALIGN="left" width="5%">'.$i.'</td>
									<td ALIGN="left" width="23%">'.$VendorMasterIndex[$value['vendorid']]['vendorname'].'</td>
									<td ALIGN="center">'.$batchno.'</td>
									<td ALIGN="right">'.$purchaseprice.'</td>
									<td ALIGN="right">'.$priceperqty.'</td>
									
									<td ALIGN="center">'.$exp.'</td>
									<td ALIGN="right">'.$total_no_of_quantity.'</td></tr></table><hr>';
							}
						$i++;
						
						}
						
						
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								<tr><td ALIGN="left" style="color:red;">Total</td>
								<td ALIGN="left" ></td>
								<td ALIGN="center"></td>
								<td ALIGN="right" style="color:red;">'.$this->computevalue($Stock_brand_group['price']).'</td>
								<td ALIGN="right" style="color:red;">'.$this->computevalue($Stock_brand_group['priceperqty']).'</td>
								
								<td ALIGN="center"></td>
								<td ALIGN="right" style="color:red;">'.$Stock_brand_group['total_no_of_quantity'].'</td></tr></table><hr>';
					
					//$html = drupal_render(node_view($tbl1));
					$pdf->writeHTML($tbl1, true, false, false, false, '');
		    		$pdf->lastPage();
					$pdf->Output('example_001.pdf');
					die;
			}
			
				
		}
	 
	}


	public function actionUserwise()
  	{	
		if($_POST)
		{
			
			$fromDate=date('Y-m-d H:i:s',strtotime($_POST['fromDate1']));
			$toDate=date('Y-m-d H:i:s',strtotime($_POST['toDate1']));
			$userid=$_POST['Username']['id'];
			
			$Sale=Sales::find()->where(['IN','updated_by', $userid])->andWhere(['BETWEEN','updated_on',$fromDate,$toDate])->andWhere(['return_status'=>'N'])->asArray()->all();
			$fetchUsernames = ArrayHelper::map($Sale, 'opsaleid', 'updated_by');
			
			$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$fetchUsernames])->asArray()->all();
			$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
			
		
			
			if(!empty($Sale))
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
						
						//start
						$tbl1='<div style="width:800px;margin:0 auto;">';
						$tbl1.='<div style="text-align:center"> <font size="8"> This report Displays Detailed Total of Selected user considering User Role,Invoice Date,Invoice Time,Bill Number,User Name,Overall Total columns</font> </div>';
						$tbl1.='<h4 style="text-align:center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>From Date : '.$_POST['fromDate1'].'</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            						 <span>To Date : '.$_POST['toDate1'].'</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>';
						$tbl1.='<div style="text-align:center"><u><b>USER WISE COLLECTION PHARMACY</b> </u> </div>';
						$tbl1.='<div><font size="8"> <b>Verification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>This data can be verfied by comparing each user Grand Total of UserWiseReports->All Users Collection </font></div> ';
						
						$tbl1.='<div><hr>';
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="CENTER">';
						$tbl1.='<tr>
                  <td width="15%" ><b>User Role</b></td>
                  <td width="15%" ><B>Invoice Date</b></td>
                  <td width="15%"  ><b>Invoice Time</b></td>
                  <td width="25%" ><b>Bill Number</b></td>
                  <td width="20%"><b>User Name</b></td>
                  <td style="text-align:left;"  width="20%" ><b>Overall Total</b></td>
               </tr></table><hr>';
						
						
					$total=0;	
					$grand_total=0;
				foreach ($Sale as $key => $value) 
				{
					
					$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="CENTER">
				               <tr>
				                  <td width="15%" > '.$dataJobMaster[$value['updated_by']]['authUserRole'].' </td>
				                  <td width="15%"  > '.date('d-m-Y',strtotime($value['invoicedate'])).' </td>
				                  <td width="15%"  >'.date('H:i:s',strtotime($value['invoicedate'])).'</td>
				                  <td width="25%" >'.$value['billnumber'].'</td>
				                  <td width="20%">'.$dataJobMaster[$value['updated_by']]['ba_name'].'</td>
				                  <td style="text-align:right;"  width="0%" >'.$value['overalltotal'].'</td>
				               </tr>
            				</table>';
					$grand_total+=$value['overalltotal'];
				}
				$tbl1.='<hr><table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="CENTER">
				               <tr>
				                  <td width="15%" >  </td>
				                  <td width="15%"  >  </td>
				                  <td width="15%"  ></td>
				                  <td width="25%" ></td>
				                  <td  style="color:red;"   width="20%"><b>Grand Total</b></td>
				                  <td style="text-align:right;color:red;"  width="0%" ><b>'.$grand_total.'</b></td>
				               </tr>
            				</table><hr>';
				$tbl1.='</div>';
				
				$pdf->writeHTML($tbl1, true, false, false, false, '');
		    	$pdf->Output('example_001.pdf');
			}
				
		}
	}


	public function actionItemwisesale()
  	{
  		if($_POST)
		{
			
				$fromDate=date('Y-m-d H:i:s',strtotime($_POST['fromDate2'].' 00:00:00'));
			
				$toDate=date('Y-m-d H:i:s',strtotime($_POST['toDate2'].' 23:59:59'));
				
				$product_name=$_POST['Productname']['id'];
				
				
				$Sale_detail=Saledetail::find()->where(['IN','productid',$product_name])->andWhere(['BETWEEN','saledate',$fromDate,$toDate])->andWhere(['return_status'=>'N'])->orderBy(['productid'=>SORT_ASC])->asArray()->all();
			
				$Salebatch_group=Saledetail::find()->select(['productqty'=>'SUM(productqty)','mrpperunit'=>'SUM(mrpperunit)','gstvalue'=>'SUM(gstvalue)','total_price_perqty'=>'SUM(total_price_perqty)'])->where(['IN','productid',$product_name])->andWhere(['BETWEEN','saledate',$fromDate,$toDate])->andWhere(['return_status'=>'N'])->orderBy(['productid'=>SORT_ASC])->groupBy(['productid'])->asArray()->all();
				
				$Salebatch_group_overall=Saledetail::find()->select(['productqty'=>'SUM(productqty)','mrpperunit'=>'SUM(mrpperunit)','gstvalue'=>'SUM(gstvalue)','total_price_perqty'=>'SUM(total_price_perqty)'])->where(['IN','productid',$product_name])->andWhere(['BETWEEN','saledate',$fromDate,$toDate])->andWhere(['return_status'=>'N'])->asArray()->one();
				
				
				$sales_map=ArrayHelper::map($Sale_detail, 'opsale_detailid', 'opsaleid');
				$Sales=Sales::find()->where(['IN','opsaleid',$sales_map])->asArray()->all();
				$sales_index = ArrayHelper::index($Sales,'opsaleid');
				
				$branch_map=ArrayHelper::map($Sale_detail, 'opsale_detailid', 'updated_by');
				$BranchAdmin=BranchAdmin::find()->where(['IN','ba_autoid',$branch_map])->asArray()->all();
				$branch_index = ArrayHelper::index($BranchAdmin,'ba_autoid');
				
				$product_map=ArrayHelper::map($Sale_detail, 'opsale_detailid', 'productid');
				$Product=Product::find()->where(['IN','productid',$product_map])->asArray()->all();
				$Product_index = ArrayHelper::index($Product,'productid');
				
				if(!empty($Sale_detail))
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
					$pdf->SetFont('helvetica', '', 8, '', true);
					$pdf->AddPage('L');
					
					
					$tbl1='<div><h2 style="text-align:center;color:red;">Dinesh Medical Center</h2>';
					$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
					$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
					$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
					$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
					$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">ITEM WISE SALES REPORT</p>';
					$tbl1.='</div>';
					$tbl1.='<div><h3><span>From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>To Date '.date('d-m-Y',strtotime($toDate)).'</span></h3><hr>';
					
					$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
					$tbl1.='<td  ALIGN="CENTER"><B>SNO</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>SALEDATE</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>MRNUMBER</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>NAME</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>BATCHNO</b></td>';
					$tbl1.='<td  ALIGN="RIGHT"><b>QTY</b></td>';
					$tbl1.='<td  ALIGN="RIGHT"><b>MRP</b></td>';
					$tbl1.='<td  ALIGN="RIGHT"><b>DISC</b></td>';
					$tbl1.='<td  ALIGN="RIGHT"><b>GST</b></td>';
					$tbl1.='<td  ALIGN="RIGHT"><b>NET AMT</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>USER NAME</b></td>';
					$tbl1.='<td  ALIGN="CENTER"><b>TIME</b></td>';
					$tbl1.='</tr></table><hr>';
					
					$i=1;
					
					$fist_batch=$Sale_detail[0]['productid'];
					
					$tbl1.='<div><b>Product Name: '.$Product_index[$fist_batch]['productname'].'</b></div>';
					$sale_group=0;
					foreach ($Sale_detail as $key => $value) 
					{
						if($fist_batch == $value['productid'])
						{
							$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
							$tbl1.='<td  ALIGN="CENTER">'.$i.'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.date('d-m-Y',strtotime($value['saledate'])).'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$sales_index[$value['opsaleid']]['mrnumber'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$sales_index[$value['opsaleid']]['name'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$value['batchnumber'].'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$value['productqty'].'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['mrpperunit']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT">0</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['gstvalue']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['total_price_perqty']).'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$branch_index[$value['updated_by']]['ba_name'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.date('H:i:s',strtotime($value['saledate'])).'</td>';
							$tbl1.='</tr></table><hr>';
						}
						else if($fist_batch != $value['productid'])
						{
							$fist_batch=$value['productid'];
							
							$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
							$tbl1.='<td  ALIGN="CENTER" style="color:green;">TOTAL</td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$Salebatch_group[$sale_group]['productqty'].'</td>';
							$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['mrpperunit']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT"></td>';
							$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['gstvalue']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['total_price_perqty']).'</td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='<td  ALIGN="CENTER"></td>';
							$tbl1.='</tr></table><hr>';
							
							$tbl1.='<div><b>Product Name: '.$Product_index[$value['productid']]['productname'].'</b></div>';
							$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
							$tbl1.='<td  ALIGN="CENTER">'.$i.'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.date('d-m-Y',strtotime($value['saledate'])).'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$sales_index[$value['opsaleid']]['mrnumber'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$sales_index[$value['opsaleid']]['name'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$value['batchnumber'].'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$value['productqty'].'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['mrpperunit']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT">0</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['gstvalue']).'</td>';
							$tbl1.='<td  ALIGN="RIGHT">'.$this->computevalue($value['total_price_perqty']).'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.$branch_index[$value['updated_by']]['ba_name'].'</td>';
							$tbl1.='<td  ALIGN="CENTER">'.date('H:i:s',strtotime($value['saledate'])).'</td>';
							$tbl1.='</tr></table><hr>';
							
							$sale_group++;
						}
						$i++;
					}
					
					$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
					$tbl1.='<td  ALIGN="CENTER" style="color:green;">TOTAL</td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$Salebatch_group[$sale_group]['productqty'].'</td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['mrpperunit']).'</td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:green;"></td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['gstvalue']).'</td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($Salebatch_group[$sale_group]['total_price_perqty']).'</td>';
					$tbl1.='<td  ALIGN="CENTER" ></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='</tr></table><hr>';
					
				
					
					$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
					$tbl1.='<td  ALIGN="CENTER" style="color:red;">GRAND TOTAL</td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:red;">'.$Salebatch_group_overall['productqty'].'</td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:red;">'.$this->computevalue($Salebatch_group_overall['mrpperunit']).'</td>';
					$tbl1.='<td  ALIGN="RIGHT"></td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:red;">'.$this->computevalue($Salebatch_group_overall['gstvalue']).'</td>';
					$tbl1.='<td  ALIGN="RIGHT" style="color:red;">'.$this->computevalue($Salebatch_group_overall['total_price_perqty']).'</td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='<td  ALIGN="CENTER"></td>';
					$tbl1.='</tr></table><hr>';
					
					$pdf->writeHTML($tbl1, true, false, false, false, '');
				    $pdf->Output('example_001.pdf');
				}
	   }
	}


	/*public function actionItemwisesale()
  	{
  		if($_POST)
		{
			
			$fromDate=date('Y-m-d H:i:s',strtotime($_POST['fromDate2']));
			$toDate=date('Y-m-d H:i:s',strtotime($_POST['toDate2']));
			$Item=$_POST['Item'];
			$Sale_detail=Saledetail::find()->where(['productid' =>$Item])->andWhere(['BETWEEN','saledate',$fromDate,$toDate])->andWhere(['return_status'=>'Y'])->asArray()->all();
			$product=Productgrouping::find()->where(['is_active'=>1])->andWhere(['productid'=>$Item])->asArray()->one();
			$vendor=Vendor::find()->where(['is_active'=>1])->andWhere(['vendorid'=>$product['vendorid']])->asArray()->one();
			$mapUser = ArrayHelper::map($Sale_detail, 'opsale_detailid', 'updated_by');
			$userdata=BranchAdmin::find()->where(['IN','ba_autoid',$mapUser])->asArray()->all();
			$dataUser = ArrayHelper::index($userdata,'ba_autoid');
			
			if(!empty($Sale_detail))
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
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
						
						
						$tbl1='<div><div><h2 style="text-align:center;">'.$vendor['vendorname'].'</h2></div>';
						$tbl1.='<div><h2 style="text-align:center;">ITEM WISE SALE REPORT</h2></div>';
						
						$tbl1.='<div><h3 style="text-align:center;">From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;To Date '.date('d-m-Y',strtotime($toDate)).'</h3></div><br>';
						$tbl1.='<p>________________________________________________________________________________________________________________________</p>';
						$tbl1.='<table><thead><tr><th><h3>S No.</h3></th><th><h3>MISSUEDT</h3></th><th><h3>BATCHNO</h3></th><th><h3>QTY</h3></th><th><h3>MRP</h3></th><th><h3>NETAMT</h3></th><th><h3>USERNM</h3></th></tr>';
						$tbl1.='<tr><th colspan="7">_____________________________________________________________________________________________________________________</th></tr></thead><tbody>';
					$i=1;
				foreach ($Sale_detail as $key => $value) 
				{
						//$tbl1.='<tr><td colspan="7"><h3><b><u>BATCHNO:'.$value['batchnumber'].'</u></b></h3></td></tr>';
						$tbl1.='<tr><td><h3>'.$i.'</h3></td>';
						$tbl1.='<td><h3>'.date('d-m-Y',strtotime($value['saledate'])).'</h3></td>';
						$tbl1.='<td><h3>'.$value['batchnumber'].'</h3></td>';
						$tbl1.='<td><h3>'.$value['mrpperunit'].'</h3></td>';
						$tbl1.='<td><h3>'.$value['productqty'].'</h3></td>';
						$mul=$value['mrpperunit'];
						$prd=$value['productqty'];
						$tot=$mul*$prd;
						$tbl1.='<td><h3>'.$tot.'</h3></td>';
						$tbl1.='<td><h3>'.$dataUser[$value['updated_by']]['ba_name'].'</h3></td></tr>';
						$i++;
				}
				
				$tbl1.='</tbody></table>';
				$pdf->writeHTML($tbl1, true, false, false, false, '');
		    	$pdf->Output('example_001.pdf');
			}
		
			
		}
	}*/

	/*public function actionSupplierpdf()
  	{
		if($_POST)
		{
			//echo "<pre>";
			$fromDate=date('Y-m-d',strtotime($_POST['fromDate3']));
			$toDate=date('Y-m-d',strtotime($_POST['toDate3']));
			
			$Stockresponse=Stockresponse::find()->where(['BETWEEN','purchasedate',$fromDate,$toDate])->asArray()->all();
			$resultStockmaster = ArrayHelper::map($Stockresponse, 'stockresponseid', 'stockid');
			
			$Stock_master=Stockmaster::find() -> where(['is_active' => 1])->andWhere(['!=', 'total_no_of_quantity', 0])->andWhere(['IN','stockid',$resultStockmaster])-> asArray() -> all();
			
			
			$resultStockvendor = ArrayHelper::map($Stock_master, 'stockid', 'vendorid');
			
			
			$Vendor=Vendor::find()->where(['is_active'=>1])->andWhere(['IN','vendorid',$resultStockvendor])->asArray()->all();
			
			$StockmasterIndex=ArrayHelper::index($Stock_master,'stockid');
			$VendorIndex=ArrayHelper::index($Vendor,'vendorid');
			
			
			if(!empty($Stockresponse))
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
						$pdf->SetFont('helvetica', '', 5, '', true);
						$pdf->AddPage('L');
						
						$tbl1='
								<div><h2 style="text-align:center;color:red;">Dinesh Medical Center</h2>';
							
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
								$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">Supplier wise Report</p>';
								$tbl1.='</div>';
						
						$tbl1.='<div><h2>From Date: '.date('d-m-Y',strtotime($fromDate)).' &nbsp;&nbsp;To Date: '.date('d-m-Y',strtotime($toDate)).'</h2></div><br>';
						
						$tbl1.='<hr>';
						
						$tbl1.='<table><thead><tr><th><h2 style="text-align:left;">Sno</h2></th><th><h2 style="text-align:left;">GRNDT</h2></th><th><h2 style="text-align:left;">INV.NO</h2></th><th><h2 style="text-align:right;">TotalAmt</h2></th><th style="text-align:right;"><h2>DiscAmt</h2></th><th><h2 style="text-align:right;">TaxAmt</h2></th><th><h2 style="text-align:right;">NetAmt</h2></th></tr></thead></table><hr>';
						$sno=1;
						$totamt=0;
						$discamt=0;
						$taxamt=0;
						$netamt=0;
						foreach ($Stockresponse as $key => $value) 
						{
							
							if(isset($StockmasterIndex[$value['stockid']]))
							{
								
								//Stock Master Fetch
								$total_amount=$StockmasterIndex[$value['stockid']]['price'];
								
								$vendor=$StockmasterIndex[$value['stockid']]['vendorid'];
								if($vendor != '')
								{
									if(isset($VendorIndex[$vendor]))
									{
										$vendor_name=$VendorIndex[$vendor]['vendorname'];
									}
								}
							}

						
							
							$tbl1.='<table><thead><tr><th><h2 style="color:blue;">Supplier Name:</h2></th><th><h2>'.$vendor_name.'</h2></th><th></th><th></th></tr></thead></table><br><br><br>';
							
							$tbl1.='<table><thead><tr><th><h2>'.$sno.'</h2></th><th><h2>'.date('d-m-Y',strtotime($value['purchasedate'])).'</h2></th><th><h2>'.$value['request_code'].'</h2></th><th><h2 style="color:green;text-align:right;">'.$value['purchaseprice'].'</h2></th><th><h2 style="text-align:right;">'.$value['discountvalue'].'</h2></th><th><h2 style="text-align:right;">'.$value['gstvalue'].'</h2></th><th><h2 style="color:green;text-align:right;">'.ceil($value['purchaseprice']).'</h2></th></tr></thead></table><hr>';
								$totamt+=$value['purchaseprice'];
								$discamt+=$value['discountvalue'];
								$taxamt+=$value['gstvalue'];
								$netamt+=ceil($value['purchaseprice']);
						
						$sno++;
						}
						
						$tbl1.='<hr><table><thead><tr><th></th><th></th><th><h2 style="color:red;">Grand Total</h2></th><th><h2 style="color:green;text-align:right;">'.$totamt.'</h2></th><th><h2 style="text-align:right;">'.$discamt.'</h2></th><th><h2 style="text-align:right;">'.$taxamt.'</h2></th><th><h2 style="color:green;text-align:right;">'.$netamt.'</h2></th></tr></thead></table><hr>';
						$pdf->writeHTML($tbl1, true, false, false, false, '');
		    			$pdf->Output('example_001.pdf');
					
			}	
		}
	}*/
	
	
	
	public function actionSupplierpdf()
  	{
		if($_POST)
		{
			
			$fromDate=date('Y-m-d',strtotime($_POST['fromDate3']));
			$toDate=date('Y-m-d',strtotime($_POST['toDate3']));
			$vendorName=$_POST['Vendorname']['id'];
			
			$PurchaseLog=PurchaseLog::find()->where(['vendor_id'=>$vendorName])->andWhere(['BETWEEN','received_date',$fromDate,$toDate])->orderBy(['vendor_id'=>SORT_ASC])->all();
			
			
			
			$PurchaseLog_add=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['BETWEEN','received_date',$fromDate,$toDate])->groupBy(['vendor_id'])->orderBy(['vendor_id'=>SORT_ASC])->all();
			
			
			$PurchaseLog_add_last=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['BETWEEN','received_date',$fromDate,$toDate])->one();
			
			
			$vendor_id_map=ArrayHelper::map($PurchaseLog, 'purchase_id', 'vendor_id');
			$Vendor=Vendor::find()->where(['IN','vendorid',$vendor_id_map])->asArray()->all();
			$Vendor_index = ArrayHelper::index($Vendor,'vendorid');
				
			if(!empty($PurchaseLog))
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
						$pdf->SetFont('helvetica', '', 5, '', true);
						$pdf->AddPage('L');
						
						$tbl1='<div><h1 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h1>';
							
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
						$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">SUPPLIER WISE REPORT</p>';
						$tbl1.='</div>';
						
						$tbl1.='<div><h2><span>From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>To Date '.date('d-m-Y',strtotime($toDate)).'</span></h2><hr>';
						
						$tbl1.='<table CELLPADDING="1" STYLE="font-size: 10px;" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td ALIGN="left"  ><b>SI No</b></td>';
						$tbl1.='<td  ALIGN="CENTER"  ><B>Received Date</b></td>';
						$tbl1.='<td  ALIGN="CENTER"  ><b>Batch No</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>Qty</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>Free</b></td>';
						
						$tbl1.='<td  ALIGN="RIGHT"   ><b>Purchase Rate</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>GST(%)</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>GST(Amt)</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>MRP/Unit</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>MRP</b></td></tr></table><hr>';
						
						$vendorNamestatic=$PurchaseLog[0]['vendor_id'];
						//print_r($vendorNamestatic);die;
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$Vendor_index[$vendorNamestatic]['vendorname'].'</font></b></td></tr></table>';
						$i=1;
						$inc=0;
						foreach ($PurchaseLog as $key => $value) 
						{
							if($vendorNamestatic == $value['vendor_id'])
							{
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 8px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td  ALIGN="left">'.$i.'</td>';
								$tbl1.='<td  ALIGN="CENTER">'.date('d-m-Y',strtotime($value['received_date'])).'</td>';
								$tbl1.='<td  ALIGN="CENTER">'.$value['batch_number'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['received_qty'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['receivedfreequantity'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['purchase_price'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['gstpercent'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['gstvalue'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['mrpperunit'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['mrp'].'</td>';
								$tbl1.='</tr></table><hr>';
							}
							else if($vendorNamestatic != $value['vendor_id'])
							{
								$vendorNamestatic=$value['vendor_id'];
								
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" STYLE="font-size: 8px;" ALIGN="RIGHT"><tr>';
								$tbl1.='<td  ALIGN="left" style="color:green;">TOTAL</td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['received_qty'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['receivedfreequantity'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['purchase_price']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['gstpercent'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['mrpperunit']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</td>';
								$tbl1.='</tr></table><hr>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 10px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">'.$Vendor_index[$vendorNamestatic]['vendorname'].'</font></b></td></tr></table>';
								
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 8px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td  ALIGN="left">'.$i.'</td>';
								$tbl1.='<td  ALIGN="CENTER">'.date('d-m-Y',strtotime($value['received_date'])).'</td>';
								$tbl1.='<td  ALIGN="CENTER">'.$value['batch_number'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['received_qty'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['receivedfreequantity'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['purchase_price'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['gstpercent'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['gstvalue'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['mrpperunit'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT">'.$value['mrp'].'</td>';
								$tbl1.='</tr></table><hr>';
								
								
								$inc++;
							}
							
							$i++;
						}
						
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" STYLE="font-size: 8px;" ALIGN="RIGHT"><tr>';
								$tbl1.='<td  ALIGN="left" style="color:green;">TOTAL</td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['received_qty'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['receivedfreequantity'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['purchase_price']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$PurchaseLog_add[$inc]['gstpercent'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['mrpperunit']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:green;">'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</td>';
								$tbl1.='</tr></table><hr>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" STYLE="font-size: 8px;" ALIGN="RIGHT"><tr>';
								$tbl1.='<td  ALIGN="left" style="color:red;">GRAND TOTAL</td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								$tbl1.='<td  ALIGN="CENTER"></td>';
								
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$PurchaseLog_add_last['received_qty'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$PurchaseLog_add_last['receivedfreequantity'].'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$this->computevalue($PurchaseLog_add_last['purchase_price']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$PurchaseLog_add_last['gstpercent'].'</td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:red;">'.$this->computevalue($PurchaseLog_add_last['gstvalue']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$this->computevalue($PurchaseLog_add_last['mrpperunit']).'</td>';
								$tbl1.='<td  ALIGN="Right" style="color:red;">'.$this->computevalue($PurchaseLog_add_last['mrp']).'</td>';
								$tbl1.='</tr></table><hr>';
						
						
						$pdf->writeHTML($tbl1, true, false, false, false, '');
		    			$pdf->Output('example_001.pdf');
					
			}	
		}
	}
	
	
	//Summarized GST Purchase
	
	public function actionSummarizedgstpurchase()
  	{
		if($_POST)
		{
			//echo '<pre>';
			$fromDate=date('Y-m-d',strtotime($_POST['fromDate_GST_sales']));
			$toDate=date('Y-m-d',strtotime($_POST['toDate_GST_sales']));
			
				

			
			
			$PurchaseLog=PurchaseLog::find()->select(['gstpercent'=>'gstpercent','purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['BETWEEN','received_date',$fromDate,$toDate])->groupBy(['gstpercent','received_date'])->orderBy(['gstpercent'=>SORT_ASC,'received_date'=>SORT_ASC])->asArray()->all();
			
			
			
			$PurchaseLog_add=PurchaseLog::find()
						->select(['gstpercent'=>'gstpercent','purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['BETWEEN','received_date',$fromDate,$toDate])->groupBy(['gstpercent'])->orderBy(['gstpercent'=>SORT_ASC])->all();
		
			$PurchaseLog_add_last=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)','receivedfreequantity'=>'SUM(receivedfreequantity)','priceperquantity'=>'SUM(priceperquantity)','mrpperunit'=>'SUM(mrpperunit)'])
						->where(['BETWEEN','received_date',$fromDate,$toDate])->one();

				
			if(!empty($PurchaseLog))
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
						$pdf->SetFont('helvetica', '', 5, '', true);
						$pdf->AddPage();
						
						$tbl1='<div><h1 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h1>';
							
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
						$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">SUMMARIZED PURCHASE REPORT</p>';
						$tbl1.='</div>';
						
						$tbl1.='<div><h1><span>From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>To Date '.date('d-m-Y',strtotime($toDate)).'</span></h2><hr>';
						
						$tbl1.='<table CELLPADDING="1" STYLE="font-size: 12px;" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td ALIGN="left"  ><b>SI No</b></td>';
						$tbl1.='<td  ALIGN="CENTER"  ><B>Received Date</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>Sale Price</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>GST Amount</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>Total Amount</b></td></tr></table><hr>';
						
						
						$vendorNamestatic=$PurchaseLog[0]['gstpercent'];
						//print_r($vendorNamestatic);die;
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">Tax Type : '.$vendorNamestatic.'%</font></b></td></tr></table>';
						$i=1;
						$inc=0;
						foreach ($PurchaseLog as $key => $value) 
						{
							if($vendorNamestatic == $value['gstpercent'])
							{
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left"  >'.$i.'</td>';
								$tbl1.='<td  ALIGN="CENTER"  >'.date('d-m-Y',strtotime($value['received_date'])).'</td>';
								$tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['purchase_price']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($value['gstvalue']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrp']).'</td></tr></table><hr>';			
							}
							else if($vendorNamestatic != $value['gstpercent'])
							{
								$vendorNamestatic=$value['gstpercent'];
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:green;"  ><b>Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;" ><b>'.$this->computevalue($PurchaseLog_add[$inc]['purchase_price']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:green;"><b>'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:green;"><b>'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</b></td></tr></table><hr>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">Tax Type : '.$vendorNamestatic.'%</font></b></td></tr></table>';
								
								$tbl1.='<table CELLPADDING="1"  CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left"  >'.$i.'</td>';
								
								$tbl1.='<td  ALIGN="CENTER"  >'.date('d-m-Y',strtotime($value['received_date'])).'</td>';
								$tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['purchase_price']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($value['gstvalue']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['mrp']).'</td></tr></table><hr>';
								
								
								$inc++;
							}
							
							$i++;
						}
						
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:green;"  ><b>Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;" ><b>'.$this->computevalue($PurchaseLog_add[$inc]['purchase_price']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:green;"><b>'.$this->computevalue($PurchaseLog_add[$inc]['gstvalue']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:green;"><b>'.$this->computevalue($PurchaseLog_add[$inc]['mrp']).'</b></td></tr></table><hr>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:red;" ><b>Grant Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:red;" ><b>'.$this->computevalue($PurchaseLog_add_last['purchase_price']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:red;" ><b>'.$this->computevalue($PurchaseLog_add_last['gstvalue']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:red;"><b>'.$this->computevalue($PurchaseLog_add_last['mrp']).'</b></td></tr></table><hr>';
						
						
								$pdf->writeHTML($tbl1, true, false, false, false, '');
				    			$pdf->Output('example_001.pdf');
					
			}	
		}
	}
	
	
	
	//Summarized GST Sales
	
	public function actionSummarizedgstsales()
  	{
		if($_POST)
		{
			
			$fromDate=date('Y-m-d',strtotime($_POST['fromDate_GST_sales']));
			$toDate=date('Y-m-d',strtotime($_POST['toDate_GST_sales']));
			
			
			$Salesdetails=Saledetail::find()->select(['saledate'=>'saledate','gstrate'=>'gstrate','gstvalue'=>'SUM(gstvalue)','priceperqty'=>'SUM(priceperqty)','discountvalueperquantity'=>'SUM(discountvalueperquantity)','total_price_perqty' => 'SUM(total_price_perqty)'])
			->where(['BETWEEN','saledate',$fromDate.' 00:00:00',$toDate.' 23:59:00'])->groupBy(['date(saledate),gstrate'])->orderBy(['gstrate'=>SORT_ASC,'saledate'=>SORT_ASC])->asArray()->all();
			
		
			
			$Salesdetails_grouping=Saledetail::find()
						->select(['saledate'=>'saledate','gstrate'=>'gstrate','gstvalue'=>'SUM(gstvalue)','priceperqty'=>'SUM(priceperqty)','discountvalueperquantity'=>'SUM(discountvalueperquantity)','total_price_perqty' => 'SUM(total_price_perqty)'])
						->where(['BETWEEN','saledate',$fromDate.' 00:00:00',$toDate.' 23:59:59'])->groupBy(['gstrate'])->orderBy(['gstrate'=>SORT_ASC])->all();
			
			$Salesdetails_add_last=Saledetail::find()
						->select(['saledate'=>'saledate','gstrate'=>'gstrate','gstvalue'=>'SUM(gstvalue)','priceperqty'=>'SUM(priceperqty)','discountvalueperquantity'=>'SUM(discountvalueperquantity)','total_price_perqty' => 'SUM(total_price_perqty)'])
						->where(['BETWEEN','saledate',$fromDate.' 00:00:00',$toDate.' 23:59:59'])->one();
		
			
			
		
				
			if(!empty($Salesdetails))
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
						$pdf->SetFont('helvetica', '', 5, '', true);
						$pdf->AddPage();
						
						$tbl1='<div><h1 style="text-align:center;color:red;">DINESH MEDICAL CENTER</h1>';
							
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
						$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
						$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">SUMMARIZED SALES REPORT</p>';
						$tbl1.='</div>';
						
						$tbl1.='<div><h1><span>From Date '.date('d-m-Y',strtotime($fromDate)).' &nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>To Date '.date('d-m-Y',strtotime($toDate)).'</span></h2><hr>';
						
						$tbl1.='<table CELLPADDING="1" STYLE="font-size: 12px;" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr><td ALIGN="left"  ><b>SI No</b></td>';
						$tbl1.='<td  ALIGN="CENTER"  ><B>Received Date</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>Sale Price</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>GST Amount</b></td>';
						$tbl1.='<td  ALIGN="RIGHT" ><b>Discount Amount</b></td>';
						$tbl1.='<td  ALIGN="RIGHT"  ><b>Total Amount</b></td></tr></table><hr>';
						
						
						$vendorNamestatic=$Salesdetails[0]['gstrate'];
						
						
						
						//print_r($vendorNamestatic);die;
						$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">Tax Type : '.$vendorNamestatic.'%</font></b></td></tr></table>';
						$i=1;
						$inc=0;
						foreach ($Salesdetails as $key => $value) 
						{
							$discount_value=(!empty($value['discountvalueperquantity'])) ? $value['discountvalueperquantity'] : 0;
						
							
							if($vendorNamestatic == $value['gstrate'])
							{
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left"  >'.$i.'</td>';
								$tbl1.='<td  ALIGN="CENTER"  >'.date('d-m-Y',strtotime($value['saledate'])).'</td>';
								$tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['priceperqty']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($value['gstvalue']).'</td>';
								$tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($discount_value).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['total_price_perqty']) .'</td></tr></table><hr>';			
							}
							else if($vendorNamestatic != $value['gstrate'])
							{
								$vendorNamestatic=$value['gstrate'];
								$discount_value_group=(!empty($Salesdetails_grouping[$inc]['discountvalueperquantity'])) ? $Salesdetails_grouping[$inc]['discountvalueperquantity'] : 0;
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:green;"  ><b>Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;" ><b>'.$this->computevalue($Salesdetails_grouping[$inc]['priceperqty']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:green;"><b>'.$this->computevalue($Salesdetails_grouping[$inc]['gstvalue']).'</b></td>';
								$tbl1.='<td  ALIGN="RIGHT" ><b>'.$this->computevalue($discount_value_group).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:green;"><b>'.$this->computevalue($Salesdetails_grouping[$inc]['total_price_perqty']).'</b></td></tr></table><hr>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT"><tr><td  width="35%" colspan="2"><b> <font color="blue">Tax Type : '.$vendorNamestatic.'%</font></b></td></tr></table>';
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left"  >'.$i.'</td>';
								$tbl1.='<td  ALIGN="CENTER"  >'.date('d-m-Y',strtotime($value['saledate'])).'</td>';
								$tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['priceperqty']).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($value['gstvalue']).'</td>';
								$tbl1.='<td  ALIGN="RIGHT" >'.$this->computevalue($discount_value).'</td>';
						        $tbl1.='<td  ALIGN="RIGHT"  >'.$this->computevalue($value['total_price_perqty']).'</td></tr></table><hr>';	
								
								
								$inc++;
							}
							
							$i++;
						}
						
								
								$discount_value_group=(!empty($Salesdetails_grouping[$inc]['discountvalueperquantity'])) ? $value['discountvalueperquantity'] : 0;
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:green;"  ><b>Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:green;" ><b>'.$this->computevalue($Salesdetails_grouping[$inc]['priceperqty']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:green;"><b>'.$this->computevalue($Salesdetails_grouping[$inc]['gstvalue']).'</b></td>';
								$tbl1.='<td  ALIGN="RIGHT" ><b>'.$this->computevalue($discount_value_group).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:green;"><b>'.$this->computevalue($Salesdetails_grouping[$inc]['total_price_perqty']).'</b></td></tr></table><hr>';
								
								
								$discount_value_single=(!empty($Salesdetails_add_last['discountvalueperquantity'])) ? $Salesdetails_add_last['discountvalueperquantity'] : 0;
								
								$tbl1.='<table CELLPADDING="1" CELLSPACING="1" STYLE="font-size: 12px;" WIDTH="100%" VALIGN="MIDDLE" ALIGN="RIGHT"><tr>';
								$tbl1.='<td ALIGN="left" style="color:red;" ><b>Grant Total</b></td>';
								$tbl1.='<td  ALIGN="CENTER"  ></td>';
								$tbl1.='<td  ALIGN="RIGHT" style="color:red;" ><b>'.$this->computevalue($Salesdetails_add_last['priceperqty']).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT" style="color:red;" ><b>'.$this->computevalue($Salesdetails_add_last['gstvalue']).'</b></td>';
								$tbl1.='<td  ALIGN="RIGHT" ><b>'.$this->computevalue($discount_value_single).'</b></td>';
						        $tbl1.='<td  ALIGN="RIGHT"  style="color:red;"><b>'.$this->computevalue($Salesdetails_add_last['total_price_perqty']).'</b></td></tr></table><hr>';
						
						
								$pdf->writeHTML($tbl1, true, false, false, false, '');
		    					$pdf->Output('example_001.pdf');
					
			}	
		}
	}
	
	
	
	
	
	
	
	
	
	
	//GST Excel Report
	public function actionGstpurchaseexcel()
    {
    	
		
		
		if($_POST['fromDate_GST'] != '' && $_POST['toDate_GST'] != '')
		{
			
			$from=date('Y-m-d',strtotime($_POST['fromDate_GST']));
			$to=date('Y-m-d',strtotime($_POST['toDate_GST']));
			
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
							$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
							
							
						$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("Product Report")	
						-> setCellValue('A1', 'SNO')
						-> setCellValue('B1', 'Vendor Name')
						-> setCellValue('C1', 'Date of Purchase')
						-> setCellValue('D1', 'Qty')
						-> setCellValue('E1', 'Purchase Price')
						-> setCellValue('F1', 'Discount(%)')
						-> setCellValue('G1', 'Discount(Amt)')
						-> setCellValue('H1', 'GST (%)')
						-> setCellValue('I1', 'GST (Amt)')
						-> setCellValue('J1', 'CGST (%)')
						-> setCellValue('K1', 'CGST (Amt)')
						-> setCellValue('L1', 'SGST (%)')
						-> setCellValue('M1', 'SGST (Amt)')
						-> setCellValue('N1', 'Total Price');
						
						$all_post_key = array("SNO","Vendor_Name", "Date_of_Purchase", "Qty","Purchase_price" ,"Discount(%)", "Discount(Amt)","GST_(%)","GST_(Amt)", "CGST_(%)", "CGST_(Amt)", "SGST_(%)", "SGST_(Amt)","Total_Price");
						
					
						$PurchaseLog=PurchaseLog::find()
						->select(['purchase_id'=>'purchase_id','vendor_id'=>'vendor_id','received_date'=>'received_date','received_qty'=>'SUM(received_qty)',
						'purchase_price'=>'SUM(purchase_price)','discountpercent'=>'SUM(discountpercent)','discountvalue'=>'SUM(discountvalue)',
						'gstpercent'=>'SUM(gstpercent)','gstvalue'=>'SUM(gstvalue)','cgstpercent'=>'SUM(cgstpercent)','cgstvalue'=>'SUM(cgstvalue)',
						'sgstpercent'=>'SUM(sgstpercent)','sgstvalue'=>'SUM(sgstvalue)','mrp'=>'SUM(mrp)'])->where(['BETWEEN','received_date',$from,$to])->groupBy(['vendor_id'])->all();
						
						$vendor_map = ArrayHelper::map($PurchaseLog, 'purchase_id', 'vendor_id');
						$vendor_in = Vendor::find()->where(['IN','vendorid',$vendor_map])->asArray()->all(); 
						$vendor_index=ArrayHelper::index($vendor_in,'vendorid');
						//echo '<pre>';
						//print_r($PurchaseLog);die;
							
						$slno=1;
						$row = 2;
						
							
							foreach($PurchaseLog as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								
									if(isset($vendor_index[$one_data['vendor_id']]))
									{
										$vendor_name=$vendor_index[$one_data['vendor_id']]['vendorname'];
									}
								
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
										
										else if($one_field=="Vendor_Name")
										{
											if($vendor_name != '')
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $vendor_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											else 
											{
												$dash='-';
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $dash);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										}
										else if($one_field=="Date_of_Purchase")
										{
											
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, date('d-m-Y',strtotime($one_data['received_date'])));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											
										}
										else if($one_field=="Qty")
										{
											
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $one_data['received_qty']);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											
										}
										else if($one_field=="Purchase_price")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['purchase_price'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Discount(%)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['discountpercent'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Discount(Amt)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['discountvalue'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="GST_(%)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['gstpercent'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="GST_(Amt)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['gstvalue'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="CGST_(%)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['cgstpercent'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="CGST_(Amt)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['cgstvalue'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="SGST_(%)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['sgstpercent'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="SGST_(Amt)")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['sgstvalue'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Total_Price")
										{
												
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, number_format($one_data['mrp'], 2, '.', ''));
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										
										if($r_a>=90)
										{
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
				        $filename = "Product Report".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
		}
  }
  
  
  //GST Excel Report
	public function actionGstsalesexcel()
    {
    	
		
		
		if($_POST['fromDate_GST_sales'] != '' && $_POST['toDate_GST_sales'] != '')
		{
			
			$from=date('Y-m-d',strtotime($_POST['fromDate_GST_sales']));
			$to=date('Y-m-d',strtotime($_POST['toDate_GST_sales']));
			
			
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
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
							
							
						$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("Product Report")	
						-> setCellValue('A1', 'SNO')
						-> setCellValue('B1', 'MR Number')
						-> setCellValue('C1', 'Name')
						-> setCellValue('D1', 'Mobile Number')
						-> setCellValue('E1', 'Gender')
						-> setCellValue('F1', 'Physican Name')
						-> setCellValue('G1', 'Patient Type')
						-> setCellValue('H1', 'Insurance Type')
						-> setCellValue('I1', 'Bill Number')
						-> setCellValue('J1', 'Invoice Date')
						-> setCellValue('K1', 'Total Items')
						-> setCellValue('L1', 'Total Quantity')
						-> setCellValue('M1', 'Total GST (%)')
						-> setCellValue('N1', 'Total GST (Amt)')
						-> setCellValue('O1', 'Total SGST (%)')
						-> setCellValue('P1', 'Total SGST (Amt)')
						-> setCellValue('Q1', 'Total CGST (%)')
						-> setCellValue('R1', 'Total CGST (Amt)')
						-> setCellValue('S1', 'Discount Type')
						-> setCellValue('T1', 'Discount (%)')
						-> setCellValue('U1', 'Discount (Amt)')
						-> setCellValue('V1', 'Sub-Total')
						-> setCellValue('W1', 'Total')
						-> setCellValue('X1', 'Paid Status');
						
						$objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($styleCalibri);
						
						$all_post_key = array("SNO","MR_Number", "Name", "Mobile_Number","Gender" ,"Physican_Name", "Patient_Type",
						"Insurance_Type","Bill_Number","Invoice_Date","Total_Items","Total_Quantity",
						"GST_(%)","GST_(Amt)","SGST_(%)", "SGST_(Amt)","CGST_(%)", "CGST_(Amt)","Discount_Type","Discount_(%)","Discount (Amt)",
						"Sub-Total","Total","Paid_Status");
						
						
						$sales_log=Sales::find()->where(['BETWEEN','invoicedate',$from,$to])->all();
						
						$insurance_map=ArrayHelper::map($sales_log,'opsaleid','insurancetype');
						$insurance_in=Insurance::find()->where(['IN','insurance_typeid',$insurance_map])->all();
						$insurance_index=ArrayHelper::index($insurance_in,'insurance_typeid');
						
						
						$patient_type_map=ArrayHelper::map($sales_log,'opsaleid','patienttype');
						$patient_type_in=Patienttype::find()->where(['IN','type_id',$patient_type_map])->all();
						$patient_type_index=ArrayHelper::index($patient_type_in,'type_id');
						
						$patient_map=ArrayHelper::map($sales_log,'opsaleid','mrnumber');
						$patient_in=NewPatient::find()->where(['IN','mr_no',$patient_map])->all();
						$patient_index=ArrayHelper::index($patient_in,'mr_no');
						
						
							
						$slno=1;
						$row = 2;
						
							
							foreach($sales_log as $key => $one_data)
							{
									$r_a=65;$r_a1=64;
								
									
								
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										$mrnumber=$one_data['mrnumber'];
										$name=$one_data['name'];
										$mobile_number=$one_data['phonenumber'];
										$doctor_name=$one_data['physicianname'];
										$bill_number=$one_data['billnumber'];
										$invoice_date=date('d-m-Y',strtotime($one_data['invoicedate']));
										$total_items=$one_data['tot_no_of_items'];
										$total_qty=$one_data['tot_quantity'];
										$total_gst_percent=$one_data['total_gst_percent'];
										$total_cgst_percent=$one_data['total_cgst_percent'];
										$total_sgst_percent=$one_data['total_sgst_percent'];
										$total_gst_value=$one_data['totalgstvalue'];
										$total_cgst_value=$one_data['totalcgstvalue'];
										$total_sgst_value=$one_data['totalsgstvalue'];
										$discount_type=$one_data['overalldiscounttype'];
										$discount_percent=$one_data['overalldiscountpercent'];
										$discount_amount=$one_data['overalldiscountamount'];
										$sub_total_amount=$one_data['overall_sub_total'];
										$overall_total_amount=$one_data['overalltotal'];
										$paid_status=$one_data['paid_status'];
										
										
										//start
										if(isset($patient_index[$one_data['mrnumber']]['pat_sex']))
										{
											$gender=$patient_index[$one_data['mrnumber']]['pat_sex'];	
										}
										else
										{
											$gender='-';	
										}
										
										if(isset($patient_type_index[$one_data['patienttype']]['patient_type']))
										{
											$patient_type=$patient_type_index[$one_data['patienttype']]['patient_type'];	
										}
										else
										{
											$patient_type='-';	
										}
										
										if(isset($insurance_index[$one_data['insurancetype']]['insurance_type']))
										{
											$insurance=$insurance_index[$one_data['insurancetype']]['insurance_type'];	
										}
										else
										{
											$insurance='-';	
										}
										
										
										//end
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="MR_Number") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mrnumber);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Name") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $name);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Mobile_Number") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mobile_number);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Gender") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $gender);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Physican_Name") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row,  $doctor_name);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Patient_Type") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patient_type);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Insurance_Type") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $insurance);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Bill_Number") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $bill_number);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Invoice_Date") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $invoice_date);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										
										else if($one_field=="Total_Items") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_items);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Total_Quantity") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_qty);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="GST_(%)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_gst_percent);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="GST_(Amt)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_gst_value);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="SGST_(%)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_sgst_percent);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="SGST_(Amt)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_sgst_value);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="CGST_(%)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_cgst_percent);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="CGST_(Amt)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $total_cgst_value);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Discount_Type") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $discount_type);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Discount_(%)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $discount_percent);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Discount (Amt)") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $discount_amount);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Sub-Total") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $sub_total_amount);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Total") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $overall_total_amount);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else if($one_field=="Paid_Status") 
										{
											
											 $objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $paid_status);
											 $objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										
											
										
										if($r_a>=90)
										{
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
				        $filename = "Product Report".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
		}
		}

public function actionPatienthistorydetails()
{
	
	
	
	
$fromDate_patienthistorydetails=date('Y-m-d',strtotime($_POST['fromDate_patienthistorydetails']));	
$toDate_patienthistorydetails=date('Y-m-d',strtotime($_POST['toDate_patienthistorydetails']));	
$patient_mrno=$_POST['patient_mrno'];	
	
		
$sales=Sales::find()->select(['opsaleid'=>'opsaleid','name'=>'name','mrnumber'=>'mrnumber','billnumber'=>'billnumber'])->where(['mrnumber'=>$patient_mrno])->andWhere(['BETWEEN','created_at',$fromDate_patienthistorydetails.' 00:00:00',$toDate_patienthistorydetails.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->asArray()->all();
	
$sales_map=ArrayHelper::map($sales,'opsaleid','opsaleid');
$sales_index=ArrayHelper::index($sales,'opsaleid');


$sale_detail=Saledetail::find()->select(['opsale_detailid'=>'opsale_detailid','opsaleid'=>'opsaleid','productid'=>'productid',
'productqty'=>'productqty','batchnumber'=>'batchnumber','expiredate'=>'expiredate','new_mrp_perunit'=>'new_mrp_perunit','total_price_perqty'=>'total_price_perqty'
])->where(['IN','opsaleid',$sales_map])->andWhere(['>=','productqty', 1])->asArray()->all();
$sale_detail_index=ArrayHelper::index($sale_detail,'opsale_detailid');



$sales_fetch_map=ArrayHelper::map($sale_detail,'opsale_detailid','opsaleid');
$sales_fetch=Sales::find()->select(['opsaleid'=>'opsaleid','name'=>'name','mrnumber'=>'mrnumber','billnumber'=>'billnumber','created_at'=>'created_at'])
->where(['IN','opsaleid',$sales_fetch_map])->asArray()->all();
$sale_fetch_index=ArrayHelper::index($sales_fetch,'opsaleid');

$sales_fetch_sum=Sales::find()->select(['overalltotal'=>'SUM(overalltotal)'])
->where(['IN','opsaleid',$sales_fetch_map])->asArray()->one();


$product_map=ArrayHelper::map($sale_detail,'opsale_detailid','productid');
$product=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['IN','productid',$product_map])->asArray()->all();
$product_index=ArrayHelper::index($product,'productid');




require ('../../vendor/tcpdf/tcpdf.php');
$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 8, '', true);




$pdf->AddPage();




if(!empty($sales))
{
	$newpatient=Newpatient::find()->select(['mr_no'=>'mr_no','patientname'=>'patientname','insurance_type_id'=>'insurance_type_id','pat_type'=>'pat_type','pat_mobileno'=>'pat_mobileno'])->where(['mr_no'=>$patient_mrno])->asArray()->one();
	
	$patienttypemaster=ArrayHelper::map(PatientType::find()->asArray()->all(),'type_id','patient_type');
	$insurancemaster=ArrayHelper::map(Insurance::find()->asArray()->all(),'insurance_typeid','insurance_type');
	
	if($newpatient['insurance_type_id'] != '')
	{
		$insurance_name=$insurancemaster[$newpatient['insurance_type_id']];
	}
	else 
	{
		$insurance_name='';	
	}

	if($newpatient['pat_type'] != '')
	{
		$pat_type=$patienttypemaster[$newpatient['pat_type']];
	}
	else 
	{
		$pat_type='';
	}
	
	$title="(A UNIT OF CARMEL HEALTHCARE PVT LTD)";
	$headertable='<table cellspacing="0" cellpadding="1" >';
	$headertable.='<tr><td style="text-align:center;font-size:18px;" colspan="12" ><b>DINESH MEDICAL CENTRE</b></td></tr>';
	$headertable.='<tr ><td style="text-align:center;font-size:11px;" colspan="12" ><b>'.$title.'</b></td></tr>';
	$headertable.='<tr ><td style="text-align:center;font-size:11px;" colspan="12" ><p><b>D.NO:3-7-215-1, FIRST FLOOR BAKARAPURAM, PULIVENDULA - 516390 - KADAPA DIST,PH:08568 287557</b></p></td></tr>';
	$headertable.='<tr><td colspan="3"><b>DL NO-20F: AP/11/03/2017-137691</b></td><td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>21 : AP/11/03/2017-137690</b></td>
	<td colspan="3"><b>&nbsp;&nbsp;&nbsp; 20: AP/11/03/2017-137689</b></td><td colspan="3"><b>GSTIN : 37AADCC7476L1Z3</b></td></tr>';
	
	
	$headertable.='</table>';
	$headertable.='<p style="border-top:1px solid #000" ></p>
	<p style="text-align:center;font-size:12px;" ><b><u>PATIENT PURCHASE AND RETURN DETAILS</u></b></p><p></p>';
	
	$pdf->writeHTML($headertable, true, false, false, false, '');
	
	$patientdetails='<table style="text-align:center;font-size:10.5px;" border="1" cellspacing="0" cellpadding="0">';
	$patientdetails.='<tbody><tr><td style="font-size:12px;width:10%;"><b>MR NO</b></td><td style="font-size:12px;width:20%;"><b>PAT NAME</b></td><td style="font-size:12px;width:30%;"><b>TYPE</b></td><td style="font-size:12px;"><b>ORG NAME</b></td><td style="font-size:12px;"><b>PH.NO</b></td></tr>';
    $patientdetails.='<tr><td style="font-size:12px;">'.$patient_mrno.'</td><td style="font-size:12px;">'.strtoupper($newpatient['patientname']).'</td><td style="font-size:12px;">'.strtoupper($pat_type).'</td><td style="font-size:12px;">'.strtoupper($insurance_name).'</td><td style="font-size:12px;">'.$newpatient['pat_mobileno'].'</td></tr>';				
	$patientdetails.='</tbody></table>';
	
	$pdf->writeHTML($patientdetails, true, false, false, false, '');
	
	

	
	
	if(!empty($sale_detail))
	{
		//$purchasedetails='';
		
		$purchasedetails='
		 <p style="border-top:1px solid #000" ></p>
		 <table cellspacing="-5" cellpadding="-15" >
		    <tbody>
			   <tr>
			      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
				  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
				  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
				  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
				  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
				  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
			   </tr>
			</tbody>
		 </table>
		 <p style="border-top:1px solid #000" ></p>';
		$i=1;
		
		
		$pdf->writeHTML($purchasedetails, true, false, false, false, '');
		
		$sales_current=current($sale_fetch_index);
		
		/* $purchasedetails.='<p style="text-align:left;font-size:12px;color: blue;"><b>ISSUES</b></p>'; */
		$purchasedetails1='<p style="text-align:left;font-size:12px;"><span><b style="text-align:left;font-size:12px;color: blue;">ISSUES</b><br><b>BILL NO: '.$sales_current['billnumber'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($sales_current['created_at'])).'</b></span></p>';
		
		$pdf->writeHTML($purchasedetails1, true, false, false, false, '');
			$num_pages = $pdf->getNumPages();
		foreach ($sale_detail as $key => $value) 
		{
		
			
			
			$current_id=$value['opsaleid'];
			if($sales_current['opsaleid'] == $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat='
					
					 <table cellspacing="-5" cellpadding="-15" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						</tbody>
					 </table>
					';
					
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy); 
				}
				
				$purchasedetails2='
				<table  cellspacing="0" cellpadding="0">
				 <tbody>
				  <tr>
				    <td style="font-size:12px;width:36%;text-align:left;">'.$product_index[$value['productid']]['productname'].'</td>
					<td style="font-size:12px;width:12%;text-align:left; ">'.$value['productqty'].'</td>
					<td style="font-size:12px;width:14%;text-align:left; ">'.$value['batchnumber'].'</td>
					<td style="font-size:12px;text-align:left; ">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['new_mrp_perunit'].'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['total_price_perqty'].'</td>
				  </tr>
				 </tbody>
				</table>';
				
				$pdf->writeHTML($purchasedetails2, true, false, false, false, '');
				
				
			
			
				
				
				
			}
			else if($sales_current['opsaleid'] != $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				$sales_current['opsaleid']=$current_id;
				//$purchasedetails3='';
				$purchasedetails3='<p style=" font-size:12px;" ><span><b>BILL NO: '.$sale_fetch_index[$current_id]['billnumber'].'</b> <b>Date: '.date('d-m-Y',strtotime($sale_fetch_index[$current_id]['created_at'])).'</b></span></p>
				<table  cellspacing="0" cellpadding="0">
				  <tbody>
				   <tr>
				    <td style="font-size:12px;width:36%;text-align:left; ">'.$product_index[$value['productid']]['productname'].'</td>
					<td style="font-size:12px;width:12%;text-align:left; ">'.$value['productqty'].'</td>
					<td style="font-size:12px;width:14%;text-align:left; ">'.$value['batchnumber'].'</td>
					<td style="font-size:12px;text-align:left; ">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['new_mrp_perunit'].'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['total_price_perqty'].'</td>
				   </tr>
				  </tbody>
				</table>';
				$pdf->writeHTML($purchasedetails3, true, false, false, false, '');
			
				

			}
			
			$i++;
		}
	
				$purchasedetails4='<p style="border-top:1px solid #000" ></p>
				<table  cellspacing="-10" cellpadding="2"><tbody><tr><td colspan="4" style="text-align:right;font-size:12px;"><b>Total : </b></td><td style="text-align:right;font-size:12px;width:19%;"><b>'.number_format($sales_fetch_sum['overalltotal'],2).'</b></td></tr></tbody></table>
				<p style="border-top:1px solid #000" ></p>
				';
				
			
				$pdf->writeHTML($purchasedetails4, true, false, false, false, '');
			
		
			
		

				
	}	
	
	$salesreturn=Salesreturn::find()
->select(['return_id'=>'return_id','saleid'=>'saleid','return_invoicenumber'=>'return_invoicenumber','total'=>'total','return_amount'=>'return_amount','created_at'=>'created_at'])
->where(['IN','saleid',$sales_map])->asArray()->all();
$salesreturn_map=ArrayHelper::map($salesreturn,'return_id','return_id');
$salesreturn_index=ArrayHelper::index($salesreturn,'return_id');
		

$returndetail=Returndetail::find()
->select(['return_detailid'=>'return_detailid','return_id'=>'return_id','sale_detailid'=>'sale_detailid'
,'productid'=>'productid','productqty'=>'productqty','batchnumber'=>'batchnumber','expiredate'=>'expiredate'
,'mrp_per_unit'=>'mrp_per_unit','mrp'=>'mrp'])
->where(['IN','return_id',$salesreturn_map])->asArray()->all();




$product_return_map=ArrayHelper::map($returndetail,'return_detailid','productid');
$product_return=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['IN','productid',$product_return_map])->asArray()->all();
$product_return_index=ArrayHelper::index($product_return,'productid');
		

$salesreturn_fetch_sum=Salesreturn::find()->select(['total'=>'SUM(total)'])
->where(['IN','saleid',$sales_map])->asArray()->one();		
	//echo '<pre>';print_r($salesreturn_fetch_sum);die;
		
if(!empty($returndetail))
{
$returndetails='';


$i=1;


$salesreturn_first=current($salesreturn_index);


$returndetails_front='<p style="text-align:left;font-size:12px;color: blue;"><b>RETURN</b></p>
<p style="text-align:left;font-size:12px;"><span><b>BILL NO: '.$salesreturn_first['return_invoicenumber'].'</b></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($salesreturn_first['created_at'])).'</b></span></p>';


	$pdf->writeHTML($returndetails_front, true, false, false, false, '');


foreach ($returndetail as $key => $value) 
		{

			$current_id=$value['return_id'];
			if($salesreturn_first['return_id'] == $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat_return='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat_return, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				
				$returndetails_return='<table  cellspacing="0" cellpadding="0">
						<tbody>
							<tr><td style="text-align:left;font-size:12px;width:40%;">'.$product_return_index[$value['productid']]['productname'].'</td>
							<td style="text-align:center;font-size:12px;width:10%;">'.$value['productqty'].'</td>
							<td style="text-align:left;font-size:12px;width:15%;">'.$value['batchnumber'].'</td>
							<td style="text-align:left;font-size:12px;width:15%;">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
							<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp_per_unit'].'</td>
							<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp'].'</td></tr></tbody></table>';
				
				
				$pdf->writeHTML($returndetails_return, true, false, false, false, '');

			
			}
			else if($salesreturn_first['return_id'] != $current_id)
			{
				$salesreturn_first['return_id']=$current_id;
				
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat_return='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat_return, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				$returndetails_return_1='<p style="text-align:left;font-size:12px;" >
				<span><b>BILL NO: '.$salesreturn_index[$current_id]['return_invoicenumber'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($salesreturn_index[$current_id]['created_at'])).'</b></span></p>
				<table  cellspacing="0" cellpadding="0"><tbody><tr><td style="text-align:left;font-size:12px;width:40%;">'.$product_return_index[$value['productid']]['productname'].'</td>
				<td style="text-align:center;font-size:12px;width:10%;">'.$value['productqty'].'</td>
				<td style="text-align:left;font-size:12px;width:15%;">'.$value['batchnumber'].'</td>
				<td style="text-align:left;font-size:12px;width:15%;">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
				<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp_per_unit'].'</td>
				<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp'].'</td></tr></tbody></table>';
				
					$pdf->writeHTML($returndetails_return_1, true, false, false, false, '');
			}
			
			$i++;
		}
	
				$returndetails_return_2='<p style="border-top:1px solid #000" ></p>
				<table  cellspacing="-10" cellpadding="2">
				<tbody><tr><td colspan="4" style="text-align:right;font-size:12px;"><b>Total : </b></td>
				<td style="text-align:right;font-size:12px;"><b>'.number_format($salesreturn_fetch_sum['total'],2).'</b></td></tr>
				</tbody></table><p style="border-top:1px solid #000" ></p>';
				
			
			
				$pdf->writeHTML($returndetails_return_2, true, false, false, false, '');
			
			
			$pdf->writeHTML($returndetails, true, false, false, false, '');
}
	
}


ob_end_clean();
$pdf->Output('FinalBill.pdf');
}



public function actionPatienthistorydetailsip()
{
	
	
	
	
$fromDate_patienthistorydetails=date('Y-m-d',strtotime($_POST['fromDate_patienthistorydetailsip']));	
$toDate_patienthistorydetails=date('Y-m-d',strtotime($_POST['toDate_patienthistorydetailsip']));	
$patient_mrno=$_POST['patient_mrnoip'];	
	
	//print_r($_POST);die;	
$sales=InSales::find()->select(['opsaleid'=>'opsaleid','name'=>'name','mrnumber'=>'mrnumber','billnumber'=>'billnumber'])->where(['ip_no'=>$patient_mrno])->andWhere(['BETWEEN','created_at',$fromDate_patienthistorydetails.' 00:00:00',$toDate_patienthistorydetails.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->asArray()->all();

$sales_map=ArrayHelper::map($sales,'opsaleid','opsaleid');
$sales_index=ArrayHelper::index($sales,'opsaleid');


$sale_detail=InSaledetail::find()->select(['opsale_detailid'=>'opsale_detailid','opsaleid'=>'opsaleid','productid'=>'productid',
'productqty'=>'productqty','batchnumber'=>'batchnumber','expiredate'=>'expiredate','new_mrp_perunit'=>'new_mrp_perunit','total_price_perqty'=>'total_price_perqty'
])->where(['IN','opsaleid',$sales_map])->andWhere(['>=','productqty', 1])->asArray()->all();
$sale_detail_index=ArrayHelper::index($sale_detail,'opsale_detailid');



$sales_fetch_map=ArrayHelper::map($sale_detail,'opsale_detailid','opsaleid');
$sales_fetch=InSales::find()->select(['opsaleid'=>'opsaleid','name'=>'name','mrnumber'=>'mrnumber','billnumber'=>'billnumber','created_at'=>'created_at'])
->where(['IN','opsaleid',$sales_fetch_map])->asArray()->all();
$sale_fetch_index=ArrayHelper::index($sales_fetch,'opsaleid');

$sales_fetch_sum=InSales::find()->select(['overalltotal'=>'SUM(overalltotal)'])
->where(['IN','opsaleid',$sales_fetch_map])->asArray()->one();


$product_map=ArrayHelper::map($sale_detail,'opsale_detailid','productid');
$product=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['IN','productid',$product_map])->asArray()->all();
$product_index=ArrayHelper::index($product,'productid');




require ('../../vendor/tcpdf/tcpdf.php');
$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 8, '', true);




$pdf->AddPage();




if(!empty($sales))
{
	 $in_registration= InRegistration::find()->where(['ip_no'=>$patient_mrno])->one();
	
	$newpatient=Newpatient::find()->select(['mr_no'=>'mr_no','patientname'=>'patientname','insurance_type_id'=>'insurance_type_id','pat_type'=>'pat_type','pat_mobileno'=>'pat_mobileno'])->where(['mr_no'=>$in_registration->mr_no])->asArray()->one();
	
	$patienttypemaster=ArrayHelper::map(PatientType::find()->asArray()->all(),'type_id','patient_type');
	$insurancemaster=ArrayHelper::map(Insurance::find()->asArray()->all(),'insurance_typeid','insurance_type');
	
	if($newpatient['insurance_type_id'] != '')
	{
		$insurance_name=$insurancemaster[$newpatient['insurance_type_id']];
	}
	else 
	{
		$insurance_name='';	
	}

	if($newpatient['pat_type'] != '')
	{
		$pat_type=$patienttypemaster[$newpatient['pat_type']];
	}
	else 
	{
		$pat_type='';
	}
	
	$title="(A UNIT OF CARMEL HEALTHCARE PVT LTD)";
	$headertable='<table cellspacing="0" cellpadding="1" >';
	$headertable.='<tr><td style="text-align:center;font-size:18px;" colspan="12" ><b>DINESH MEDICAL CENTRE</b></td></tr>';
	$headertable.='<tr ><td style="text-align:center;font-size:11px;" colspan="12" ><b>'.$title.'</b></td></tr>';
	$headertable.='<tr ><td style="text-align:center;font-size:11px;" colspan="12" ><p><b>D.NO:3-7-215-1, FIRST FLOOR BAKARAPURAM, PULIVENDULA - 516390 - KADAPA DIST,PH:08568 287557</b></p></td></tr>';
	$headertable.='<tr><td colspan="3"><b>DL NO-20F: AP/11/03/2017-137691</b></td><td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>21 : AP/11/03/2017-137690</b></td>
	<td colspan="3"><b>&nbsp;&nbsp;&nbsp; 20: AP/11/03/2017-137689</b></td><td colspan="3"><b>GSTIN : 37AADCC7476L1Z3</b></td></tr>';
	
	
	$headertable.='</table>';
	$headertable.='<p style="border-top:1px solid #000" ></p>
	<p style="text-align:center;font-size:12px;" ><b><u>PATIENT PURCHASE AND RETURN DETAILS</u></b></p><p></p>';
	
	$pdf->writeHTML($headertable, true, false, false, false, '');
	
	$patientdetails='<table style="text-align:center;font-size:10.5px;" border="1" cellspacing="0" cellpadding="0">';
	$patientdetails.='<tbody><tr><td style="font-size:12px;width:10%;"><b>IP NO</b></td><td style="font-size:12px;width:20%;"><b>PAT NAME</b></td><td style="font-size:12px;width:30%;"><b>TYPE</b></td><td style="font-size:12px;"><b>ORG NAME</b></td><td style="font-size:12px;"><b>PH.NO</b></td></tr>';
    $patientdetails.='<tr><td style="font-size:12px;">'.$patient_mrno.'</td><td style="font-size:12px;">'.strtoupper($newpatient['patientname']).'</td><td style="font-size:12px;">'.strtoupper($pat_type).'</td><td style="font-size:12px;">'.strtoupper($insurance_name).'</td><td style="font-size:12px;">'.$newpatient['pat_mobileno'].'</td></tr>';				
	$patientdetails.='</tbody></table>';
	
	$pdf->writeHTML($patientdetails, true, false, false, false, '');
	
	

	
	
	if(!empty($sale_detail))
	{
		//$purchasedetails='';
		
		$purchasedetails='
		 <p style="border-top:1px solid #000" ></p>
		 <table cellspacing="-5" cellpadding="-15" >
		    <tbody>
			   <tr>
			      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
				  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
				  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
				  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
				  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
				  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
			   </tr>
			</tbody>
		 </table>
		 <p style="border-top:1px solid #000" ></p>';
		$i=1;
		
		
		$pdf->writeHTML($purchasedetails, true, false, false, false, '');
		
		$sales_current=current($sale_fetch_index);
		
		/* $purchasedetails.='<p style="text-align:left;font-size:12px;color: blue;"><b>ISSUES</b></p>'; */
		$purchasedetails1='<p style="text-align:left;font-size:12px;"><span><b style="text-align:left;font-size:12px;color: blue;">ISSUES</b><br><b>BILL NO: '.$sales_current['billnumber'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($sales_current['created_at'])).'</b></span></p>';
		
		$pdf->writeHTML($purchasedetails1, true, false, false, false, '');
			$num_pages = $pdf->getNumPages();
		foreach ($sale_detail as $key => $value) 
		{
		
			
			
			$current_id=$value['opsaleid'];
			if($sales_current['opsaleid'] == $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat='
					
					 <table cellspacing="-5" cellpadding="-15" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						</tbody>
					 </table>
					';
					
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy); 
				}
				
				$purchasedetails2='
				<table  cellspacing="0" cellpadding="0">
				 <tbody>
				  <tr>
				    <td style="font-size:12px;width:36%;text-align:left;">'.$product_index[$value['productid']]['productname'].'</td>
					<td style="font-size:12px;width:12%;text-align:left; ">'.$value['productqty'].'</td>
					<td style="font-size:12px;width:14%;text-align:left; ">'.$value['batchnumber'].'</td>
					<td style="font-size:12px;text-align:left; ">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['new_mrp_perunit'].'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['total_price_perqty'].'</td>
				  </tr>
				 </tbody>
				</table>';
				
				$pdf->writeHTML($purchasedetails2, true, false, false, false, '');
				
				
			
			
				
				
				
			}
			else if($sales_current['opsaleid'] != $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				$sales_current['opsaleid']=$current_id;
				//$purchasedetails3='';
				$purchasedetails3='<p style=" font-size:12px;" ><span><b>BILL NO: '.$sale_fetch_index[$current_id]['billnumber'].'</b> <b>Date: '.date('d-m-Y',strtotime($sale_fetch_index[$current_id]['created_at'])).'</b></span></p>
				<table  cellspacing="0" cellpadding="0">
				  <tbody>
				   <tr>
				    <td style="font-size:12px;width:36%;text-align:left; ">'.$product_index[$value['productid']]['productname'].'</td>
					<td style="font-size:12px;width:12%;text-align:left; ">'.$value['productqty'].'</td>
					<td style="font-size:12px;width:14%;text-align:left; ">'.$value['batchnumber'].'</td>
					<td style="font-size:12px;text-align:left; ">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['new_mrp_perunit'].'</td>
					<td style="font-size:12px;text-align:left; ">'.$value['total_price_perqty'].'</td>
				   </tr>
				  </tbody>
				</table>';
				$pdf->writeHTML($purchasedetails3, true, false, false, false, '');
			
				

			}
			
			$i++;
		}
	
				$purchasedetails4='<p style="border-top:1px solid #000" ></p>
				<table  cellspacing="-10" cellpadding="2"><tbody><tr><td colspan="4" style="text-align:right;font-size:12px;"><b>Total : </b></td><td style="text-align:right;font-size:12px;width:19%;"><b>'.number_format($sales_fetch_sum['overalltotal'],2).'</b></td></tr></tbody></table>
				<p style="border-top:1px solid #000" ></p>
				';
				
			
				$pdf->writeHTML($purchasedetails4, true, false, false, false, '');
			
		
			
		

				
	}	
	
	$salesreturn=InSalesreturn::find()
->select(['return_id'=>'return_id','saleid'=>'saleid','return_invoicenumber'=>'return_invoicenumber','total'=>'total','return_amount'=>'return_amount','created_at'=>'created_at'])
->where(['IN','saleid',$sales_map])->asArray()->all();
$salesreturn_map=ArrayHelper::map($salesreturn,'return_id','return_id');
$salesreturn_index=ArrayHelper::index($salesreturn,'return_id');
		

$returndetail=InReturndetail::find()
->select(['return_detailid'=>'return_detailid','return_id'=>'return_id','sale_detailid'=>'sale_detailid'
,'productid'=>'productid','productqty'=>'productqty','batchnumber'=>'batchnumber','expiredate'=>'expiredate'
,'mrp_per_unit'=>'mrp_per_unit','mrp'=>'mrp'])
->where(['IN','return_id',$salesreturn_map])->asArray()->all();




$product_return_map=ArrayHelper::map($returndetail,'return_detailid','productid');
$product_return=Product::find()->select(['productid'=>'productid','productname'=>'productname'])->where(['IN','productid',$product_return_map])->asArray()->all();
$product_return_index=ArrayHelper::index($product_return,'productid');
		

$salesreturn_fetch_sum=InSalesreturn::find()->select(['total'=>'SUM(total)'])
->where(['IN','saleid',$sales_map])->asArray()->one();		
	//echo '<pre>';print_r($salesreturn_fetch_sum);die;
		
if(!empty($returndetail))
{
$returndetails='';


$i=1;


$salesreturn_first=current($salesreturn_index);


$returndetails_front='<p style="text-align:left;font-size:12px;color: blue;"><b>RETURN</b></p>
<p style="text-align:left;font-size:12px;"><span><b>BILL NO: '.$salesreturn_first['return_invoicenumber'].'</b></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($salesreturn_first['created_at'])).'</b></span></p>';


	$pdf->writeHTML($returndetails_front, true, false, false, false, '');


foreach ($returndetail as $key => $value) 
		{

			$current_id=$value['return_id'];
			if($salesreturn_first['return_id'] == $current_id)
			{
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat_return='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat_return, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				
				$returndetails_return='<table  cellspacing="0" cellpadding="0">
						<tbody>
							<tr><td style="text-align:left;font-size:12px;width:40%;">'.$product_return_index[$value['productid']]['productname'].'</td>
							<td style="text-align:center;font-size:12px;width:10%;">'.$value['productqty'].'</td>
							<td style="text-align:left;font-size:12px;width:15%;">'.$value['batchnumber'].'</td>
							<td style="text-align:left;font-size:12px;width:15%;">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
							<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp_per_unit'].'</td>
							<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp'].'</td></tr></tbody></table>';
				
				
				$pdf->writeHTML($returndetails_return, true, false, false, false, '');

			
			}
			else if($salesreturn_first['return_id'] != $current_id)
			{
				$salesreturn_first['return_id']=$current_id;
				
				
				if($num_pages == 1)
				{
					$num_pages=1;
				}
				$cur_page=$pdf->getNumPages(); 
				if($cur_page==1){
					$pdf->SetMargins(10, 15, PDF_MARGIN_RIGHT);
				}
				if($num_pages < $pdf->getNumPages())
				{
					 $num_pages=$pdf->getNumPages();
			
					$purchasedetails_repeat_return='				
					 <table cellspacing="-5" cellpadding="-10" >
					    <tbody>
						   <tr>
						      <td style="font-size:12px; width:37%;text-align:left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name</b></td>
							  <td style="font-size:12px; width:12%;text-align:left;"><b>Qty</b></td>
							  <td style="font-size:12px;width:14.5%;text-align:left; "><b>Batch No</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Exp Date</b></td>
							  <td style="font-size:12px;text-align:left; "><b>Rate</b></td>
							  <td style="font-size:12px;text-align:left;"><b>Total</b></td>
						   </tr>
						   <tr><td></td></tr>
						</tbody>
					 </table>
					 ';
					  $cur_posx= $pdf->GetX();
					  $cur_posy= $pdf->GetY(); 
					
					  $pdf->writeHTMLCell(0, 0, '10', '10', $purchasedetails_repeat_return, 1, 1, 1, true, 'J', true);
					  $pdf->SetX($cur_posx);
					  $pdf->SetY($cur_posy);
				}	
				
				
				
				$returndetails_return_1='<p style="text-align:left;font-size:12px;" >
				<span><b>BILL NO: '.$salesreturn_index[$current_id]['return_invoicenumber'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Date: '.date('d-m-Y',strtotime($salesreturn_index[$current_id]['created_at'])).'</b></span></p>
				<table  cellspacing="0" cellpadding="0"><tbody><tr><td style="text-align:left;font-size:12px;width:40%;">'.$product_return_index[$value['productid']]['productname'].'</td>
				<td style="text-align:center;font-size:12px;width:10%;">'.$value['productqty'].'</td>
				<td style="text-align:left;font-size:12px;width:15%;">'.$value['batchnumber'].'</td>
				<td style="text-align:left;font-size:12px;width:15%;">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
				<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp_per_unit'].'</td>
				<td style="text-align:right;font-size:12px;width:10%;">'.$value['mrp'].'</td></tr></tbody></table>';
				
					$pdf->writeHTML($returndetails_return_1, true, false, false, false, '');
			}
			
			$i++;
		}
	
				$returndetails_return_2='<p style="border-top:1px solid #000" ></p>
				<table  cellspacing="-10" cellpadding="2">
				<tbody><tr><td colspan="4" style="text-align:right;font-size:12px;"><b>Total : </b></td>
				<td style="text-align:right;font-size:12px;"><b>'.number_format($salesreturn_fetch_sum['total'],2).'</b></td></tr>
				</tbody></table><p style="border-top:1px solid #000" ></p>';
				
			
			
				$pdf->writeHTML($returndetails_return_2, true, false, false, false, '');
			
			
			$pdf->writeHTML($returndetails, true, false, false, false, '');
}
	
}


ob_end_clean();
$pdf->Output('IPFinalBill.pdf');
}













  
  
  

}