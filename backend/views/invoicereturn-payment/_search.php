<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="invoice-payment-search">
<?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get']);
$paymentmethod="";$invno="";$ptype="";$from="";$to="";
if(isset($_GET['InvoicereturnPaymentSearch']['paymentmethod']) && ($_GET['InvoicereturnPaymentSearch']['paymentmethod']!=""))
{
	$paymentmethod=$_GET['InvoicereturnPaymentSearch']['paymentmethod'];
} 
if(isset($_GET['InvoicereturnPaymentSearch']['invoicenumber']) && ($_GET['InvoicereturnPaymentSearch']['invoicenumber']!=""))
{
	$invno=$_GET['InvoicereturnPaymentSearch']['invoicenumber'];
} 
if(isset($_GET['InvoicereturnPaymentSearch']['referencenumber']) && ($_GET['InvoicereturnPaymentSearch']['referencenumber']!=""))
{
	$ptype=$_GET['InvoicereturnPaymentSearch']['referencenumber'];
} 
if(isset($_GET['InvoicereturnPaymentSearch']['timestamp']) && ($_GET['InvoicereturnPaymentSearch']['timestamp']!=""))
{
	$from=$_GET['InvoicereturnPaymentSearch']['timestamp'];
} 
if(isset($_GET['InvoicereturnPaymentSearch']['updated_timestamp']) && ($_GET['InvoicereturnPaymentSearch']['updated_timestamp']!=""))
{
	$to=$_GET['InvoicereturnPaymentSearch']['updated_timestamp'];
} 
?>

  <div class="row">
  	<div class="col-md-3">
  		<?= $form->field($model, 'paymentmethod')->dropdownList(['cashpayment'=>'cashpayment','customercheque'=>'customercheque','rtgsneft'=>'rtgsneft'], ['prompt' => '---Payment Method---'])->label("Payment  Method"); ?>
  	</div>
  	
  	<div class="col-md-2">
  		 <?= $form->field($model, 'invoicenumber')->label("Invoice Number"); ?>
  	</div>
  	
  	<div class="col-md-2">
<?= $form->field($model, 'referencenumber')->dropdownList(['1' => 'InPatient', '2' => 'OutPatient'], ['prompt' => '---Patient Type---'])->label("Patient Type"); ?>
 </div>
<div class="col-xs-3">
   
   <label>Date Range :</label>
   <div class="input-daterange input-group" id="date-range">
  <?= $form->field($model, 'timestamp')->textInput()->label(false);?>
<span class="input-group-addon bg-custom b-0 text-white">to</span>
 <?= $form->field($model, 'updated_timestamp')->textInput()->label(false);?>
															</div>
</div>
<div class="form-group" style="margin-top:25px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']) ?>
    </div>
 </div>
    

    <?php ActiveForm::end(); 
 if(isset($_GET['InvoicereturnPaymentSearch']['paymentmethod']) && ($_GET['InvoicereturnPaymentSearch']['paymentmethod']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['invoicenumber']) && ($_GET['InvoicereturnPaymentSearch']['invoicenumber']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['referencenumber']) && ($_GET['InvoicereturnPaymentSearch']['referencenumber']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['timestamp']) && ($_GET['InvoicereturnPaymentSearch']['timestamp']!="") || 
  isset($_GET['InvoicereturnPaymentSearch']['updated_timestamp']) && ($_GET['InvoicereturnPaymentSearch']['updated_timestamp']!=""))
  {
  echo '<div class="col-md-2 pull-right">';
  echo Html::a('<i class="fa fa-file-pdf-o"></i> Export pdf ', ['invoicereturn-payment/export' ,'paymentmethod'=>$paymentmethod, 
 'invno'=>$invno, 'ptype'=>$ptype,'from'=>$from,'to'=>$to,'type'=>'pdf'], ['class' => 'btn btn-danger btn-sm ']); 
  echo '</div>';      
 }
     
 if(isset($_GET['InvoicereturnPaymentSearch']['paymentmethod']) && ($_GET['InvoicereturnPaymentSearch']['paymentmethod']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['invoicenumber']) && ($_GET['InvoicereturnPaymentSearch']['invoicenumber']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['referencenumber']) && ($_GET['InvoicereturnPaymentSearch']['referencenumber']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['timestamp']) && ($_GET['InvoicereturnPaymentSearch']['timestamp']!="") || 
 isset($_GET['InvoicereturnPaymentSearch']['updated_timestamp']) && ($_GET['InvoicereturnPaymentSearch']['updated_timestamp']!=""))
 {
  echo '<div class="col-md-2 pull-right">';
 // echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Excel ', ['invoicereturn-payment/export' ,'paymentmethod'=>$paymentmethod, 
// 'invno'=>$invno, 'ptype'=>$ptype,'from'=>$from,'to'=>$to,'type'=>'excel'], ['class' => 'btn btn-danger btn-sm ']); 
      echo '</div>';
	  echo '<div class="clearfix"></div>';
 } 
    ?>

</div>
