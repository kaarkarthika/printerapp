<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'companyform', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>



 
 <div class="col-md-6">
 <?= $form->field($model, 'company_code')->textInput(['maxlength' => true,'id'=>'companycode','placeholder'=>'Company Code'])->label('Company Code') ?>
 </div>
 <div class="col-md-6">  
 <?= $form->field($model, 'company_name')->textInput(['maxlength' => true,'id'=>'companyname','placeholder'=>'Company Name'])->label('Company Name') ?>
 
 
 </div>
<div class="clearfix"></div>
 <div class="col-md-6">
 <?= $form->field($model, 'company_type')->textInput(['maxlength' => true,'id'=>'companytype','placeholder'=>'Company Type'])->label('Company Type') ?>
 </div>
 <div class="col-md-6">  
 <?= $form->field($model, 'cin')->textInput(['maxlength' => true,'id'=>'cin','placeholder'=>'CIN'])->label('CIN') ?>
 </div>
<div class="clearfix"></div>
 <div class=" col-md-6">
 <?= $form->field($model, 'pan')->textInput(['maxlength' => true,'id'=>'pan','placeholder'=>'PAN'])->label('PAN') ?>
 </div>
 <div class="col-md-6"> 
 <?= $form->field($model, 'dln1')->textInput(['maxlength' => true,'id'=>'dln1','placeholder'=>'DLN1'])->label('DLN1') ?>
 </div>
<div class="clearfix"></div>
 <div class=" col-md-6">
 <?= $form->field($model, 'dln2')->textInput(['maxlength' => true,'id'=>'dln2','placeholder'=>'DLN2'])->label('DLN2') ?>
 </div>
 <div class=" col-md-6">
 <?= $form->field($model, 'dln3')->textInput(['maxlength' => true,'id'=>'dln3','placeholder'=>'DLN3'])->label('DLN3') ?>
 </div>
 <div class="clearfix"></div>
 <div class="col-md-6">
 	<?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
 </div>
 <div class="col-md-6">
 	<?= $form->field($model, 'company_id')->hiddenInput(['maxlength' => true,'id'=>'companyid'])->label(false); ?>
 </div>
 
 <div class="clearfix"></div>
 
     <div class="form-group col-md-12 ">
    	
    
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-default pull-right waves-effect waves-light' : 'btn btn-primary pull-right waves-effect waves-light','style'=>'margin-left: 0%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    	
    	 
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
<script>
	$('#companyform').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#company-grid"});
						
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
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>
