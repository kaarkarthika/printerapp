<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\PaymentMethod;
use backend\models\Sales;
use backend\models\InvoicePayment;
$this->title="Invoice Return Payment";
$saleid=$model->saleid;
$saledata=Sales::find()->where(['opsaleid'=>$saleid])->one();
?>

<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?php echo $this->title;?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"> <?php echo $this->title;?></a></li>
</ol>
</div>
</div>
<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
	
		<table class="table table-bordered table-hover">
		<thead>
			<th>S.No</th><th>Patient Name</th><th>Patient Phone Number</th><th>Invoice Number</th><th>Total</th>
		</thead>
		
		<tr>
			<td>1</td><td><?php echo $saledata->name;?></td><td><?php echo $saledata->phonenumber;?></td><td><?php echo $model->return_invoicenumber;?></td><td>Rs .<?php echo number_format($model->total,2);?></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><b>Amount Total</b></td><td><b>Rs.<?php echo number_format($model->total,2);?></b></td>
		</tr>
		</table>
		
		
				<table class="table table-bordered table-hover">
		<thead>
			<th>S.No</th><th>Payment Method</th><th>Payment Amount</th><th>Payment Amount Total</th><th>Card Type</th><th>Card Holder Name</th><th>Reference Number</th>
		</thead>
		<?php $invoicedata=InvoicePayment::find()->where(['saleid'=>$saleid])->all();
		$i=1;
		foreach($invoicedata as $data)
		{ ?>
		<tr>
			<td><?php echo $i;?></td><td><?php echo $data->paymentmethod;?></td><td><?php echo $data->paymentamount;?></td><td></td><td><?php echo $data->cardtype;?></td>
			<td><?php echo $data->cardholdername;?></td>
			<td><?php echo $data->referencenumber;?></td>
		</tr>	
			
		<?php  ++$i;} 
		?>
		
		
		</table>
		
		
		
	
<?php $form = ActiveForm::begin(['id' => 'invoicereturnpayment-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
<?php $total_amount_script=$model->total;?>


<div class="col-md-3">
	 <?php echo $form->field($invoicereturnpayment, 'patientname')->textInput(['class' => 'form-control datepicker','readonly'=>'true','value'=>$saledata->name]);?>

</div>
<div class="col-md-3">
	 <?php echo $form->field($invoicereturnpayment, 'patient_mobilenumber')->textInput(['class' => 'form-control datepicker','readonly'=>'true','value'=>$saledata->phonenumber]);?>

</div>
<div class="col-md-3">
	 <?php echo $form->field($invoicereturnpayment, 'mrnumber')->textInput(['class' => 'form-control datepicker','readonly'=>'true','value'=>$saledata->mrnumber]);?>

</div>
<div class="col-md-3">
	 <?php echo $form->field($invoicereturnpayment, 'return_reason')->textInput(['class' => 'form-control datepicker']);?>

</div>

<div class="col-md-12">
<div class="form-group col-md-4">         
	<?=  $form->field($invoicereturnpayment, 'paymentmethod')->dropDownList(ArrayHelper::map(PaymentMethod::find()->where(['refundmode'=>'Y'])->orderBy('methodorder')->all(),'methodkey','methodname'), ['prompt'=>'--Select Payment Method--'])->label("Payment Method") ?>
        </div>
        <div class="form-group col-md-4">
        	<br>
        	    <?= Html::button( 'Add Payment', ['class' => 'btn btn-success add_payment']) ?>   
	 </div>
	 <div class="form-group col-md-4">        	
        	   <?php echo $form->field($invoicereturnpayment, 'timestamp')->textInput(['class' => 'form-control datepicker', 'data-date-autoclose' => "true",'placeholder' => 'DD-MM-YYYY', 'bootstrap-datepicker',  'date' => [
                'pluginOptions' => [
                    'autoclose' => true,                    
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ],
            ], 'data-required' => "true", 'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'data-date-end-date'=>"0d",'value'=>date("d-m-Y")])->label('Date') ?>             
	 </div>
	 <div id="txt_payment"><?php echo $saved_payment_text;  ?></div>	 
</div> 
<div class="col-md-12">
	<div class="col-md-2">
    <div class="form-group">    	
        <?= Html::Button('Save' , ['class' => 'btn btn-danger paymentsubmit']) ?>
        <?php $return_text='';
									
				
				  ?>
        </div>
       </div>
       <div class="col-md-4">
        <div id='message-show' style="color: red;display: none;">Net amount does not tally!</div>
         <div id='message-required' style="color: red;display: none;">Please fill required field</div>
  
    </div>
   <div class="col-md-2" style="display: inline;">
    <div class="form-group" style="display: none;" id="discount_div">    	
        <?php $return_text='';
				
					echo $return_text = '<div class="col-md-2">' . Html::button('Print Discount Voucher', ['class' => 'btn bg-orange partdetails', 'id' => "btn_printpage" , 'value' => $bunch_autoid, 'data_service_id' => $bunch_autoid,'style="display:none;"']) . '</div>';
				  ?>

        <div id='message-show' style="color: red;display: none;">Net amount does not tally!</div>
         <div id='message-required' style="color: red;display: none;">Please fill required field</div>
    </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?></div></div></div></div></div>
    <script>
	 $(document).ready(function(){
	 	
var payment_total='<?php echo $total_amount_script; ?>';
payment_total=parseFloat(payment_total);
$("body").on("click",".paymentsubmit", function(e){	
   var input_total=0;
   $('input[name^="InvoicereturnPayment[paymentamount]"]').each(function() {
   	 input_total=input_total+parseFloat($(this).val());
	});	
	if(input_total==payment_total){
		
		var payment_type=$('#InvoicereturnPayment-paymentmethod').val();
		
   var j=0;           
var inps = document.getElementsByName('InvoicereturnPayment[referencenumber][]');
for (var i = 0; i <inps.length; i++) {
var inp=inps[i];
   if(inp.value=="")
   {
   	var j=1;
  
   }
   
}

var pm = document.getElementsByName('InvoicereturnPayment[paymentmethodarray][]');

for (var l = 0; l <pm.length; l++) {
var input=pm[l];

}
   
      if(j==0)
      {
      	var r = confirm("Are you sure?");
			if (r == true) {
			  $( "#invoicereturnpayment-form" ).submit();
			} 
      }  
      
      else{
      	$('#message-required').fadeIn();
		$('#message-required').delay(2000).fadeOut('slow');
      }      
		
	}else{
	
		$('#message-show').fadeIn();
		$('#message-show').delay(2000).fadeOut('slow');
	}
});	
$(document).on("input", ".numericonlyvalue", function() {
    this.value = this.value.replace(/[^\d\.\-]/g,'');
});
	 

	$("body").on("click",".add_payment", function(e){ 
		var payment_type=$('#invoicereturnpayment-paymentmethod').val();
		if(payment_type!=''){			 
			var url = '<?= Url::toRoute(["invoice-payment/paymentmethod1","id"=>'']) ?>';
             $.ajax({
                 url: url,
                 type: 'POST',
                 dataType: 'text',
                 data : { 'paymentmethod' : payment_type},
                 success: function (result) {
                 
                 	$('#txt_payment').append(result);
                 	
                 },
                 error: function (error) {
                                     
                 }
			});
			
		}else{
			alert("Please Select Payment method.")
		}
		
	});	
	$("body").on("click",".removepayment", function(e){ 
		$("."+this.id).remove();
	});	
	});	
	 
</script>