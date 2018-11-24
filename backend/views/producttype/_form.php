<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="row producttype-form">
     <?php $form = ActiveForm::begin(['id' => 'producttype-form']); ?> 
     <?= $form->field($model, 'product_typeid')->hiddenInput(['maxlength' => true,'id'=>'product_typeid'])->label(false); ?>
    <div class="col-md-6">
    	  <?= $form->field($model, 'product_type')->textInput(['placeholder' =>'Product Type']) ?>
    </div>
   <div class="col-md-6">
  <?php if($model->isNewRecord){$model->is_active = 1;} ?>
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
   </div>
<div class="clearfix"></div>
<hr>
    <div class="form-group col-md-12">
    	 
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right producttype' : 'btn btn-primary pull-right updateproducttype']) ?>
		<?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div> <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
<script>
 

	
	 $("form input:text").first().focus();

	$('#producttype-form').on('beforeSubmit', function(e) {
	$("#load").show();
   
    var form = $(this);
    var formData = form.serialize();
     $(".producttype").attr('disabled','disabled');
    
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
	    $.pjax.reload({container:"#producttype-grid"});
	    <?php if($model->isNewRecord){ ?>
	    setTimeout(function() {
        $('.addproducttype').trigger('click');
        }, 500);
        <?php } ?>
	   
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Product Type Already Exists.");
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