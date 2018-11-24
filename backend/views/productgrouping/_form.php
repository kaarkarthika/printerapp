<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\BranchAdmin;

?>
<style>
	#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}input.error{background:#fbe3e4;border:1px solid #fbc2c4;color:#8a1f11}
</style>
<div class="container" style="height:500px;">
	<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...
	</div>
	<div class="row" >
		<div class="col-sm-12">
			<div class="panel panel-border panel-custom">
				<div class="panel-heading">
				</div>
				<div class="panel-body">
		<?php $form=ActiveForm::begin(['id'=>'productgrouping-form','action'=>['addproductgroup'],'enableClientValidation'=>true,'enableAjaxValidation'=>false]);?>
		<div class=" col-md-3">
						<?= $form->field($model, 'vendorid')->Dropdownlist($vendorlist,['title'=>'Select Vendor','size'=>'auto',
						'id'=>'vendorids','data-live-search'=>'true','required'=>true,
    'class'=>'selectpicker form-control ',
    'onchange'=>'   $.get( "'.Url::toRoute('getproduct').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
                                                           $("#productids").html(data);
														     $("#productids").selectpicker("refresh");                                                   
                                                        }
                                                    );'])->label(false)
						?>
					</div>
					<div class=" col-md-3">
						<?= $form->field($model, 'productid')->Dropdownlist([],['title'=>'Select Product','data-live-search'=>'true','required'=>'true','multiple'=>'multiple','size'=>'auto','class'=>'form-control selectpicker' ,'data-style'=>'btn-default','id'=>'productids'])->label(false)
						?>
					</div>
					<div class="col-md-3">

						<?= Html::Button($model->isNewRecord ? '<i class="fa fa-fw fa-plus"></i> Add' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-primary productgrouping' : 'btn btn-primary updateproductgrouping','style'=>'margin-left: 0%;'])
						?>
					</div>
					<div class="clearfix"></div>

					<?php ActiveForm::end();
					?>
					<div id="formdetails" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
 $("#product_idz").selectpicker("refresh"); 
$('body').on("click",'.productgrouping',function(){
$form_container=$("#productgrouping-form");
$form_container.validate().settings.ignore = ":disabled,:hidden";
var chkform=$form_container.valid();
if(chkform==true){
$("#load").fadeIn("slow");
var form = $("#productgrouping-form");
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
$('body').on("click",'.save_productgroupform',function(){
$form_container=$("#productgroup-form1");
$form_container.validate().settings.ignore = ":disabled,:hidden";
var chkform=$form_container.valid();
if(chkform==true){
$("#load").fadeIn("slow");
var form = $("#productgroup-form1");
var formData = form.serialize();
$.ajax({
url: form.attr("action"),
type: 'post',
data: formData,
success: function (data) {
$("#load").fadeOut("slow");
noti();
$("#formdetails").fadeOut("slow");
window.location.href= '<?php echo Yii::$app -> homeUrl; ?>?r=productgrouping/create';
	}
	});
	}
	function noti () { $.Notification.autoHideNotify('custom', 'top right', 'Product Group Added successfully.');}
	});
</script>