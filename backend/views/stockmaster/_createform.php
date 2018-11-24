<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title="Create Stock";

?>
<style>
	#load{display: none;position: fixed;left: 128px;top: 27px;width: 100%;height: 100%;z-index: 9999;/*opacity: 0.6;*/margin-top: 20%; }
	input.error{background: rgb(251, 227, 228);border: 1px solid #fbc2c4;color: #8a1f11;}
	 #wrapper,.content-page{
	 
 overflow:unset;
 }
</style>

<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
	<a class='btn btn-primary' style="float: right;" title="Stock Grid Table" href="<?php echo Yii::$app->homeUrl . "?r=stockmaster/index";?>">Grid</a>	
	
		<a class='btn btn-primary' style="float: right;" title="Add Product Group" href="<?php echo Yii::$app->homeUrl . "?r=productgrouping/create";?>">Group</a>	
</ol>
</div>
</div>

<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>

<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
	
</div>
<div class="panel-body">
	
	 <?php $form = ActiveForm::begin([
	 'id'=>'addform',
        'action' => ['addstock'],
        'method' => 'post',
    ]); 
   		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
	/*	if($role=="Super")
		{
			echo' <div class=" col-md-3">	';
		echo $form->field($model, 'branch_id')->Dropdownlist($companylist,['prompt'=>'Select Company Branch','id'=>'branchid','required'=>'true','class'=>'form-control selectpicker','data-style'=>"btn-default btn-custom",'data-live-search'=>'true'])->label("Company Branch");
		echo '</div>';
		}
		else{ echo   $form->field($model, 'branch_id')->hiddenInput(['value'=>$companybranchid,'id'=>'branchid'])->label(false);}*/ ?>
	
    <div class="col-md-3">
    	<label>Vendor</label>
  <?= $form->field($model, 'vendorid')->dropdownlist($list,['prompt'=>'Select Vendor','id'=>'vendor_idz','required'=>'true','class'=>'selectpicker','data-live-search'=>'true','data-style'=>"btn-default btn-custom", 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getproduct').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#product_idz").html(data);
														     $("#product_idz").selectpicker("refresh");                                                   
                                                        }
                                                    );'])->label(false) ?>
    </div>
	<div class="col-md-3">
			<label>Product</label>
   <?= $form->field($model, 'productid')->dropdownlist([],['id'=>'product_idz','title'=>'Select Product','class'=>'selectpicker','required'=>'true','data-style'=>"btn-default btn-custom",'data-live-search'=>'true','multiple'=>true, 'data-selected-text-format'=>'count > 2',
   'onchange'=>'
                                                    $.get( "'.Url::toRoute('getvendorbranch').'", {vendorid:$("#vendor_idz").val() } )
                                                        .done(function( data ) {
                                                           $("#vendorbranchid").html(data);
														     $("#vendorbranchid").selectpicker("refresh");                                                   
                                                        }
                                                    );'
   
   
   ])->label(false); ?>
    </div>
	  <div class="col-md-3 form-group" style="margin-top: 22px;">
        <?= Html::Button('<i class="fa fa-fw fa-plus"></i> Add Direct Stock', ['class' => '  btn btn-primary waves-effect waves-light addstock']) ?>
    </div>
	 <?php ActiveForm::end(); ?>
 <div id="formdetails"></div>  

</div>       
</div>
</div>
</div>
</div>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script>
	$(document).ready(function(){
		  $("#product_idz").selectpicker("refresh"); 
 $('body').on("click",'.addstock',function(){
 	$form_container=$("#addform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
  if(chkform==true){
 $("#load").fadeIn("slow");
 var form = $("#addform");
 var formData = form.serialize();
 $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        	$("#load").fadeOut("slow");
        	$("#formdetails").html(data);
        	$('[tabindex="1001"]').focus();
        	$("#formdetails").fadeIn("slow");
        	$(".demoz").selectpicker("refresh");
        	
        }
     });
    }

	});
	
	
	
	

	
	
	});
	

	
	
	$('body').on("click",'.save_stock',function(){
		
	$form_container=$("#stock-form1");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
	//$("#load").fadeIn("slow");
	 var form = $("#stock-form1");
	 var formData = form.serialize();
	 $.ajax({
        url: form.attr("action"),
        type: 'post',
        data: formData,
        success: function (data) {
        	$("#load").fadeOut("slow");
        	 noti();
		     $("#formdetails").fadeOut("slow");
        }
       
     });	
		}
		function noti () {
  $.Notification.autoHideNotify('custom', 'top right', 'Stock Added successfully.');
}	
	});
</script>