<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="unit-form">
    <?php $form = ActiveForm::begin(['id'=>'unit-form']);?>
   <div class="clearfix"></div>
 <div class="col-md-6">
    <?php echo $form->field($model, 'unitname')->dropDownList($items,['prompt'=>'Select Product Type'])->label("Product Type");?>
</div>
 <div class="col-md-6">
    <?= $form->field($model, 'unitvalue')->textInput(['maxlength' => true])->label("Unit Form") ?>
</div>
<div class="clearfix"></div>
 <div class="col-md-6">
    <?= $form->field($model, 'no_of_unit')->textInput(['maxlength' => true,'onkeypress'=>'return isNumber(event)',]) ?>
</div>
     <div class="col-md-6">
    	  <?php
    	if($model->isNewRecord)
		{
			  $model->is_active = 1;
			 echo $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false);
		}  
		else{
		 echo $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ;
		}
    	?>
    </div>
   <div class="clearfix"></div>
   
  <!--  <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>-->

       <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success unit' : 'btn btn-primary updateunit']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div><br />
<script>
	$('#unit-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".unit").attr('disabled','disabled');
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
	    $.pjax.reload({container:"#unit-grid"});
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
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
        error: function () 
        {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>

