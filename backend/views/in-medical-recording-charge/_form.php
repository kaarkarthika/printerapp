<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InMedicalRecordingCharge */
/* @var $form yii\widgets\ActiveForm */
?>

<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>


<div class="row in-medical-recording-charge-form">

       <?php $form = ActiveForm::begin(['id'=>'medical-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

 <?=$form->field($model, 'hsncode')->dropDownList($tax_grouping,['prompt'=>'--Select HSN--','class'=>'form-control'],['options' =>[$model->hsncode => ['selected' => true]]]) ?>

   <div class="clearfix"></div>
   <hr>

    <div class="form-group">
    	
         <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
		 
		  <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

	$('#operationalmodal').removeAttr('tabindex');

	$('#medical-form').on('beforeSubmit', function(e) {
	$("#loadphysician").show();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        
        $("#loadphysician").hide(4);
	    if(data=="S")
	    {
		$("#loadtexts").text("Successfully Saved.");
		$("#loadtexts").css('color','green ');
	    $("#loadtexts").show(10);
	    $.pjax.reload({container:"#medical-form"});
	     setTimeout(function() {
        $('.updatedata').trigger('click');
        }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtexts").text("Successfully Updated.");
		$("#loadtexts").css('color','green ');
	    $("#loadtexts").show(4);
	    $.pjax.reload({container:"#medical-form"});
	    $('.updatedata').trigger('click');
		}
		else if(data=="E")
		{
		$("#loadtexts").text("Data Already Exists.");
		$("#loadtexts").css('color','red ');
	    $("#loadtexts").show();
		}
		else
		{
		$("#loadtexts").text("Data Not Saved.");
		$("#loadtexts").css('color','red ');
		$("#loadtexts").show();
						
		} 
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
	
    e.preventDefault();
});





	$("#inmedicalrecordingcharge-hsncode").select2({ placeholder: "Select a Name"}); 
	
</script>
