<?php

namespace backend\controllers;

use Yii;
use backend\models\InvoicePayment;
use backend\models\InvoicePaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Sales;
use backend\models\PaymentMethod;
use backend\models\SalesSearch;
use yii\helpers\ArrayHelper;
use backend\models\PaymentType;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;
use backend\models\Saledetail;
use backend\models\Stockmaster;
use backend\models\Stockresponse;
use backend\models\Unit;
use backend\models\SalesreturnSearch;
use backend\models\Salesreturn;
use backend\models\InvoicereturnPayment;
use backend\models\Returndetail;
use backend\models\InvoicereturnPaymentSearch;
use yii\data\ActiveDataProvider;
use backend\models\CompanyBranch;

class InvoicePaymentController extends Controller
{
   
    public function behaviors()
    {
       return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'], ], ], 'access' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]]];
    }

    public function actionPaymenthistory()
    {
        $searchModel = new InvoicePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$paymentmodelist=ArrayHelper::map(PaymentMethod::find()->asArray()->all(), 'methodkey', 'methodkey');
         $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
        return $this->render('paymenthistory', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paymentmodelist'=>$paymentmodelist,
            'branchlist'=>$branchlist,
        ]);
    }
	
	 public function actionReturnpaymenthistory()
    {
        $searchModel = new InvoicereturnPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('paymentreturnhistory', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	
	
	
	
	
	
	public function beforeAction($action) {
		return BranchAdmin::checkbeforeaction();
	}
	
	
	 public function actionIndex()
    {
        $searchModel = new SalesSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		return $this -> render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider ]);
    }
	
	 public function actionReturnpayment()
    {
        $searchModel = new SalesreturnSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		return $this -> render('returnpayment', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider ]);
		
		
    }

    public function actionPay($id) 
    
    {
    	
		
		$converted_id=base64_decode(urldecode($id));
		$model = Sales::findOne($converted_id);
		$paymentmodel=new PaymentMethod();
		$invoicepayment=new InvoicePayment();

		if (Yii::$app -> request -> post())
		{
			
			$paymentmethodarray = array();
			
				$paymentmethodarray = Yii::$app -> request -> post('InvoicePayment')['paymentmethodarray'];
			
			$paymentamount = array();
			
				$paymentamount = Yii::$app -> request -> post('InvoicePayment')['paymentamount'];
			
			$cardtype = array();
			
				$cardtype = Yii::$app -> request -> post('InvoicePayment')['cardtype'];
			

			$cardholdername = array();
		
				$cardholdername = Yii::$app -> request -> post('InvoicePayment')['cardholdername'];
			

			$referencenumber = array();
			
				$referencenumber = Yii::$app -> request -> post('InvoicePayment')['referencenumber'];
			
			$pay_timestamp = array();
			
				$pay_timestamp = Yii::$app -> request -> post('InvoicePayment')['timestamp'];
			
			$payment_time = date("Y-m-d H:i:s");
			if ($pay_timestamp != "") {
				$payment_time = date("Y-m-d", strtotime($pay_timestamp)) . " " . date('H:i:s');
			}
                  
          
            $discount_amt = 0;
			
			
				if (count($paymentmethodarray) > 0) {
					foreach ($paymentmethodarray as $key => $one_paymethod) {
						
						$invoicepayment = new InvoicePayment();
						$session = Yii::$app->session;
						$invoicepayment -> branchid = $session['branch_id'];
						$invoicepayment->saleid=$converted_id;
						$invoicepayment->invoicenumber=$model->billnumber;
					
						$invoicepayment -> paymentmethod = $one_paymethod;
						$invoicepayment -> paymentamount = $paymentamount[$key];
						if ($one_paymethod == 'discountamount') {
							$discount_amt += $paymentamount[$key];
						}
						$invoicepayment -> timestamp = $payment_time;
						if ($cardtype[$one_key]!="") {
							$invoicepayment -> cardtype = $cardtype[$key];
						}
						else{
							$invoicepayment -> cardtype ="";
						}
						$invoicepayment -> referencenumber = $referencenumber[$key];
						if ($cardholdername[$one_key]!="") {
							$invoicepayment -> cardholdername = $cardholdername[$key];
						}
						else{
							$invoicepayment -> cardholdername = "";
						}
						
						if($invoicepayment -> save())
						{
							$saledata=Sales::find()->where(['opsaleid'=>$converted_id])->one();
							$saledata->paid_status="Paid";
							$session = Yii::$app->session;
			                $saledata->updated_by=$session['user_id'];
		        	        $saledata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
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
						 	
					        
							 $qty=($sddata->productqty)/$noofunit;
							 
							 
							 $stockmaster -> quantity = $stockmaster->quantity -$qty;
							 $stockmaster->total_no_of_quantity= $stockmaster -> total_no_of_quantity-$sddata->productqty;
							 $stockmaster->price= $stockmaster->price-$sddata -> price;
							 $stockmaster -> updated_on = date("Y-m-d H:i:s");
							 $stockmaster -> save();
							 
							
						 }
						  
						  $stockmasterfrombatch = Stockresponse::find() -> where(['stockresponseid' => $stockresponseid]) -> one();
						 if ($stockmasterfrombatch)
						  {
						 	
					       
							 $qty=($sddata->productqty)/$noofunit;
							 $stockmasterfrombatch->receivedquantity= $stockmasterfrombatch->receivedquantity-$qty;
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
				}
			

                     Yii::$app->getSession()->setFlash('success','Invoice Saved successfully');
				 return $this->redirect(['index']);




		} 
		else {
			return $this -> render('_form', ['model' => $model,'paymentmodel'=>$paymentmodel,'invoicepayment'=>$invoicepayment]);

		}
	}

public function actionRefund($id) {
    	
		
		$converted_id=base64_decode(urldecode($id));
		
		
		
		$model = Salesreturn::findOne($converted_id);
		$paymentmodel=new PaymentMethod();
		$invoicereturnpayment=new InvoicereturnPayment();

		if (Yii::$app -> request -> post())
		{
			
			
			$paymentmethodarray = array();
			$paymentmethodarray = Yii::$app -> request -> post('InvoicereturnPayment')['paymentmethodarray'];
			
			$paymentamount = array();
			$paymentamount = Yii::$app -> request -> post('InvoicereturnPayment')['paymentamount'];
		      
			$refno = array();
		   $refno = Yii::$app -> request -> post('InvoicereturnPayment')['referencenumber'];

			
			$pay_timestamp = array();
			$pay_timestamp = Yii::$app -> request -> post('InvoicereturnPayment')['timestamp'];
			
			$payment_time = date("Y-m-d H:i:s");
			if ($pay_timestamp != "") {
				$payment_time = date("Y-m-d", strtotime($pay_timestamp)) . " " . date('H:i:s');
			}
				if (count($paymentmethodarray) > 0) {
					foreach ($paymentmethodarray as $key => $one_paymethod) {
						
						
						$invoicereturnpayment = new InvoicereturnPayment();
						$session = Yii::$app->session;
						$invoicereturnpayment -> branchid = $session['branch_id'];
						$invoicereturnpayment->returnid=$model->return_id;
						$invoicereturnpayment->mrnumber=Yii::$app -> request -> post('InvoicereturnPayment')['mrnumber'];
						$invoicereturnpayment->patientname=Yii::$app -> request -> post('InvoicereturnPayment')['patientname'];
						$invoicereturnpayment->patient_mobilenumber=Yii::$app -> request -> post('InvoicereturnPayment')['patient_mobilenumber'];
						$invoicereturnpayment->return_reason = Yii::$app -> request -> post('InvoicereturnPayment')['return_reason'];
						$invoicereturnpayment -> referencenumber = $refno[$key];
						$invoicereturnpayment -> paymentmethod = $one_paymethod;
						$invoicereturnpayment->invoicenumber=$model->return_invoicenumber;
					    $invoicereturnpayment -> paymentamount = $paymentamount[$key];
						$invoicereturnpayment -> timestamp = $payment_time;
						if($invoicereturnpayment -> save())
						{
							$returndata=Salesreturn::find()->where(['return_id'=>$model->return_id])->one();
							$returndata->paid_status="Yes";
							$session = Yii::$app->session;
			                $returndata->updated_by=$session['user_id'];
		        	        $returndata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			                $returndata->updated_on=date("Y-m-d H:i:s");
							$returndata->save();
							$retunrdetaildata=Returndetail::find()->where(['return_id'=>$model->return_id])->all();
							if($retunrdetaildata)
								{
							foreach($retunrdetaildata as $sddata)
								{
									
									$stockid=$sddata->stockid;
									$stockresponseid=$sddata->stockresponseid;
								    $stockmaster = Stockmaster::find() -> where(['stockid' => $stockid]) -> one();
									$unitid=$sddata->unitid;
							        $unitdata=Unit::find()->where(['unitid'=>$unitid])->one();
							        $noofunit=$unitdata->no_of_unit;
							 
						 if ($stockmaster)
						  {
						 	
							 $qty=($sddata->productqty)/$noofunit;
							 $stockmaster -> quantity = $stockmaster->quantity+$qty;
							 $stockmaster->total_no_of_quantity= $stockmaster -> total_no_of_quantity+$sddata->productqty;
							 $stockmaster->price= $stockmaster->price+$sddata -> price;
							 $stockmaster -> updated_on = date("Y-m-d H:i:s");
							 $stockmaster -> save();
							
						 }
						  
						  $stockmasterfrombatch = Stockresponse::find() -> where(['stockresponseid' => $stockresponseid]) -> one();
						 if ($stockmasterfrombatch)
						  {
							 $qty=($sddata->productqty)/$noofunit;
							 $stockmasterfrombatch->receivedquantity= $stockmasterfrombatch->receivedquantity+$qty;
						     $stockmasterfrombatch->total_no_of_quantity= $stockmasterfrombatch->total_no_of_quantity+$sddata->productqty;
							 $stockmasterfrombatch->purchaseprice= $stockmasterfrombatch->purchaseprice+$sddata -> price;
							 $stockmasterfrombatch -> updated_on = date("Y-m-d H:i:s");
							 $stockmasterfrombatch->save();
						 }
								
							}
								}
						}
 
									else
										{
											$invoicereturnpayment->getErrors();die;
										}
						
					}
				}
			

                     Yii::$app->getSession()->setFlash('success','Return Invoice Saved successfully');
				 return $this->redirect(['returnpayment']);




		} 
		else {
			return $this -> render('_returninvoiceform', ['model' => $model,'paymentmodel'=>$paymentmodel,'invoicereturnpayment'=>$invoicereturnpayment]);

		}
	}

	public function actionPaymentmethod() 
	{
			$out_text = '';
		
		if (Yii::$app -> request -> post('paymentmethod')) {
			$payment_method = Yii::$app -> request -> post('paymentmethod');
			$rmd_id = "rmd_" . date("ms") . rand(10, 99999999);
			$out_text .= '<div class="col-md-12 ' . $rmd_id . '">';
			$out_text .= '<input  type="hidden" id="invoicepayment-paymentamount" value="' . $payment_method . '" class="form-control" name="InvoicePayment[paymentmethodarray][]">';
			$payment_data = PaymentMethod::find() -> where(['methodkey' => $payment_method]) -> one();
			$out_text1 = '<button type="button" class="btn btn-box-tool btn-danger removepayment" id="' . $rmd_id . '"><i class="fa fa-times"></i></button>';
			if ($payment_data) {
				$out_text .= '<h4>' . $payment_data -> methodname . ' ' . $out_text1 . '</h4>';
			}
			//$out_text1.='<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>';
			$text_pay = 'Payment Amount';
			if (Yii::$app -> request -> post('isrefund') != "") {
				$text_pay = 'Refund Amount';
			}
			
			if ($payment_method == 'cardpayment') {
				$all_cardtype = ArrayHelper::map(PaymentType::find() -> all(), 'payment_type_id', 'paymenttype');
				$select_cardtype = '<select id="invoicepayment-cardtype" class="form-control" name="InvoicePayment[cardtype][]">';
				$select_cardtype .= '<option value="">--Select--</option>';
				foreach ($all_cardtype as $key_card => $one_card) {
					$select_cardtype .= '<option value="' . $key_card . '">' . $one_card . '</option>';
				}
				$select_cardtype .= '</select>';
				$out_text .= '<div class="form-group col-md-3"> 
					        	<div class="form-group field-invoicepayment-paymentamount required">
					<label class="control-label" for="invoicepayment-paymentamount">' . $text_pay . '</label>
					<input required type="text" id="invoicepayment-paymentamount" required="true" class="form-control numericonlyvalue" name="InvoicePayment[paymentamount][]" data_paytype="' . $payment_method . '" style="text-align:right;">
					
					<div class="help-block"></div>
					</div>
					        </div>
					        <div class="form-group col-md-3"> 
					        	 <div class="form-group field-invoicepayment-cardtype required">
					<label class="control-label" for="invoicepayment-cardtype">Card Type</label>' . $select_cardtype . '
					<div class="help-block"></div>
					</div>        	</div>
					
					<div class="form-group col-md-3"> 
					        	 <div class="form-group field-invoicepayment-cardholdername">
					<label class="control-label" for="invoicepayment-cardholdername">Card Holder Name <span style="color:red">*</span></label>
					<input type="text" id="invoicepayment-cardholdername" class="form-control" required=true name="InvoicePayment[cardholdername][]" maxlength="250">
					
					<div class="help-block"></div>
					</div>        	</div>
					        	<div class="form-group col-md-3"> 
					        	 <div class="form-group field-invoicepayment-referencenumber">
					<label class="control-label" for="invoicepayment-referencenumber">Reference Number<span style="color:red">*</span></label>
					<input type="text" id="invoicepayment-referencenumber" class="form-control" name="InvoicePayment[referencenumber][]" maxlength="250">
					
					<div class="help-block"></div>
					</div>        	</div>';

			} else {
				$return_text = '';
				$ref_text = 'Reference Number';
				if ($payment_method == "discountamount") {
					$return_text = "is_discount";
					$ref_text = 'Reason for Discount';
				}
				$out_text .= '<input  type="hidden" id="invoicepayment-cardtype" class="form-control" name="InvoicePayment[cardtype][]" style="text-align:right;">';
				$out_text .= '<input  type="hidden" id="invoicepayment-cardholdername" class="form-control" name="InvoicePayment[cardholdername][]" style="text-align:right;">';
				$out_text .= '<div class="form-group col-md-4"> 
					        	<div class="form-group field-invoicepayment-paymentamount required">
					<label class="control-label" for="invoicepayment-paymentamount">' . $text_pay . '</label>
					<input  required type="text" id="invoicepayment-paymentamount" class="form-control numericonlyvalue ' . $return_text . '" name="InvoicePayment[paymentamount][]" data_paytype="' . $payment_method . '" style="text-align:right;">
					
					<div class="help-block"></div>
					</div>	</div>			      
					 <div class="form-group col-md-4"> 
					        	 <div class="form-group field-invoicepayment-referencenumber">
					<label class="control-label" for="invoicepayment-referencenumber">' . $ref_text . '</label>
					<input type="text" id="invoicepayment-referencenumber" class="form-control" name="InvoicePayment[referencenumber][]" data_paytype="' . $payment_method . '" maxlength="250">
					
					<div class="help-block"></div>
					</div>        	</div>';
			}
			$out_text .= '</div>';
		}
		echo $out_text;
	}





	public function actionPaymentmethod1() 
	{
			$out_text = '';
			
			
		
		if (Yii::$app -> request -> post('paymentmethod')) {
			
			$payment_method = Yii::$app -> request -> post('paymentmethod');
			$rmd_id = "rmd_" . date("ms") . rand(10, 99999999);
			$out_text .= '<div class="col-md-12 ' . $rmd_id . '">';
			$out_text .= '<input  type="hidden" id="invoicereturnpayment-paymentamount" value="' . $payment_method . '" class="form-control" name="InvoicereturnPayment[paymentmethodarray][]">';
			$payment_data = PaymentMethod::find() -> where(['methodkey' => $payment_method]) -> one();
			$out_text1 = '<button type="button" class="btn btn-box-tool btn-danger removepayment" id="' . $rmd_id . '"><i class="fa fa-times"></i></button>';
			if ($payment_data) {
				$out_text .= '<h4>' . $payment_data -> methodname . ' ' . $out_text1 . '</h4>';
			}
			
				$text_pay = 'Refund Amount';
				$return_text = '';
				$ref_text = 'ReferenceNumber';
				$out_text .= '<div class="form-group col-md-4"> 
					        	<div class="form-group field-invoicereturnpayment-paymentamount required">
					<label class="control-label" for="invoicereturnpayment-paymentamount">' . $text_pay . '</label>
					<input  required type="text" id="invoicereturnpayment-paymentamount" class="form-control numericonlyvalue ' . $return_text . '" name="InvoicereturnPayment[paymentamount][]" data_paytype="' . $payment_method . '" style="text-align:right;">
					
					<div class="help-block"></div>
					</div>	</div>			      
					 <div class="form-group col-md-4"> 
					        	 <div class="form-group field-invoicereturnpayment-referencenumber">
					<label class="control-label" for="invoicereturnpayment-referencenumber">' . $ref_text . '</label>
					<input type="text" id="invoicereturnpayment-referencenumber" class="form-control" name="InvoicereturnPayment[referencenumber][]" data_paytype="' . $payment_method . '" maxlength="250">
					
					<div class="help-block"></div>
					</div>        	</div>';
			
			$out_text .= '</div>';
		}
echo $out_text;
		
	}

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
   

         public function actionViewhistory($id)
    {
    	
        return $this->renderAjax('viewhistory', [
            'model' => $this->findModel($id),
        ]);
    }

  
    public function actionCreate()
    {
        $model = new InvoicePayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->invoicepaymentid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->invoicepaymentid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	  public function actionReport($id)
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
        $model = $this->findModel($id);
		$saleid=$model->saleid;
		$salemodel=Sales::findOne($saleid);
$tbl="";$tbl1="";

	$tbl.='<table  cellspacing="1" cellpadding="3" border="0.1px " >
		<tr>
		<td>Patient Name</td><td>MR  Number</td><td>Patient Phone Number</td><td>Invoice Number</td><td>Total</td>
		</tr>
		<tr>
		<td>'.$salemodel->name.'</td><td>'.$salemodel->mrnumber.'</td><td>'.$salemodel->phonenumber.'</td><td>'.$salemodel->billnumber.'</td><td>Rs .'.number_format($salemodel->overalltotal,2).'</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.'.number_format($salemodel->overalltotal,2).'</b></td>
		</tr>
		</table>';
		$tbl1.='<table cellspacing="1" cellpadding="3" border="0.1px ">
		<tr>
		<td>Payment Method</td><td>Payment Amount</td><td>Payment Amount Total</td><td>Card Type</td><td>Card Holder Name</td><td>Reference Number</td>
		</tr>';
		$invoicedata=InvoicePayment::find()->where(['saleid'=>$model->saleid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{
			
			$paymentdata=Paymentmethod::find()->where(['pm_autoid'=>$data->paymentmethod])->one();
			
			if($data->cardtype!="Empty")
			{
				$cardtype=$data->cardtype;
			}
			else
				 {
				$cardtype="";
			}
			if($data->cardholdername!="Empty")
			{
				$cardholdername=$data->cardholdername;
			}
			else
				 {
				$cardholdername="";
			}	 
	$tbl1.='<tr><td>'.$paymentdata->methodkey.'</td><td>'.$data->paymentamount.'</td><td></td><td>'.$cardtype.'</td><td>'.$cardholdername.'</td>
			<td>'.$data->referencenumber.'</td></tr>';
		 ++$i;
        }
$tbl1.='</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->writeHTML($tbl1, true, false, false, false, '');
$pdf->Output('example_001.pdf');


	}
	
	
	
	

  
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	  public function actionCancel($id)
    {
    	
		
        $saledata=Sales::find()->where(['opsaleid'=>$id])->one();
		$saledata->paid_status="Cancelled";
		$session = Yii::$app->session;
		$saledata->updated_by=$session['user_id'];
		$saledata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
		$saledata->updated_on=date("Y-m-d H:i:s");
		$saledata->save();

        return $this->redirect(['index']);
    }
    	public function actionRecancel($id)
    {
        $saledata=Sales::find()->where(['opsaleid'=>$id])->one();
		$saledata->paid_status="UnPaid";
		$session = Yii::$app->session;
		$saledata->updated_by=$session['user_id'];
		$saledata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
		$saledata->updated_on=date("Y-m-d H:i:s");
		$saledata->save();
        return $this->redirect(['index']);
    }
	
	
		  public function actionCancelreturn($id)
    {
    	
		
        $saledata=Salesreturn::find()->where(['return_id'=>$id])->one();
		$saledata->paid_status="Cancelled";
		$session = Yii::$app->session;
		$saledata->updated_by=$session['user_id'];
		$saledata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
		$saledata->updated_on=date("Y-m-d H:i:s");
		$saledata->save();
        return $this->redirect(['returnpayment']);
    }

     	  public function actionRecancelreturn($id)
    {
    	
		
        $saledata=Salesreturn::find()->where(['return_id'=>$id])->one();
		$saledata->paid_status="UnPaid";
		$session = Yii::$app->session;
		$saledata->updated_by=$session['user_id'];
		$saledata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
		$saledata->updated_on=date("Y-m-d H:i:s");
		$saledata->save();
        return $this->redirect(['returnpayment']);
    }


	

	

  
    protected function findModel($id)
    {
        if (($model = InvoicePayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


	  public function actionOverallreport()
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


        $model = InvoicePayment::find()->all();
		foreach($model as $k)
		{
		$saleid=$k->saleid;
		$salemodel=Sales::findOne($saleid);
		$tbl='<table  cellspacing="1" cellpadding="3" border="0.1px">';
	$tbl.='
		<tr>
		<td>Patient Name</td><td>MR  Number</td><td>Patient Phone Number</td><td>Invoice Number</td><td>Total</td>
		</tr>
		<tr>
		<td>'.$salemodel->name.'</td><td>'.$salemodel->mrnumber.'</td><td>'.$salemodel->phonenumber.'</td><td>'.$salemodel->billnumber.'</td><td>Rs .'.number_format($salemodel->total,2).'</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.'.number_format($salemodel->total,2).'</b></td>
		</tr>
		
		<tr>
		<td>Payment Method</td><td>Payment Amount</td><td>Payment Amount Total</td><td>Card Type</td><td>Card Holder Name</td><td>Reference Number</td>
		</tr>';
		$invoicedata=InvoicePayment::find()->where(['saleid'=>$k->saleid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{ 
		$tbl.='<tr><td>'.$data->paymentmethod.'</td><td>'.$data->paymentamount.'</td><td></td><td>'.$data->cardtype.'</td><td>'.$data->cardholdername.'</td>
			<td>'.$data->referencenumber.'</td></tr>';
		 ++$i;
        }
		$tbl.='</table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
}


$pdf->Output('example_001.pdf');


	}

public function actionExport($paymentmethod,$invno,$ptype,$from,$to,$type)
{
						
 $query = InvoicePayment::find()->orderBy(['invoicepaymentid'=>SORT_DESC]);
 $session = Yii::$app->session;
 $role=$session['authUserRole'];
 $companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
		}
		else{
		$query->andFilterWhere(['branchid' =>$companybranchid]);
		} 

      
		$patienttype=$ptype;
		if($patienttype==1)
		{
			$ptype1="IP";
		}
		else{
			$ptype1="OP";
		}
		
		
if(!empty($patienttype)){ $query->andFilterWhere(['like', 'invoicenumber',$ptype1]);}
if(!empty($from) && !empty($to)){
      $fromdate=date("Y-m-d",strtotime($from));
	  $todate=date("Y-m-d",strtotime($to));
	  $query->andFilterWhere(['between', 'timestamp',$fromdate, $todate]);
	}
  
 $query->andFilterWhere(['like', 'paymentmethod', $paymentmethod])
  ->andFilterWhere(['like', 'invoicenumber', $invno]);
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
						

      
		foreach($datatables as $k)
		{
		$saleid=$k->saleid;
		$salemodel=Sales::findOne($saleid);
		$tbl='<table  cellspacing="1" cellpadding="3" border="0.1px">';
	$tbl.='
		<tr>
		<td>Patient Name</td><td>MR  Number</td><td>Patient Phone Number</td><td>Invoice Number</td><td>Total</td>
		</tr>
		<tr>
		<td>'.$salemodel->name.'</td><td>'.$salemodel->mrnumber.'</td><td>'.$salemodel->phonenumber.'</td><td>'.$salemodel->billnumber.'</td><td>Rs .'.number_format($salemodel->total,2).'</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.'.number_format($salemodel->total,2).'</b></td>
		</tr>
		
		<tr>
		<td>Payment Method</td><td>Payment Amount</td><td>Payment Amount Total</td><td>Card Type</td><td>Card Holder Name</td><td>Reference Number</td>
		</tr>';
		
		
		$invoicedata=InvoicePayment::find()->where(['saleid'=>$k->saleid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{ 
		$tbl.='<tr><td>'.$data->paymentmethod.'</td><td>'.$data->paymentamount.'</td><td></td><td>'.$data->cardtype.'</td><td>'.$data->cardholdername.'</td>
			<td>'.$data->referencenumber.'</td></tr>';
		 ++$i;
        }
		$tbl.='</table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
}
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










}
