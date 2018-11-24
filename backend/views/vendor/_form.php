<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

    <?php $form = ActiveForm::begin(['id'=>'vendor-form']); ?>
  <div class="row">
    <div class="col-md-4">
    	 <?= $form->field($model, 'vendorname')->textInput(['placeholder' =>'Vendor Name']) ?>
    </div>

    <div class="col-md-4">
    	
    	  <?= $form->field($model, 'vendorcode')->textInput(['placeholder' =>'Vendor Code']) ?>
    </div>
 
  <div class="col-md-2">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     	
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?> 
    </div>
  
 
  <div class="col-md-2">
     	<?php 
     	if($model->isNewRecord){$model->default_vendor = 1;	}?> 
     	
     
 <?= $form->field($model, 'default_vendor', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Default</label></div>{error}",
])->checkbox([],false) ?> 
    </div>
  <div class="clearfix"></div>
  <hr>
    <div class="form-group col-md-12">
    	 
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success vendor pull-right' : 'btn btn-primary updatevendor pull-right']) ?>
		<?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
    </div>
  <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
    <script>
	$('#vendor-form').on('beforeSubmit', function(e) {
	$("#load").show();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    if(data=="S")
	    {
		$("#loadtex").text("Successfully Saved.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(10);
	    $.pjax.reload({container:"#vendor-grid"});
	     setTimeout(function() {
        $('.addvendor').trigger('click');
        }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtex").text("Successfully Updated.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    $.pjax.reload({container:"#vendor-grid"});
		}
		else if(data=="VN")
		{
		$("#loadtex").text("Vendor Name Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
		}
		else if(data=="VC")
		{
		$("#loadtex").text("Vendor Code Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
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
