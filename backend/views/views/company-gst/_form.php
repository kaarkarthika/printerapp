<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="company-gst-form">
    <?php $form = ActiveForm::begin(['id'=>'gstform', 'enableClientValidation' => true, 'enableAjaxValidation' => false]); ?>
     <?= $form->field($model, 'gstid')->hiddenInput(['maxlength' => true,'id'=>'gstid'])->label(false); ?>
   
    <div class=" col-md-6">
    		<?php 
     	if($model->isNewRecord){
     	$model->company_id = 7;
     	}?> 
    <?= $form->field($model, 'company_id')->dropDownList($companylist,['prompt'=>'Select Company','id'=>'companyname',])->label('Company Name') ?>
    </div>
    
    <div class=" col-md-6">
    <?= $form->field($model, 'stateid')->dropDownList($statelist,['prompt' => 'Select State','id'=>'state',])->label('State') ?>
    </div>
    <div class="clearfix"></div>
    
	<div class="col-md-6">
    <?= $form->field($model, 'gst')->textInput(['maxlength' => 15,'id'=>'gst' ]); ?>
    </div> 
     <div class="col-md-6">
     	<?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
   <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
    <div class="clearfix"></div>
   

    <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success gst' : 'btn btn-primary gst','style'=>'margin-left: 0%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
<div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
<script>
	$('#gstform').on('beforeSubmit', function(e) {
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
	    $("#loadtex").show(4);
	    $.pjax.reload({container:"#gst-grid"});
	    <?php 
	    if($model->isNewRecord){?>
	     setTimeout(function() {
        $('.addgst').trigger('click');
        }, 500);
        <?php } ?>
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	     $(".gst").attr('enabled','enabled');
	      <?php 
	    if($model->isNewRecord){?>
	     setTimeout(function() {
        $('.addgst').trigger('click');
        }, 500);
        <?php } ?>
		}
		
		
		else if(data=="V")
		{
		$("#loadtex").text("GST Number has 15 digits.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	     $(".gst").attr('enabled','enabled');
	
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		  <?php 
	    if($model->isNewRecord){?>
	     setTimeout(function() {
        $('.addgst').trigger('click');
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