<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InRoomtypes */
/* @var $form yii\widgets\ActiveForm */

?>
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>
<div class="in-roomtypes-form">

    <?php $form = ActiveForm::begin(['id'=>"roomtype"]); ?>
    <div class="row">
<div class="col-md-6">
	
    <?= $form->field($model, 'room_types')->textInput(['maxlength' => true,'required' => true]) ?>
</div>
<div class="col-md-6">
    <!-- <?= $form->field($model, 'hsn_code')->textInput(['maxlength' => true]) ?> -->
    
    	<?= $form->field($model, 'hsn_code')->dropdownlist($tax_grouping,['options' => [$model->hsn_code => ['Selected'=>'selected']],'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'price')->textInput(['required' => true]) ?>
    </div>
<div class="col-md-6">
    <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
    <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
		])->checkbox([],false) ?>
</div>
<!-- <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'userrole')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?> -->

<div class="clearfix"></div>
<hr>
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
	<?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
   
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span> 
     <span id="loadtext" style="display: none; "></span>
   
</div>
    <?php ActiveForm::end(); ?>

</div>
<script>
$('#roomtype').on('beforeSubmit', function(e) {
	$("#load").show();
   
    var form = $(this);
    var formData = form.serialize();
    
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    	$("#loadtex").text("Successfully Saved.");
			$("#loadtex").css('color','green ');
	  		$("#loadtex").show(4);
	  		 $(".savecategory").attr('disabled','disabled');
	    },
    });
}).on('submit', function(e){
    e.preventDefault();
});

 $(document).ready(function () {
 	
  	$("#inroomtypes-room_types").change(function() {
 		var testname=$("input#inroomtypes-room_types").val();
 		
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=in-roomtypes/uniquecheck&testname=";?>"+testname,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	
	          	$("#loadtext").text(testname+" Already Exists.");
	          	$("#loadtext").css('color','red');
	    		$("#loadtext").show(4);
	          	$(".savecategory").css("pointer-events","none");
	          } else{
	          	$("#loadtext").hide(4);
	          	$(".savecategory").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
  });	

$('#operationalmodal').removeAttr('tabindex');
$("#inroomtypes-hsn_code").select2({ placeholder: "Select HSN"});
	
</script>