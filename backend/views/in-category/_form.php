<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row in-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true,'required' => true]) ?>

     <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
    <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
		])->checkbox([],false) ?>

    <!-- <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?> -->
  <hr>
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
   
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span> 
     <span id="loadtext" style="display: none; "></span>
   

    <?php ActiveForm::end(); ?>

</div>
<script>
$(document).ready(function () {
 	
  	$("#incategory-category_name").change(function() {
 		var testname=$("#incategory-category_name").val();
 		
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=in-category/uniquecheck&testname=";?>"+testname,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	
	          	$("#loadtext").text(testname+" Already Exists.");
	          	$("#loadtext").css('color','red');
	    		$("#loadtext").show(4);
	          	$(".savecategory").css("pointer-events","none");
	          	$(".updatecategory").css("pointer-events","none");
	          	
	          } else{
	          	$("#loadtext").hide(4);
	          	$(".savecategory").css("pointer-events","auto");
	          	$(".updatecategory").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
  });	
</script>