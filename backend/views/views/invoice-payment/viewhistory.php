<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Sales;
use backend\models\InvoicePayment;
$this->title = $salemodel->invoicepaymentid;
use backend\models\Paymentmethod;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$salemodel=Sales::findOne($model->saleid);
?>
<div class="invoice-payment-view">
<table class="table table-bordered table-hover">
		<thead>
			<th>S.No</th><th>Patient Name</th><th>MR  Number</th><th>Patient Phone Number</th><th>Invoice Number</th><th>Total</th>
		</thead>
	    <tr>
			<td>1</td><td><?php echo $salemodel->name;?></td><td><?php echo $salemodel->mrnumber;?></td><td><?php echo $salemodel->phonenumber;?></td><td><?php echo $salemodel->billnumber;?></td><td>Rs .<?php echo number_format($salemodel->overalltotal,2);?></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.<?php echo number_format($salemodel->overalltotal,2);?></b></td>
		</tr>
		</table>
		<table class="table table-bordered table-hover">
		<thead>
			<th>S.No</th><th>Payment Method</th><th>Payment Amount</th><th>Payment Amount Total</th><th>Card Type</th><th>Card Holder Name</th><th>Reference Number</th>
		</thead>
		<?php $invoicedata=InvoicePayment::find()->where(['saleid'=>$model->saleid])->all();
		
		
		$i=1;
		foreach($invoicedata as $data)
		{ 
		$paymentdata=Paymentmethod::find()->where(['methodkey'=>$data->paymentmethod])->one();
			?>
		<tr>
			<td><?php echo $i;?></td><td><?php echo ucwords($paymentdata->methodkey);?></td><td><?php echo $data->paymentamount;?></td><td></td><td><?php 
			
			if($data->cardtype!="Empty")
			{
				echo $data->cardtype;
			}
			?></td>
			<td><?php if($data->cardholdername!="Empty")
			  {
			  	echo ucwords($data->cardholdername);
			  	}?></td>
			<td><?php echo $data->referencenumber;?></td>
		</tr>	
		<?php  ++$i;} 
		?>
		</table>
</div>