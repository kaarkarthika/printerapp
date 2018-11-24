<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
 $form = ActiveForm::begin([ 'action' => ['purchaseorder'],'method' => 'get']); ?>
<div class="row">
 <div class="col-md-4">
	  <?= $form->field($model, 'requestcode')->dropdownlist($requestcodelist,['prompt'=>'Select Requestcode', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",'required'=>'true']); ?>
</div>
<div class="col-md-3">
	 <?= $form->field($model, 'vendorid')->dropdownlist($vendorlist,['prompt'=>'Select Vendor', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",]); ?>
</div>
<div class="col-md-3">
<?php echo $form->field($model, 'requestdate')->textInput(['maxlength' => true,'data-provide' => "datepicker", 'data-date-format' => "dd/mm/yyyy"]); ?>
</div>
    <div class="form-group col-md-2" style="margin-top:25px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary ']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']) ?>
    </div>
	</div>
    <?php
$requestcode="";$vendorid="";$requestdate="";
if(isset($_GET['StockrequestSearch']['requestcode']) && ($_GET['StockrequestSearch']['requestcode']!="")){
	$requestcode=$_GET['StockrequestSearch']['requestcode'];
} 

if(isset($_GET['StockrequestSearch']['vendorid']) && ($_GET['StockrequestSearch']['vendorid']!="")){
	$vendorid=$_GET['StockrequestSearch']['vendorid'];
} 

if(isset($_GET['StockrequestSearch']['requestdate']) && ($_GET['StockrequestSearch']['requestdate']!="")){
	$requestdate=$_GET['StockrequestSearch']['requestdate'];
} 


?>


			<?php 
 if(isset($_GET['StockrequestSearch']['requestcode']) && ($_GET['StockrequestSearch']['requestcode']!="") || 
 isset($_GET['StockrequestSearch']['vendorid']) && ($_GET['StockrequestSearch']['vendorid']!="") || 
 isset($_GET['StockrequestSearch']['requestdate']) && ($_GET['StockrequestSearch']['requestdate']!="") ){
 	echo '<table class="table  table-striped"><tr><td width="800px"></td><td>';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['report/popdfexport' ,'requestcode'=>$requestcode, 'vendorid'=>$vendorid, 'requestdate'=>$requestdate], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '<td>';      
 }
     
 if(isset($_GET['StockrequestSearch']['requestcode']) && ($_GET['StockrequestSearch']['requestcode']!="") || 
 isset($_GET['StockrequestSearch']['vendorid']) && ($_GET['StockrequestSearch']['vendorid']!="") || 
 isset($_GET['StockrequestSearch']['requestdate']) && ($_GET['StockrequestSearch']['requestdate']!="") || 
 isset($_GET['StockrequestSearch']['stockcode']) && ($_GET['StockrequestSearch']['stockcode']!="") || 
   isset($_GET['StockrequestSearch']['expiredate']) && ($_GET['StockrequestSearch']['updated_ipaddress']!="") || 
 isset($_GET['StockrequestSearch']['brandcode']) && ($_GET['StockrequestSearch']['brandcode']!="")){
      	echo '<td class="pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/poexcelexport' ,'requestcode'=>$requestcode, 
       'vendorid'=>$vendorid, 'requestdate'=>$requestdate], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</td>
		
	</tr>
</table>';
	   }
    ActiveForm::end(); ?>

