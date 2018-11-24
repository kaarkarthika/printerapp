<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\DropdownManagement;
use backend\models\BranchManagement;
use backend\models\ServiceCentre;
use backend\models\AuthUserRole;
use yii\helpers\Url;
$session = Yii::$app->session;
$session['servicecenter_id'];
?>
<div class="card">
<div class="body">
<div class="branch-management-form">

                 <?php $form = ActiveForm::begin(['id' => 'branch-management-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>

   <div class="col-md-6">
  <?= $form->field($model, 'authUserRole')->dropDownList($userrolelist ,['prompt'=>'Select User Role'])->label("User Role"); ?>   
  </div>
   <div class="col-md-6">
   <?= $form->field($model, 'ba_branchid')->dropdownlist($companylist,['prompt'=>'Select Company Branch','id'=>'vendorid']); ?>
</div>
   
    <div class="clearfix"></div>
       <div class="col-md-6">
    <?= $form->field($model, 'ba_name',[
        'template' => '
          <label class="control-label">User Name</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-users"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'User Name',
            'class'=>'form-control',
        ]])
    ?>
   </div>
    <?php if($model->isNewRecord)
    { ?>
 <div class="col-md-6">
    <?= $form->field($model, 'password_hash',[
        'template' => '
          <label class="control-label">Password</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-lock"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Password',
            'class'=>'form-control',
            'type'=>'password',
        ]])
    ?>
    </div>
    <?php } 
	 else
    { ?>
 <div class="col-md-6">
    <?= $form->field($model, 'password_hash',[
        'template' => '
          <label class="control-label">Password</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-lock"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Password',
            'class'=>'form-control',
            'type'=>'password',
            'value'=>'',
        ]])
    ?>
    </div>
    <?php } ?>
    
    
    	<div class="col-md-6">
   	 <?= $form->field($model, 'ba_autoid')->hiddenInput(['maxlength' => true,'id'=>'ba_autoid'])->label(false); ?>
   </div>
    <div class="form-group ">
<div class="col-md-12">
	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
    		 <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success add_branchadmin waves-effect' : 'btn btn-primary add_branchadmin  waves-effect']) ?>
    	 <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    	</div>
    	<div class="clearfix"></div>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>


<script>
	$('#branch-management-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".add_branchadmin").attr('disabled','disabled');
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
	    $.pjax.reload({container:"#branchadmin-grid"});
						
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