<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\ModuleAction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-action-form">

    <?php $form = ActiveForm::begin(['id'=>'modeactionform', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
     <?= $form->field($model, 'actionid')->hiddenInput(['maxlength' => true,'id'=>'actionid'])->label(false); ?>

    <div class="col-md-4">
    <?= $form->field($model, 'action_name')->textInput(['maxlength' => true ,'placeholder'=>'Action Name','id'=>'actionname',]) ?>
</div>
    <div class=" col-md-2">
    <?= $form->field($model, 'action_key')->textInput(['maxlength' => true,'placeholder'=>'Action Key','id'=>'actionkey',]) ?>
</div>

   
    
  
    <div class="col-md-4">
    <?= $form->field($model, 'action_value')->textInput(['maxlength' => true,'placeholder'=>'Action Value','id'=>'actionvalue',]) ?>
</div>
    <div class="col-md-2">
   <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
   <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
</div>
  <div class="clearfix"></div>

  <div class="form-group" align="">
  	<div class="col-md-12">
  		<?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success modact' : 'btn btn-primary modact','style'=>'margin-left: 0%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
  	</div>
    	 
    </div>
 <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>


<script>
	$('#modeactionform').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".modact").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
    
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    if(data=="Y")
	    {
		$("#loadtex").text("Successfully Saved.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    $.pjax.reload({container:"#moduleaction-grid"});
	     <?php if($model->isNewRecord){ ?>
	   setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
	   
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	    <?php if($model->isNewRecord){ ?>
	   setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		<?php if($model->isNewRecord){ ?>
	   setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
						
		} 
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>
