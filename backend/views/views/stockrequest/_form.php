<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use backend\models\VendorBranch;
/* @var $this yii\web\View */
/* @var $model backend\models\Stockrequest */
/* @var $form yii\widgets\ActiveForm */
//print_r($vendorbranch);die;

?>
<script src="<?php echo Url::base(); ?>/plugins/multiselect/jquery.sumoselect.js"></script>
<link href="<?php echo Url::base(); ?>/plugins/multiselect/sumoselect.css" rel="stylesheet" />
<style type="text/css">
  .SumoSelect {
    width: 100%;
}

</style>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
	#load{
		display: none;
position: fixed;
left: 128px;
top: 27px;
width: 100%;
height: 100%;
z-index: 9999;
/*opacity: 0.6;*/

margin-top: 20%; 

	}
	

input.error{
		background: rgb(251, 227, 228);
border: 1px solid #fbc2c4;
color: #8a1f11;

	}
	
	.bootstrap-select.btn-group .dropdown-menu li {
    width: 245px;
}
	
</style>

<div class="container" style="height:800px;">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
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
        'action' => ['add'],
        'method' => 'post',
    ]); 
   		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			echo' <div class=" col-md-3">	';
		echo $form->field($model, 'branch_id')->Dropdownlist($companylist,['prompt'=>'Select Branch','required'=>'true','data-live-search'=>'true','class'=>'selectpicker form-control ','data-style'=>"btn-default btn-custom",])->label("Company Branch");
		echo '</div>';
		}
		else{
			
			 echo   $form->field($model, 'branch_id')->hiddenInput(['value'=>$companybranchid])->label(false);
		} ?>
    <div class="col-md-3">
    	<label>Vendor</label>
   
     	<?= $form->field($model, 'vendorid')->dropdownlist($list,['prompt'=>'Select Vendor','id'=>'vendor_idz','required'=>'true','data-live-search'=>'true','class'=>'selectpicker form-control ','data-style'=>"btn-default btn-custom",
     	 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getproduct').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	var obj = JSON.parse(data);
                                                           $("#product_idz").html(obj[0]);
														   $("#product_idz").selectpicker("refresh"); 
														   
														    $("#vendor_branch").html(obj[1]);
														   $("#vendor_branch").selectpicker("refresh");                                                  
                                                        }
                                                    );'])->label(false) ?>
    </div>
    
    <div class="col-md-3">
    	<label>Vendor Branch Name</label>
   
     	<?= $form->field($vendorbranch, 'branchname')->dropdownlist([],['id'=>'vendor_branch','title'=>'Select Vendor Branch','required'=>'true','data-live-search'=>'true','class'=>'selectpicker form-control ','data-style'=>"btn-default btn-custom",'multiple'=>true, 
   
   
   
   ])->label(false); ?>
    </div>
    
    
	<div class="col-md-3">
			<label>Product</label>
			
	
			
   <?= $form->field($model, 'productid')->dropdownlist([],['id'=>'product_idz','title'=>'Select Product','data-live-search'=>'true','required'=>'true',
   'class'=>'selectpicker form-control','data-style'=>"btn-default btn-custom",'multiple'=>true,  'data-selected-text-format'=>'count > 2'
   
   
   
   ])->label(false); ?>
    </div>

   <div class="clearfix"></div>
    
	  <div class="col-md-3 form-group" style="margin-top: 26px;">
        <?= Html::Button('ADD Stock Request', ['class' => 'btn btn-default waves-effect waves-light dmc',]) ?>
    
    </div>
	 <?php ActiveForm::end(); ?>
	

 <div id="formdetails" >

</div>  
</div>  
</div>
</div>
</div>
</div>  
<script>
	
	$(document).ready(function(){
		  $("#product_idz").selectpicker("refresh"); 
 $('body').on("click",'.dmc',function(){
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
        	$("#formdetails").fadeIn("slow");
        	$(".demoz").selectpicker("refresh");
        }
     });
    }
	});
	});
	
	
	$('body').on("click",'.save_form',function(){
		
	$form_container=$("#stockrequest-form1");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
	$("#load").fadeIn("slow");
	 var form = $("#stockrequest-form1");
	 var formData = form.serialize();
	 $.ajax({
        url: form.attr("action"),
        type: 'post',
        data: formData,
        success: function (data) {
        	
        	$("#load").fadeOut("slow");
        	 $.Notification.autoHideNotify('custom', 'top right', 'Your request has been sent successfully.');
		     $("#formdetails").fadeOut("slow");
		      var url="<?php echo Url::toRoute('stockrequest/index');?>";
		     location.reload(url);
		    
        }
       
     });	
		}
		
	});
</script>
