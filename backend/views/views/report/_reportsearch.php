<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
 <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">

<div class="panel-body">
 <?php $form = ActiveForm::begin(['action' => ['returnreport'],'method' => 'get']);
 
 $name="";$mrnumber="";$return_invoicenumber="";$paidstatus="";$from="";$to="";
if(isset($_GET['SalesreturnSearch']['name']) && ($_GET['SalesreturnSearch']['name']!="")){
	$name=$_GET['SalesreturnSearch']['name'];
} 

if(isset($_GET['SalesreturnSearch']['mrnumber']) && ($_GET['SalesreturnSearch']['mrnumber']!="")){
	$mrnumber=$_GET['SalesreturnSearch']['mrnumber'];
} 

if(isset($_GET['SalesreturnSearch']['return_invoicenumber']) && ($_GET['SalesreturnSearch']['return_invoicenumber']!="")){
	$return_invoicenumber=$_GET['SalesreturnSearch']['return_invoicenumber'];
} 
if(isset($_GET['SalesreturnSearch']['paid_status']) && ($_GET['SalesreturnSearch']['paid_status']!="")){
	$paidstatus=$_GET['SalesreturnSearch']['paid_status'];
} 
if(isset($_GET['SalesreturnSearch']['returndate']) && ($_GET['SalesreturnSearch']['returndate']!="")){
	$from=$_GET['SalesreturnSearch']['returndate'];
} 
if(isset($_GET['SalesreturnSearch']['updated_on']) && ($_GET['SalesreturnSearch']['updated_on']!="")){
	$to=$_GET['SalesreturnSearch']['updated_on'];
} 
  ?>
 <div class="col-md-2">
  	 <?= $form->field($model, 'name')->label('Name'); ?>
  </div>
<div class="col-md-2">
    <?= $form->field($model, 'mrnumber')->label('Mrn Number'); ?>
  </div>
 <div class="col-md-2">
 <?= $form->field($model, 'return_invoicenumber')->label('Invoice Number'); ?>
 </div>
<div class="col-md-2">
<?= $form->field($model, 'paid_status')->dropdownList(['Yes' => 'Invoice Paid', 'No' => 'Invoice Generated'], ['prompt' => '---Select Invoice---']) ?>
 </div>
<div class="col-xs-4">
   
   <label>Date Range :</label>
   <div class="input-daterange input-group" id="date-range">
  <?= $form->field($model, 'returndate')->textInput()->label(false); ?>
<span class="input-group-addon bg-custom b-0 text-white">to</span>
 <?= $form->field($model, 'updated_on')->textInput()->label(false); ?>
															</div>
</div>
<div class="clearfix"></div>
   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
       <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']) ?>
    </div>

    <?php 
    
 if(isset($_GET['SalesreturnSearch']['name']) && ($_GET['SalesreturnSearch']['name']!="") || 
 isset($_GET['SalesreturnSearch']['mrnumber']) && ($_GET['SalesreturnSearch']['mrnumber']!="") || 
 isset($_GET['SalesreturnSearch']['return_invoicenumber']) && ($_GET['SalesreturnSearch']['return_invoicenumber']!="") || 
 isset($_GET['SalesreturnSearch']['paid_status']) && ($_GET['SalesreturnSearch']['paid_status']!="") || 
 isset($_GET['SalesreturnSearch']['returndate']) && ($_GET['SalesreturnSearch']['returndate']!="") || 
 isset($_GET['SalesreturnSearch']['updated_on']) && ($_GET['SalesreturnSearch']['updated_on']!="")
)
 
 
 {
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/invoicereturnpdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'return_invoicenumber'=>$return_invoicenumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'pdf'], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['SalesreturnSearch']['name']) && ($_GET['SalesreturnSearch']['name']!="") || 
 isset($_GET['SalesreturnSearch']['mrnumber']) && ($_GET['SalesreturnSearch']['mrnumber']!="") || 
 isset($_GET['SalesreturnSearch']['return_invoicenumber']) && ($_GET['SalesreturnSearch']['return_invoicenumber']!="") || 
 isset($_GET['SalesreturnSearch']['paid_status']) && ($_GET['SalesreturnSearch']['paid_status']!="") || 
 isset($_GET['SalesreturnSearch']['returndate']) && ($_GET['SalesreturnSearch']['returndate']!="") || 
  isset($_GET['SalesreturnSearch']['updated_on']) && ($_GET['SalesreturnSearch']['updated_on']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/invoicereturnpdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'return_invoicenumber'=>$return_invoicenumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'excel'], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</div>';
	  echo '<div class="clearfix"></div>';
	   }
    ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
