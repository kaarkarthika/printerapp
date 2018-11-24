<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
</div>
<div class="panel-body">
 <?php $form = ActiveForm::begin(['action' => ['salereport'],'method' => 'get']);
 
 $name="";$mrnumber="";$billnumber="";$paidstatus="";$from="";$to="";$insurancetype="";$patienttype="";
if(isset($_GET['SalesSearch']['name']) && ($_GET['SalesSearch']['name']!=""))
{
	$name=$_GET['SalesSearch']['name'];
} 



if(isset($_GET['SalesSearch']['mrnumber']) && ($_GET['SalesSearch']['mrnumber']!=""))
{
	$mrnumber=$_GET['SalesSearch']['mrnumber'];
} 


if(isset($_GET['SalesSearch']['billnumber']) && ($_GET['SalesSearch']['billnumber']!=""))
{
	$billnumber=$_GET['SalesSearch']['billnumber'];
} 



if(isset($_GET['SalesSearch']['paid_status']) && ($_GET['SalesSearch']['paid_status']!=""))
{
	$paidstatus=$_GET['SalesSearch']['paid_status'];
} 



if(isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!=""))
{
	$from=$_GET['SalesSearch']['invoicedate'];
} 
if(isset($_GET['SalesSearch']['insurancetype']) && ($_GET['SalesSearch']['insurancetype']!=""))
{
	$insurancetype=$_GET['SalesSearch']['insurancetype'];
} 

if(isset($_GET['SalesSearch']['patienttype']) && ($_GET['SalesSearch']['patienttype']!=""))
{
	$patienttype=$_GET['SalesSearch']['patienttype'];
} 


if(isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!=""))
{
	$from=$_GET['SalesSearch']['invoicedate'];
} 



if(isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!="")){
	$to=$_GET['SalesSearch']['updated_on'];
} 




  ?>
 <div class="col-md-2">
  	 <?= $form->field($model, 'name'); ?>
  </div>
<div class="col-md-2">
    <?= $form->field($model, 'mrnumber'); ?>
  </div>
 <div class="col-md-2">
 <?= $form->field($model, 'billnumber'); ?>
 </div>
 <!--  <div class="col-md-2">
 <?= $form->field($model, 'patienttype')->dropdownlist($patienttypelist,['prompt'=>'--Patient--', 
    ]); ?>
 </div> -->
 <!--  <div class="col-md-2">
  <?= $form->field($model, 'insurancetype')->dropdownlist($insurancetypelist,['prompt'=>'--Insurance--', 
    ]); ?>
 </div> -->
 
 
<!-- <div class="col-md-2">
<?= $form->field($model, 'paid_status')->dropdownList(['Paid' => 'Invoice Paid', 'Unpaid' => 'Due Amount'], ['prompt' => '---Select Invoice---']) ?>
 </div> -->
<div class="col-xs-4">
   
   <label>Date Range :</label>
   <div class="input-daterange input-group" id="date-range1">
  <?= $form->field($model, 'invoicedate')->textInput()->label(false); ?>
<span class="input-group-addon bg-custom b-0 text-white">to</span>
 <?= $form->field($model, 'updated_on')->textInput()->label(false); ?>
															</div>
</div>
<!-- <div class="clearfix"></div> -->
   

    <div class="form-group col-sm-2" style="margin-top:18px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
      <!--   <?= Html::resetButton('Reset', ['class' => 'btn btn-warning']) ?> -->
      <a href='index.php?r=report/salereport'> <?php echo Html::Button('<i class="fa fa-refresh" aria-hidden="true"></i> Reset', ['class' => 'btn btn-warning btn-block2']) ?></a>
    </div>

    <?php 
    
 if(isset($_GET['SalesSearch']['name']) && ($_GET['SalesSearch']['name']!="") || 
 isset($_GET['SalesSearch']['mrnumber']) && ($_GET['SalesSearch']['mrnumber']!="") || 
 isset($_GET['SalesSearch']['billnumber']) && ($_GET['SalesSearch']['billnumber']!="") || 
 isset($_GET['SalesSearch']['paid_status']) && ($_GET['SalesSearch']['paid_status']!="") || 
 isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!="") || 
 isset($_GET['SalesSearch']['patienttype']) && ($_GET['SalesSearch']['patienttype']!="") || 
 isset($_GET['SalesSearch']['insurancetype']) && ($_GET['SalesSearch']['insurancetype']!="") || 
 
 isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!="")
)
 
 
 {
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/invoicepdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'billnumber'=>$billnumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'pdf','ptype'=>$patienttype,'itype'=>$insurancetype], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['SalesSearch']['name']) && ($_GET['SalesSearch']['name']!="") || 
 isset($_GET['SalesSearch']['mrnumber']) && ($_GET['SalesSearch']['mrnumber']!="") || 
 isset($_GET['SalesSearch']['billnumber']) && ($_GET['SalesSearch']['billnumber']!="") || 
 isset($_GET['SalesSearch']['paid_status']) && ($_GET['SalesSearch']['paid_status']!="") || 
 isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!="") || 
 isset($_GET['SalesSearch']['patienttype']) && ($_GET['SalesSearch']['patienttype']!="") || 
 isset($_GET['SalesSearch']['insurancetype']) && ($_GET['SalesSearch']['insurancetype']!="") || 
 
  isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/invoicepdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'billnumber'=>$billnumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'ptype'=>$patienttype,'itype'=>$insurancetype,'type'=>'excel'], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
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