<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthUserRole */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
<div class="auth-user-role-form ">

     <?php $form = ActiveForm::begin(['id' => 'auth-user-role-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
    <div class="col-md-6">
    	 <?= $form->field($model, 'rolename')->textInput(['placeholder' =>'Role Name']) ?>
    </div>
     <div class="col-md-6">
    	 <?= $form->field($model, 'rolecode')->textInput(['placeholder' =>'Role Code']) ?>
    </div>
   
    
    
    
    <div class="clearfix"></div>
    <div class="col-md-6">
   	 <?= $form->field($model, 'ur_autoid')->hiddenInput(['maxlength' => true,'id'=>'ur_autoid'])->label(false); ?>
   </div>

     <div class="clearfix"></div>
        <div class="form-group ">
<div class="col-md-12">
	        <hr>
			 
			  
			 <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right add_role waves-effect' : 'btn btn-primary pull-right add_role  waves-effect']) ?>
    	   
			 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    		


		<span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    	</div>
    	<div class="clearfix"></div>
       
    </div>


    <?php ActiveForm::end(); ?>

</div>
</div>


<script>
	$('#auth-user-role-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".add_role").attr('disabled','disabled');
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
	    $.pjax.reload({container:"#userrole-grid"});
	     <?php 
	    if($model->isNewRecord){?>
	    setTimeout(function() {
        $('.addrole').trigger('click');
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
        $('.addrole').trigger('click');
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
        $('.addrole').trigger('click');
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