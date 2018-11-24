<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
 <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">

<div class="panel-body">
 <?php $form = ActiveForm::begin(['action' => ['inreturnreport'],'method' => 'get']);
 
 $name="";$mrnumber="";$return_invoicenumber="";$paidstatus="";$from="";$to="";
if(isset($_GET['InSalesreturnSearch']['name']) && ($_GET['InSalesreturnSearch']['name']!="")){
	$name=$_GET['InSalesreturnSearch']['name'];
} 

if(isset($_GET['InSalesreturnSearch']['mrnumber']) && ($_GET['InSalesreturnSearch']['mrnumber']!="")){
	$mrnumber=$_GET['InSalesreturnSearch']['mrnumber'];
} 

if(isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!=""))
{
  $ip_no=$_GET['InSalesSearch']['ip_no'];
} 

if(isset($_GET['InSalesreturnSearch']['return_invoicenumber']) && ($_GET['InSalesreturnSearch']['return_invoicenumber']!="")){
	$return_invoicenumber=$_GET['InSalesreturnSearch']['return_invoicenumber'];
} 
if(isset($_GET['InSalesreturnSearch']['paid_status']) && ($_GET['InSalesreturnSearch']['paid_status']!="")){
	$paidstatus=$_GET['InSalesreturnSearch']['paid_status'];
} 
if(isset($_GET['InSalesreturnSearch']['returndate']) && ($_GET['InSalesreturnSearch']['returndate']!="")){
	$from=$_GET['InSalesreturnSearch']['returndate'];
} 
if(isset($_GET['InSalesreturnSearch']['updated_on']) && ($_GET['InSalesreturnSearch']['updated_on']!="")){
	$to=$_GET['InSalesreturnSearch']['updated_on'];
} 
  ?>
  <div class="row">
 <div class="col-md-2">
  	 <?= $form->field($model, 'name')->label('Name'); ?>
  </div>
  <div class="col-md-1" style="width: 10%;">
    <?= $form->field($model, 'ip_no')->label('IP No'); ?>
  </div>
<div class="col-md-1" style="width: 10%;">
    <?= $form->field($model, 'mrnumber')->label('Mr Number'); ?>
  </div>
 <div class="col-md-2">
 <?= $form->field($model, 'return_invoicenumber')->label('Invoice Number'); ?>
 </div>
<!-- <div class="col-md-3">
<?= $form->field($model, 'paid_status')->dropdownList(['Yes' => 'Invoice Paid', 'No' => 'Invoice Generated'], ['prompt' => '---Select Invoice---']) ?>
 </div> -->
<div class="col-xs-3">
   
   <label>Date Range :</label>
   <div class="input-daterange input-group" id="date-range1">
  <?= $form->field($model, 'returndate')->textInput()->label(false); ?>
<span class="input-group-addon bg-custom b-0 text-white">to</span>
 <?= $form->field($model, 'updated_on')->textInput()->label(false); ?>
															</div>
</div>
<!-- <div class="clearfix"></div> -->
   

    <div class="form-group col-xs-2" style="margin-top:18px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
       <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']) ?>
    </div>
    </div>

    <?php 
    
 if(isset($_GET['InSalesreturnSearch']['name']) && ($_GET['InSalesreturnSearch']['name']!="") || 
 isset($_GET['InSalesreturnSearch']['mrnumber']) && ($_GET['InSalesreturnSearch']['mrnumber']!="") || 
 isset($_GET['InSalesreturnSearch']['return_invoicenumber']) && ($_GET['InSalesreturnSearch']['return_invoicenumber']!="") || 
 isset($_GET['InSalesreturnSearch']['paid_status']) && ($_GET['InSalesreturnSearch']['paid_status']!="") ||
 isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!="") || 
 isset($_GET['InSalesreturnSearch']['returndate']) && ($_GET['InSalesreturnSearch']['returndate']!="") || 
 isset($_GET['InSalesreturnSearch']['updated_on']) && ($_GET['InSalesreturnSearch']['updated_on']!="")
)
 
 
 {
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/invoicereturnpdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber,'ip_no'=>$ip_no, 'return_invoicenumber'=>$return_invoicenumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'pdf'], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['InSalesreturnSearch']['name']) && ($_GET['InSalesreturnSearch']['name']!="") || 
 isset($_GET['InSalesreturnSearch']['mrnumber']) && ($_GET['InSalesreturnSearch']['mrnumber']!="") || 
 isset($_GET['InSalesreturnSearch']['return_invoicenumber']) && ($_GET['InSalesreturnSearch']['return_invoicenumber']!="") || 
 isset($_GET['InSalesreturnSearch']['paid_status']) && ($_GET['InSalesreturnSearch']['paid_status']!="") || 
 isset($_GET['InSalesreturnSearch']['returndate']) && ($_GET['InSalesreturnSearch']['returndate']!="") ||
 isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!="") ||  
  isset($_GET['InSalesreturnSearch']['updated_on']) && ($_GET['InSalesreturnSearch']['updated_on']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/invoicereturnpdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber,'ip_no'=>$ip_no, 'return_invoicenumber'=>$return_invoicenumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'excel'], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</div>';
	  echo '<div class="clearfix"></div>';
	   }
    ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
$('#date-range1').datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
})
				
				
				});
</script>