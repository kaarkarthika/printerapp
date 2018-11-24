<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="auth-project-module-form row">

    <?php $form = ActiveForm::begin(['id' => 'authmoduleform', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
	<div class="col-md-6">
    <?= $form->field($model, 'moduleName')->textInput(['placeholder' =>'Module Name']) ?>
   </div>
	<div class="col-md-6">
    <?= $form->field($model, 'moduleCode')->textInput(['placeholder' =>'Module Code']) ?>
   </div>
   <div class="clearfix"></div>

	<div class="col-md-6">
    <?= $form->field($model, 'moduleMultiple')->dropDownList([ 'One' => 'One', 'More' => 'More','Separator'=>'Separator' ], ['prompt' => '--Select Module Option--']) ?>
	</div>
	<div class="col-md-6">
    <?= $form->field($model, 'moduelRoot')->textInput(['placeholder' =>'Module Root','onkeypress'=>'return isNumber(event)',]) ?>
	</div>
   <div class="clearfix"></div>
	<div class="col-md-6">
    <?= $form->field($model, 'userAction')->textInput(['placeholder' =>'User Action']) ?>
	</div>
	<div class="col-md-6">
    <?= $form->field($model, 'FAIcon')->textInput(['placeholder' =>'Fa Icon']) ?>
	</div>
   <div class="clearfix"></div>
	<div class="col-md-6">
    <?= $form->field($model, 'sortOrder')->textInput(['placeholder' =>'Sort Order','onkeypress'=>'return isNumber(event)']) ?>
   
</div>
<div class="col-md-6">
   <?= $form->field($model, 'p_autoid')->hiddenInput(['maxlength' => true,'id'=>'p_autoid'])->label(false); ?>
   </div>
       <div class="col-md-6">
    	  <?php if($model->isNewRecord){$model->is_active = 1;}?>
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:15px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
    
   <div class="clearfix"></div>
    <div class="form-group ">
<div class="col-md-12">
		 
			<hr> 
	 	 
			 <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success add_module pull-right waves-effect' : 'btn btn-primary pull-right add_module  waves-effect']) ?>
			 
	<?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez','data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
  
			 
    	 <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    	</div>
    	
		
		<div class="clearfix"></div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script>
	$('#authmoduleform').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".add_module").attr('disabled','disabled');
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
	    $.pjax.reload({container:"#projectmodule-grid"});
	    <?php 
	    if($model->isNewRecord){?>
	    setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
	    
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	    <?php 
	    if($model->isNewRecord){?>
	    setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		<?php 
	    if($model->isNewRecord){?>
	    setTimeout(function() {
        $('.addmodule').trigger('click');
        }, 500);
        <?php } ?>
						
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