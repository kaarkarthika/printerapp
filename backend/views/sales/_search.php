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
 <?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get']);
 
 $from="";$to=""; 
 

if(isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!=""))
{
    $from=$_GET['SalesSearch']['invoicedate'];
}  
if(isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!="")){
    $to=$_GET['SalesSearch']['updated_on'];
} 
 
  ?>
  
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
      <a href='index.php?r=sales/index'> <?php echo Html::Button('<i class="fa fa-refresh" aria-hidden="true"></i> Reset', ['class' => 'btn btn-warning btn-block2']) ?></a>
    </div>

    <?php 
    
 if(isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!="") || 
    isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!=""))
 
 
 {
    echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/invoicepdfdownload' ,'name'=>$name, 'mrnumber'=>$mrnumber, 'billnumber'=>$billnumber,
       'paid_status'=>$paidstatus,'from'=>$from,'to'=>$to,'type'=>'pdf','ptype'=>$patienttype,'itype'=>$insurancetype], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['SalesSearch']['invoicedate']) && ($_GET['SalesSearch']['invoicedate']!="") || 
  isset($_GET['SalesSearch']['updated_on']) && ($_GET['SalesSearch']['updated_on']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/invoicepdfdownload' ,'from'=>$from,'to'=>$to], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
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