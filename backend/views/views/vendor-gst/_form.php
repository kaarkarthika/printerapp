<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$form = ActiveForm::begin(['id'=>'vendor-gst-form']); ?>
 <div class="col-md-6">
 <?= $form->field($model, 'vendor_id')->Dropdownlist($vendorlist, ['prompt'=>'--Select Vendor--', 'class'=>' form-control ' ]  )->label("Vendor"); ?>
  </div>
   <div class="col-md-6">
 <?= $form->field($model, 'state')->Dropdownlist($statelist, ['prompt'=>'--Select State--', 'class'=>' form-control ' ]  )->label("State"); ?>
    </div>
    <div class="clearfix"></div>
     <div class="col-md-6">
    	 <?= $form->field($model, 'gst_tax')->textInput(['maxlength' => 15 ]) ?>
    </div>
   
      <div class="col-md-6">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     	
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
    
    <div class="clearfix"></div>
    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-primary']) ?>
         <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
   
    </div>
   <?php ActiveForm::end(); ?>
    <div class="clearfix"></div>
    <script>
	$('#vendor-gst-form').on('beforeSubmit', function(e) {
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
	    $("#loadtex").show(10);
	    $.pjax.reload({container:"#vendor-gst-grid"});
	     setTimeout(function() {
        $('.addvendorgst').trigger('click');
        }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtex").text("Successfully Updated.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    $.pjax.reload({container:"#vendor-gst-grid"});
		}
		else if(data=="A")
		{
		$("#loadtex").text("Vendor GST Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
		}
		else if(data=="V")
		{
		$("#loadtex").text("Vendor GST Number has 15 digits.");
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
