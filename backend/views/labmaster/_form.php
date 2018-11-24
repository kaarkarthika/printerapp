<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
<div class="col-sm-12">
<div class=" ">
<div class=" ">
<div class="lab-category-form">

</div>
<div class="panel-body" >
    <?php $form = ActiveForm::begin(['id'=>'labmaster-form']); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true,'required' => true]) ?>

    <!-- <?= $form->field($model, 'isactive')->checkbox(['default','checked'=>true, 'value' =>true,'label'=>'Active']) ?> -->
    <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>

   <hr>
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
	
	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true" ,'style'=>'margin-right: 2%;']) ?>
   
     <!-- <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span> -->
     <span id="loadtex" style="display: none; "></span>
     

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>
<script>
	$('#labmaster-form').on('beforeSubmit', function(e) {
	$("#load").show();
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
