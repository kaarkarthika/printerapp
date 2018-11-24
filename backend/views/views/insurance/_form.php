<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="insurance-form">
    <?php $form = ActiveForm::begin(['id'=>'insurance-form']); ?>
<div class="col-md-6">
    <?= $form->field($model, 'insurance_type')->textInput() ?>
</div>
      <div class="col-md-6">
    	  <?php 
    	  if($model->isNewRecord)
		  {
		  	$model->is_active = 1;
echo $form->field($model, 'is_active', ['template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false);
		  }
		  
		  else{
		  	echo $form->field($model, 'is_active',[ 'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false);
		  }
 ?>
    </div>
    <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success unit' : 'btn btn-primary updateunit']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
<script>
	$('#insurance-form').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#insurance-grid"});
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