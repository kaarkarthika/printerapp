<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
 $form = ActiveForm::begin([ 'action' => ['stockindex'],'method' => 'get']); ?>
<div class="col-xs-2">
    <?= $form->field($model, 'productid')->dropdownlist($productlist,['prompt'=>'Select Product','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"]); ?>
   </div>
<div class="col-xs-2">
	
    <?= $form->field($model, 'vendorid')->dropdownlist($vendorlist,['prompt'=>'Select Vendor', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",]); ?>
</div>
   <div class="col-xs-2">
    <?= $form->field($model, 'brandcode') ?> 
   </div>
   <div class="col-xs-2">
    <?= $form->field($model, 'stockcode') ?>
     </div>
     <div class="col-xs-4">
    <?= $form->field($model, 'updated_ipaddress')->textInput(['id'=>"reportrange",'class'=>"form-control input-daterange-datepicker", 'value'=>''
   ])->label('Expire Date'); ?>
</div>
     <div class="col-xs-4">
    <?= $form->field($model, 'compositionid')->dropdownlist($compositionlist,['prompt'=>'Select Composition','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"])->label("Composition"); ?>
   </div>
     
<div class="clearfix"></div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']) ?>
    </div>
<div class="clearfix"></div>
<?php
$productid="";$vendorid="";$compositionid="";$stockcode="";$brandcode="";
if(isset($_GET['StockmasterSearch']['productid']) && ($_GET['StockmasterSearch']['productid']!="")){
	$productid=$_GET['StockmasterSearch']['productid'];
} 

if(isset($_GET['StockmasterSearch']['vendorid']) && ($_GET['StockmasterSearch']['vendorid']!="")){
	$vendorid=$_GET['StockmasterSearch']['vendorid'];
} 

if(isset($_GET['StockmasterSearch']['compositionid']) && ($_GET['StockmasterSearch']['compositionid']!="")){
	$compositionid=$_GET['StockmasterSearch']['compositionid'];
} 
if(isset($_GET['StockmasterSearch']['brandcode']) && ($_GET['StockmasterSearch']['brandcode']!="")){
	$brandcode=$_GET['StockmasterSearch']['brandcode'];
} 
if(isset($_GET['StockmasterSearch']['stockcode']) && ($_GET['StockmasterSearch']['stockcode']!="")){
	$stockcode=$_GET['StockmasterSearch']['stockcode'];
} 
if(isset($_GET['StockmasterSearch']['updated_ipaddress']) && ($_GET['StockmasterSearch']['updated_ipaddress']!="")){
	$expdate=$_GET['StockmasterSearch']['updated_ipaddress'];
} 


?>


			<?php 
 if(isset($_GET['StockmasterSearch']['productid']) && ($_GET['StockmasterSearch']['productid']!="") || 
 isset($_GET['StockmasterSearch']['vendorid']) && ($_GET['StockmasterSearch']['vendorid']!="") || 
 isset($_GET['StockmasterSearch']['compositonid']) && ($_GET['StockmasterSearch']['compositonid']!="") || 
 isset($_GET['StockmasterSearch']['stockcode']) && ($_GET['StockmasterSearch']['stockcode']!="") || 
  isset($_GET['StockmasterSearch']['updated_ipaddress']) && ($_GET['StockmasterSearch']['updated_ipaddress']!="") || 
 isset($_GET['StockmasterSearch']['brandcode']) && ($_GET['StockmasterSearch']['brandcode']!="")){
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['stockmaster/exportpdfdownload' ,'productid'=>$productid, 'vendorid'=>$vendorid, 'compositionid'=>$compositionid,
       'brandcode'=>$brandcode,'stockcode'=>$stockcode,'expdate'=>$expdate], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 }
     
 if(isset($_GET['StockmasterSearch']['productid']) && ($_GET['StockmasterSearch']['productid']!="") || 
 isset($_GET['StockmasterSearch']['vendorid']) && ($_GET['StockmasterSearch']['vendorid']!="") || 
 isset($_GET['StockmasterSearch']['compositonid']) && ($_GET['StockmasterSearch']['compositonid']!="") || 
 isset($_GET['StockmasterSearch']['stockcode']) && ($_GET['StockmasterSearch']['stockcode']!="") || 
  isset($_GET['StockmasterSearch']['updated_ipaddress']) && ($_GET['StockmasterSearch']['updated_ipaddress']!="") || 
 isset($_GET['StockmasterSearch']['brandcode']) && ($_GET['StockmasterSearch']['brandcode']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['stockmaster/exportexceldownload' ,'productid'=>$productid, 
       'vendorid'=>$vendorid, 'compositionid'=>$compositionid,'brandcode'=>$brandcode,'stockcode'=>$stockcode,'expdate'=>$expdate],
        ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</div>';
	  echo '<div class="clearfix"></div>';
		
	
	   }
      ActiveForm::end(); ?>