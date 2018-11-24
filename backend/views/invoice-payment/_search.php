<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="invoice-payment-search">
<?php $form = ActiveForm::begin(['action' => ['paymenthistory'],'method' => 'get']);
$paymentmethod="";$invno="";$ptype="";$from="";$to="";
if(isset($_GET['InvoicePaymentSearch']['paymentmethod']) && ($_GET['InvoicePaymentSearch']['paymentmethod']!=""))
{
	$paymentmethod=$_GET['InvoicePaymentSearch']['paymentmethod'];
} 
if(isset($_GET['InvoicePaymentSearch']['invoicenumber']) && ($_GET['InvoicePaymentSearch']['invoicenumber']!=""))
{
	$invno=$_GET['InvoicePaymentSearch']['invoicenumber'];
} 
if(isset($_GET['InvoicePaymentSearch']['cardtype']) && ($_GET['InvoicePaymentSearch']['cardtype']!=""))
{
	$ptype=$_GET['InvoicePaymentSearch']['cardtype'];
} 
if(isset($_GET['InvoicePaymentSearch']['timestamp']) && ($_GET['InvoicePaymentSearch']['timestamp']!=""))
{
	$from=$_GET['InvoicePaymentSearch']['timestamp'];
} 
if(isset($_GET['InvoicePaymentSearch']['updated_timestamp']) && ($_GET['InvoicePaymentSearch']['updated_timestamp']!=""))
{
	$to=$_GET['InvoicePaymentSearch']['updated_timestamp'];
} 
?>

  <div class="row">
  	<div class="col-md-3">
  		<?= $form->field($model, 'paymentmethod')->dropdownList($paymentmodelist, ['prompt' => '---Payment Method---'])->label("Payment  Method"); ?>
  	</div>
  	
  	<div class="col-md-2">
  		 <?= $form->field($model, 'invoicenumber')->label("Invoice Number"); ?>
  	</div>
  	
  	<div class="col-md-2">
<?= $form->field($model, 'cardtype')->dropdownList(['1' => 'InPatient', '2' => 'OutPatient'], ['prompt' => '---Patient Type---'])->label("Patient Type"); ?>
 </div>
<div class="col-xs-3">
   
   <label>Date Range :</label>
   <div class="input-daterange input-group" id="date-range">
  <?= $form->field($model, 'timestamp')->textInput()->label(false);?>
<span class="input-group-addon bg-custom b-0 text-white">to</span>
 <?= $form->field($model, 'updated_timestamp')->textInput()->label(false);?>
															</div>
</div>
  <div class="col-xs-2" style="margin-top:25px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary  ']) ?>
      <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning  ','style'=>'margin-right: 2%;']) ?>
    </div>
 </div>
  

    <?php ActiveForm::end(); 
 if(isset($_GET['InvoicePaymentSearch']['paymentmethod']) && ($_GET['InvoicePaymentSearch']['paymentmethod']!="") || 
 isset($_GET['InvoicePaymentSearch']['invoicenumber']) && ($_GET['InvoicePaymentSearch']['invoicenumber']!="") || 
 isset($_GET['InvoicePaymentSearch']['cardtype']) && ($_GET['InvoicePaymentSearch']['cardtype']!="") || 
 isset($_GET['InvoicePaymentSearch']['timestamp']) && ($_GET['InvoicePaymentSearch']['timestamp']!="") || 
  isset($_GET['InvoicePaymentSearch']['updated_timestamp']) && ($_GET['InvoicePaymentSearch']['updated_timestamp']!=""))
  {
  echo '<div class="row"><div class="col-md-2 pull-right">';
  echo Html::a('<i class="fa fa-file-pdf-o"></i> Export pdf ', ['invoice-payment/export' ,'paymentmethod'=>$paymentmethod, 
 'invno'=>$invno, 'ptype'=>$ptype,'from'=>$from,'to'=>$to,'type'=>'pdf'], ['class' => 'btn btn-danger pull-right btn-sm ']); 
  echo '</div></div><br>';      
 }
     
 if(isset($_GET['InvoicePaymentSearch']['paymentmethod']) && ($_GET['InvoicePaymentSearch']['paymentmethod']!="") || 
 isset($_GET['InvoicePaymentSearch']['invoicenumber']) && ($_GET['InvoicePaymentSearch']['invoicenumber']!="") || 
 isset($_GET['InvoicePaymentSearch']['cardtype']) && ($_GET['InvoicePaymentSearch']['cardtype']!="") || 
 isset($_GET['InvoicePaymentSearch']['timestamp']) && ($_GET['InvoicePaymentSearch']['timestamp']!="") || 
 isset($_GET['InvoicePaymentSearch']['updated_timestamp']) && ($_GET['InvoicePaymentSearch']['updated_timestamp']!=""))
 {
  echo '<div class="col-md-2 pull-right">';
 // echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Excel ', ['invoice-payment/export' ,'paymentmethod'=>$paymentmethod, 
// 'invno'=>$invno, 'ptype'=>$ptype,'from'=>$from,'to'=>$to,'type'=>'excel'], ['class' => 'btn btn-danger btn-sm ']); 
      echo '</div>';
	  echo '<div class="clearfix"></div>';
 } 
    ?>

</div>
