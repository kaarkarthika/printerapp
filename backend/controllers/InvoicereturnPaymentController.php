<?php

namespace backend\controllers;

use Yii;
use backend\models\InvoicereturnPayment;
use backend\models\InvoicereturnPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Salesreturn;
use yii\data\ActiveDataProvider;
use backend\models\BranchAdmin;
class InvoicereturnPaymentController extends Controller
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
        ];
    }

   
    public function actionIndex()
    {
        $searchModel = new InvoicereturnPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	
	public function beforeAction($action) {
		return BranchAdmin::checkbeforeaction();
	}
	

    public function actionCreate()
    {
        $model = new InvoicereturnPayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->invoicepaymentreturnid]);
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
            return $this->redirect(['view', 'id' => $model->invoicepaymentreturnid]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        if (($model = InvoicereturnPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	    public function actionViewhistory($id)
    {
    	
        return $this->renderAjax('viewhistory', [
            'model' => $this->findModel($id),
        ]);
    }
	
		  public function actionReport($id)
    {
require ('../../vendor/tcpdf/tcpdf.php');
error_reporting(0);
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
		$returnid=$model->returnid;
	$returndata=Salesreturn::find()->where(['return_id'=>$returnid])->one();
	$tbl="";$tbl1="";
		$tbl.='
<table cellspacing="1" cellpadding="3" border="0.1px ">
	<tr><td>Reason for return</td><td>Patient Name</td><td>MR  Number</td><td>Patient Phone Number</td><td>Invoice Number</td><td>Total</td></tr>
<tr><td>'.$model->return_reason.'</td><td>'.$model->patientname.'</td><td>'.$model->mrnumber.'</td><td>'.$model->patient_mobilenumber.'</td><td>'.$model->invoicenumber.'</td><td>Rs'.number_format($returndata->total,2).' </td>
	</tr>
	<tr><td></td><td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.'.number_format($returndata->total,2).'</b></td>
	</tr>
</table>
';
$tbl1.='
<table cellspacing="1" cellpadding="3" border="0.1px ">
	<tr>
		<td>Payment Method</td><td>Payment Amount</td><td>Reference Number</td>
	</tr>';
	$invoicedata=InvoicereturnPayment::find()->where(['returnid'=>$model->returnid])->all();
	$i=1;
	foreach($invoicedata as $data)
	{
	$tbl1.='
	<tr>
		<td>'.$data->paymentmethod.'</td><td>'.$data->paymentamount.'</td>

		<td>'.$data->referencenumber.'</td>
	</tr>	';
	++$i;
	}
	$tbl1.='
</table>
';
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->writeHTML($tbl1, true, false, false, false, '');
$pdf->Output('example_001.pdf');
	}



public function actionExport($paymentmethod,$invno,$ptype,$from,$to,$type)
{
						
 $query = InvoicereturnPayment::find()->orderBy(['invoicepaymentreturnid'=>SORT_DESC]);
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
  $query->andFilterWhere(['like', 'paymentmethod', $paymentmethod])->andFilterWhere(['like', 'invoicenumber', $invno]);
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
					foreach($datatables as $model)
					{
		$returnid=$model->returnid;
	    $returndata=Salesreturn::find()->where(['return_id'=>$returnid])->one();
	    $tbl="";$tbl1="";
		$tbl.='<table cellspacing="1" cellpadding="3" border="0.1px ">
		<tr>
			<td>Reason for return</td><td>Patient Name</td><td>MR  Number</td><td>Patient Phone Number</td><td>Invoice Number</td><td>Total</td>
		</tr>
		<tr>
			<td>'.$model->return_reason.'</td><td>'.$model->patientname.'</td><td>'.$model->mrnumber.'</td><td>'.$model->patient_mobilenumber.'</td><td>'.$model->invoicenumber.'</td><td>Rs'.number_format($returndata->total,2).'
			</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.'.number_format($returndata->total,2).'</b></td>
		</tr>
		</table>';
		$tbl1.='<table cellspacing="1" cellpadding="3" border="0.1px ">
		<tr>
		<td>Payment Method</td><td>Payment Amount</td><td>Reference Number</td>
		</tr>';
		 $invoicedata=InvoicereturnPayment::find()->where(['returnid'=>$model->returnid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{ 
	$tbl1.='<tr>
		<td>'.$data->paymentmethod.'</td><td>'.$data->paymentamount.'</td>
		<td>'.$data->referencenumber.'</td>
		</tr>	';
	 ++$i;
	 } 
	 }
		$tbl1.='</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');
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
}
