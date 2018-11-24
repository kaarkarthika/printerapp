<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Salesreturn;
use backend\models\InvoicereturnPayment;

$returndata=Salesreturn::find()->where(['return_id'=>$model->returnid])->one();

?>

<div class="invoice-payment-view">

		<table class="table table-bordered table-hover">
		<thead>
			<th>Reason for return</th><th>Patient Name</th><th>MR  Number</th><th>Patient Phone Number</th><th>Invoice Number</th><th>Total</th>
		</thead>
		
		<tr>
			<td><?php echo $model->return_reason;?></td><td><?php echo $model->patientname;?></td><td><?php echo $model->mrnumber;?></td><td><?php echo $model->patient_mobilenumber;?></td><td><?php echo $model->invoicenumber;?></td><td>Rs <?php echo number_format($returndata->total,2);?></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.<?php echo number_format($returndata->total,2);?></b></td>
		</tr>
		</table>
		<table class="table table-bordered table-hover">
		<thead>
		<th>Payment Method</th><th>Payment Amount</th><th>Reference Number</th>
		</thead>
		<?php $invoicedata=InvoicereturnPayment::find()->where(['returnid'=>$model->returnid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{ ?>
		<tr>
		<td><?php echo $data->paymentmethod;?></td><td><?php echo $data->paymentamount;?></td>
		
			<td><?php echo $data->referencenumber;?></td>
		</tr>	
		<?php  ++$i;} 
		?>
		</table>
</div>