<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\LabUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-unit-form">

    <?php $form = ActiveForm::begin(['id'=>'unit-form']); ?>

    <?= $form->field($model, 'unit_name')->textInput(['maxlength' => true,'required' => true]) ?>

    <?= $form->field($model, 'unit_value')->textInput(['maxlength' => true,'required' => true]) ?>

    <!-- <?= $form->field($model, 'unit_type')->textInput(['maxlength' => true,'required' => true]) ?>

    <?= $form->field($model, 'referencesymbol')->textInput(['maxlength' => true,'required' => true]) ?>

    <?= $form->field($model, 'isactive')->dropDownList([ 'A' => 'A', 'I' => 'I', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_date')->textInput() ?> -->

    <!-- <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> -->
     <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>

    <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success savecategory' : 'btn btn-primary updatecategory']) ?>
   
      <!-- <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span> -->
     <span id="loadtex" style="display: none; "></span>
     
    <?php ActiveForm::end(); ?>

</div>
<script>
	$('#unit-form').on('beforeSubmit', function(e) {
	//$("#load").show();
    $(".savecategory").attr('disabled','disabled');
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
	  
        },
      
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>