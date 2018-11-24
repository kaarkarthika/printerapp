<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\CompanyBranch;
$form = ActiveForm::begin([ 'action' => ['audit'],'method' => 'get']); 
$productid="";$vendorid="";$compositionid="";$stockcode="";$brandcode="";$expfrom="";$expto="";$branchid="";



if(isset($_GET['StockresponseSearch']['productname']) && ($_GET['StockresponseSearch']['productname']!="")){
	$productid=$_GET['StockresponseSearch']['productname'];
} 
if(isset($_GET['StockresponseSearch']['vendorname']) && ($_GET['StockresponseSearch']['vendorname']!="")){
	$vendorid=$_GET['StockresponseSearch']['vendorname'];
} 
if(isset($_GET['StockresponseSearch']['compositionname']) && ($_GET['StockresponseSearch']['compositionname']!="")){
	$compositionid=$_GET['StockresponseSearch']['compositionname'];
} 
if($_GET['StockresponseSearch']['brandcode']!=""){
	$brandcode=$_GET['StockresponseSearch']['brandcode'];
} 
if(isset($_GET['StockresponseSearch']['stockcode']) && ($_GET['StockresponseSearch']['stockcode']!="")){
	$stockcode=$_GET['StockresponseSearch']['stockcode'];
} 
if(isset($_GET['StockresponseSearch']['expiredate']) && ($_GET['StockresponseSearch']['expiredate']!="")){
	$expfrom=$_GET['StockresponseSearch']['expiredate'];
} 
if(isset($_GET['StockresponseSearch']['manufacturedate']) && ($_GET['StockresponseSearch']['manufacturedate']!="")){
	$expto=$_GET['StockresponseSearch']['manufacturedate'];
} 
if(isset($_GET['StockresponseSearch']['branch_id']) && ($_GET['StockresponseSearch']['branch_id']!="")){
	$branchid=$_GET['StockresponseSearch']['branch_id'];
}


 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id']; 
		if($role=="Super")
		{
			$companylist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
		}
		else{
			$companylist=[];
		}
		if($role=="Super")
		{
			echo' <div class=" col-md-2">	';
		echo $form->field($model, 'branch_id')->Dropdownlist($companylist,['prompt'=>'Select Company Branch','id'=>'branchid','class'=>'form-control selectpicker','data-style'=>"btn-default btn-custom",'data-live-search'=>'true','value'=>$branchid])->label("Company Branch");
		echo '</div>';
		}
		else{ echo   $form->field($model, 'branch_id')->hiddenInput(['value'=>$companybranchid,'id'=>'branchid'])->label(false);} 
		?>
<div class="col-xs-2">
    <?= $form->field($model, 'productname')->dropdownlist($productlist,['prompt'=>'Select Product','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"]); ?>
   </div>
<div class="col-xs-2">
	
    <?= $form->field($model, 'vendorname')->dropdownlist($vendorlist,['prompt'=>'Select Vendor', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",]); ?>
</div>
   <div class="col-xs-2">
    <?= $form->field($model, 'brandcode')->textInput(['id'=>"brandcode",'class'=>"form-control ", 
   ])->label('Brand Code'); ?>
   </div>
   <div class="col-xs-2">
    <?= $form->field($model, 'stockcode')->textInput(['id'=>"stockcode",'class'=>"form-control ",
   ])->label('Stock Code'); ?>
   </div>
   	<div class="col-xs-4">
    <?= $form->field($model, 'compositionname')->dropdownlist($compositionlist,['prompt'=>'Select Composition','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"])->label("Composition"); ?>
   </div>
     <div class="col-xs-4">
   <label>Expire Date :</label>
   <div class="input-daterange input-group" id="date-range">
  <?= $form->field($model, 'expiredate')->textInput(['placeholder'=>'from'])->label(false); ?>
<span class="input-group-addon bg-custom b-0 text-white"></span>
 <?= $form->field($model, 'manufacturedate')->textInput(['placeholder'=>'To'])->label(false); ?>
</div>
</div>

<div class="clearfix"></div>
    <div class="col-md-12">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default']) ?>
      <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']) ?>
 
			<?php 
if(isset($_GET['StockresponseSearch']['productname']) && ($_GET['StockresponseSearch']['productname']!="") ||
isset($_GET['StockresponseSearch']['vendorname']) && ($_GET['StockresponseSearch']['vendorname']!="") ||
isset($_GET['StockresponseSearch']['compositionname']) && ($_GET['StockresponseSearch']['compositionname']!="") ||
isset($_GET['StockresponseSearch']['stockcode']) && ($_GET['StockresponseSearch']['stockcode']!="") ||
isset($_GET['StockresponseSearch']['expiredate']) && ($_GET['StockresponseSearch']['expiredate']!="") ||
isset($_GET['StockresponseSearch']['manufacturedate']) && ($_GET['StockresponseSearch']['manufacturedate']!="") ||
isset($_GET['StockresponseSearch']['branch_id']) && ($_GET['StockresponseSearch']['branch_id']!="") ||
isset($_GET['StockresponseSearch']['brandcode']) && ($_GET['StockresponseSearch']['brandcode']!="")){
 	echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-pdf-o"></i> Export Pdf ', ['stockmaster/exportpdfdownload' ,'productid'=>$productid, 'vendorid'=>$vendorid, 'compositionid'=>$compositionid,
       'brandcode'=>$brandcode,'stockcode'=>$stockcode,'expfrom'=>$expfrom,'expto'=>$expto,'branchid'=>$branchid], 
       ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
  echo '</div>';      
 } 



if(isset($_GET['StockresponseSearch']['productname']) && ($_GET['StockresponseSearch']['productname']!="") ||
isset($_GET['StockresponseSearch']['vendorname']) && ($_GET['StockresponseSearch']['vendorname']!="") ||
isset($_GET['StockresponseSearch']['compositionname']) && ($_GET['StockresponseSearch']['compositionname']!="") ||
isset($_GET['StockresponseSearch']['stockcode']) && ($_GET['StockresponseSearch']['stockcode']!="") ||
isset($_GET['StockresponseSearch']['expiredate']) && ($_GET['StockresponseSearch']['expiredate']!="") ||
isset($_GET['StockresponseSearch']['manufacturedate']) && ($_GET['StockresponseSearch']['manufacturedate']!="") ||
isset($_GET['StockresponseSearch']['branch_id']) && ($_GET['StockresponseSearch']['branch_id']!="") ||
isset($_GET['StockresponseSearch']['brandcode']) && ($_GET['StockresponseSearch']['brandcode']!="")){
     echo '<div class="col-md-2 pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['stockmaster/exportexceldownload' ,'productid'=>$productid, 
       'vendorid'=>$vendorid, 'compositionid'=>$compositionid,'brandcode'=>$brandcode,'stockcode'=>$stockcode,'expfrom'=>$expfrom,'expto'=>$expto,'branchid'=>$branchid], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</div>';
	  echo '<div class="clearfix" style="margin-bottom:30px;"></div>';
	   }
      ActiveForm::end(); ?>