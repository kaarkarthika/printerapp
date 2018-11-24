<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Composition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="composition-form">

    <?php $form = ActiveForm::begin(['id'=>'composition-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,
    ]); ?>
    <?= $form->field($model, 'composition_id')->hiddenInput(['id'=>'compositionid'])->label(false) ?>
	<div class=" col-md-12">
    <?= $form->field($model, 'composition_name')->textInput(['maxlength' => true,'placeholder'=>'Composition Name','id'=>'compositionname']) ?>
    </div>
    <div class=" col-md-4">
    	
    	 <?= $form->field($model, 'agestart')->dropDownList(range(0,100),['prompt' =>'From','class'=>'form-control age'])->label("Age From"); ?>
    	 
  
	</div> <div class=" col-md-4">
    	
    	
    	  <?= $form->field($model, 'age_end')->dropDownList(range(0,100),['prompt' => 'To','class'=>'form-control age'])->label("Age To"); ?>
  
	</div>
	<div class=" col-md-4">
   <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
   <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
	<div class="clearfix"></div>
  

     <div class="form-group col-md-12">
     <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
     <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success composition' : 'btn btn-primary updatecomposition','style'=>'margin-left: 0%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
<div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>


<script>


	$('#composition-form').on('beforeSubmit', function(e) {
	$("#load").show();
   
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
	    $.pjax.reload({container:"#composition-grid"});
	     <?php if($model->isNewRecord){ ?>
	    setTimeout(function() {
        $('.addcomposition').trigger('click');
        }, 500);
        <?php } ?>
	   
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	   
		}
		else if(data=="W")
		{
		$("#loadtex").text("Age From Must be Less than Age To.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	   
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		
						
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