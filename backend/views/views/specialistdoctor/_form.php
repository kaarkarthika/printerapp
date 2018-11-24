<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Specialistdoctor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specialistdoctor-form">
	
	 <?php $form = ActiveForm::begin(['id'=>'special-form']); ?>

    <div class="col-md-6">
     <?= $form->field($model, 'specialist')->textInput(['maxlength' => true]) ?>
	</div>
	
	 <div class="col-md-6">
     <?= $form->field($model, 'consult_amount')->textInput(['maxlength' => true]) ?>
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
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez btn-xm', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit btn-xm"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success special btn-xm' : 'btn btn-primary updatespecial']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>

<div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>

 <script>
	$('#special-form').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#special-grid"});
	     setTimeout(function() {
        $('.addspecial').trigger('click');
       
        
        }, 500);
         $('#specialistdoctor-specialist').focus();
		}
		 else if(data=="U")
	    {
		$("#loadtexts").text("Successfully Updated.");
		$("#loadtexts").css('color','green ');
	    $("#loadtexts").show(4);
	    $.pjax.reload({container:"#special-grid"});
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
	
</script>

