<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\LabCategory;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\LabSubcategory */
/* @var $form yii\widgets\ActiveForm */

//print_r($catgorylist); die;

?>

<div class="lab-subcategory-form">

    <?php $form = ActiveForm::begin(['id'=>'subcat-form']); ?>

    <?= $form->field($model, 'lab_subcategory')->textInput(['maxlength' => true,'required' => true])->label('Subcategory Name')  ?>

    
   <?= $form->field($model, 'category_id')->dropdownlist($catgorylist,['prompt'=>'Select Category', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true,'label'=>'Select Category'])->label('Select Category Name') ?>

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
	$('#subcat-form').on('beforeSubmit', function(e) {
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

