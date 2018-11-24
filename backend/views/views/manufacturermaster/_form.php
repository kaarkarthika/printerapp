<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturermaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturermaster-form">

    <?php $form = ActiveForm::begin(['id'=>'manufacturer-form']); ?>
<div class="col-md-4">
    <?= $form->field($model, 'manufacturer_name')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'manufacturer_description')->textInput(['maxlength' => true]) ?>
</div>

  <div class="col-md-2">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     	
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
    

    
  <div class="clearfix"></div>
  
    <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success manufacturer' : 'btn btn-primary updatemanufacturer']) ?>
    <span id="loadmanufacturer" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtext" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>

   

    <?php ActiveForm::end(); ?>

</div>
    <script>
	$('#manufacturer-form').on('beforeSubmit', function(e) {
	$("#loadmanufacturer").show();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#loadmanufacturer").hide(4);
	    if(data=="S")
	    {
		$("#loadtext").text("Successfully Saved.");
		$("#loadtext").css('color','green ');
	    $("#loadtext").show(10);
	    $.pjax.reload({container:"#manufacturer-grid"});
	     setTimeout(function() {
        $('.addmanufacturer').trigger('click');
        }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtext").text("Successfully Updated.");
		$("#loadtext").css('color','green ');
	    $("#loadtext").show(4);
	    $.pjax.reload({container:"#manufacturer-grid"});
		}
		else if(data=="E")
		{
		$("#loadtext").text("Data Already Exists.");
		$("#loadtext").css('color','red ');
	    $("#loadtext").show();
		}
		else
		{
		$("#loadtext").text("Data Not Saved.");
		$("#loadtext").css('color','red ');
		$("#loadtext").show();
						
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
