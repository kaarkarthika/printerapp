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
 <?php $form = ActiveForm::begin(['action' => ['insalesreport'],'method' => 'get']);
 
 $name="";$mrnumber="";$billnumber="";$paidstatus="";$from="";$to="";$insurancetype="";$patienttype="";
if(isset($_GET['InSalesSearch']['name']) && ($_GET['InSalesSearch']['name']!=""))
{
	$name=$_GET['InSalesSearch']['name'];
} 


if(isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!=""))
{
  $ip_no=$_GET['InSalesSearch']['ip_no'];
} 


if(isset($_GET['InSalesSearch']['mrnumber']) && ($_GET['InSalesSearch']['mrnumber']!=""))
{
	$mrnumber=$_GET['InSalesSearch']['mrnumber'];
} 


if(isset($_GET['InSalesSearch']['billnumber']) && ($_GET['InSalesSearch']['billnumber']!=""))
{
	$billnumber=$_GET['InSalesSearch']['billnumber'];
} 



if(isset($_GET['InSalesSearch']['paid_status']) && ($_GET['InSalesSearch']['paid_status']!=""))
{
	$paidstatus=$_GET['InSalesSearch']['paid_status'];
} 



if(isset($_GET['InSalesSearch']['invoicedate']) && ($_GET['InSalesSearch']['invoicedate']!=""))
{
	$from=$_GET['InSalesSearch']['invoicedate'];
} 
if(isset($_GET['InSalesSearch']['insurancetype']) && ($_GET['InSalesSearch']['insurancetype']!=""))
{
	$insurancetype=$_GET['InSalesSearch']['insurancetype'];
} 

if(isset($_GET['InSalesSearch']['patienttype']) && ($_GET['InSalesSearch']['patienttype']!=""))
{
	$patienttype=$_GET['InSalesSearch']['patienttype'];
} 


if(isset($_GET['InSalesSearch']['invoicedate']) && ($_GET['InSalesSearch']['invoicedate']!=""))
{
	$from=$_GET['InSalesSearch']['invoicedate'];
} 



if(isset($_GET['InSalesSearch']['updated_on']) && ($_GET['InSalesSearch']['updated_on']!="")){
	$to=$_GET['InSalesSearch']['updated_on'];
} 




  ?>
 <div class="col-md-2">
  	 <?= $form->field($model, 'name'); ?>
  </div>
  <div class="col-md-1" style="width: 10%;">
    <?= $form->field($model, 'ip_no')->label('IP No'); ?>
  </div>
<div class="col-md-1" style="width: 10%;">
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
<div class="col-xs-3">
   
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
    
 if(isset($_GET['InSalesSearch']['name']) && ($_GET['InSalesSearch']['name']!="") || 
 isset($_GET['InSalesSearch']['mrnumber']) && ($_GET['InSalesSearch']['mrnumber']!="") ||
 isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!="") || 
 isset($_GET['InSalesSearch']['billnumber']) && ($_GET['InSalesSearch']['billnumber']!="") || 
 isset($_GET['InSalesSearch']['paid_status']) && ($_GET['InSalesSearch']['paid_status']!="") || 
 isset($_GET['InSalesSearch']['invoicedate']) && ($_GET['InSalesSearch']['invoicedate']!="") || 
 isset($_GET['InSalesSearch']['patienttype']) && ($_GET['InSalesSearch']['patienttype']!="") || 
 isset($_GET['InSalesSearch']['insurancetype']) && ($_GET['InSalesSearch']['insurancetype']!="") || 
 
 isset($_GET['InSalesSearch']['updated_on']) && ($_GET['InSalesSearch']['updated_on']!="")
)
 
 
 {
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/invoicepdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber,'ip_no'=>$ip_no, 'billnumber'=>$billnumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'pdf','ptype'=>$patienttype,'itype'=>$insurancetype], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['InSalesSearch']['name']) && ($_GET['InSalesSearch']['name']!="") || 
 isset($_GET['InSalesSearch']['mrnumber']) && ($_GET['InSalesSearch']['mrnumber']!="") || 
 isset($_GET['InSalesSearch']['billnumber']) && ($_GET['InSalesSearch']['billnumber']!="") || 
 isset($_GET['InSalesSearch']['ip_no']) && ($_GET['InSalesSearch']['ip_no']!="") || 
 isset($_GET['InSalesSearch']['paid_status']) && ($_GET['InSalesSearch']['paid_status']!="") || 
 isset($_GET['InSalesSearch']['invoicedate']) && ($_GET['InSalesSearch']['invoicedate']!="") || 
 isset($_GET['InSalesSearch']['patienttype']) && ($_GET['InSalesSearch']['patienttype']!="") || 
 isset($_GET['InSalesSearch']['insurancetype']) && ($_GET['InSalesSearch']['insurancetype']!="") || 
 
  isset($_GET['InSalesSearch']['updated_on']) && ($_GET['InSalesSearch']['updated_on']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/invoicepdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'ip_no'=>$ip_no, 'billnumber'=>$billnumber,
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