<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InFloormaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row in-floormaster-form">

    <?php $form = ActiveForm::begin(['id'=>'floor_master']); ?>
	<div class="col-md-4">
    <?= $form->field($model, 'floor_no')->textInput(['maxlength' => true]) ?>
	</div>
<div class="col-md-2">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     	
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>

<div class="clearfix"></div>
<hr>
 <div class="form-group col-md-12">
    	
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
		
		 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
 <script>
	$('#floor_master').on('beforeSubmit', function(e) {
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
	   			$.pjax.reload({container:"#floor-grid"});
	   			  setTimeout(function() {
      		  $('.addphysician').trigger('click');
      	  }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtexts").text("Successfully Updated.");
			$("#loadtexts").css('color','green ');
	  		$("#loadtexts").show(4);
	    	$.pjax.reload({container:"#floor-grid"});
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