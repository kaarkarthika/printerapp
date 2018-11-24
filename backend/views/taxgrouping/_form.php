<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxgrouping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxgrouping-form row">

    <?php $form = ActiveForm::begin(['id'=>'taxgrouping-form']); ?>
    
    	 
<?= $form->field($model, 'taxgroupid')->hiddenInput(['maxlength' => true,'id'=>'taxgroupid'])->label(false); ?>
  
   <div class="clearfix"></div>
 <div class="col-md-5">
 	<?= $form->field($model, 'hsncode')->textInput(['maxlength' => true,'class'=>'form-control number'])->label("HSN Code"); ?>
 </div>
 <div class="col-md-5">
 	 <?= $form->field($model, 'groupid')->dropdownlist($taxgrouplist,['prompt' =>'Select taxgroup']) ?>
 	 
 	   
 </div>

<div class="clearfix"></div>
 
    
	<div class="form-group col-md-5" >
	<?php if($model->isNewRecord){ ?>
		<?= $form->field($model, 'groupname')->textInput(['maxlength' => true,'class'=>'form-control'])->label("Group Name"); ?>
	<?php } else{ ?>
		<?= $form->field($model, 'groupname')->textInput(['readonly' => true,'class'=>'form-control'])->label("Group Name"); ?>
	<?php } ?>	
	</div>
	<div class="form-group col-md-5" >
	<?php if($model->isNewRecord){ ?>
	<?= $form->field($model, 'effect_date')->textInput(['maxlength' => true,'class'=>'form-control date'])->label("Effect Date"); ?>
	<?php } else{ ?>
	<?= $form->field($model, 'effect_date')->textInput(['maxlength' => true,'class'=>'form-control date','value'=>date('d-m-Y',strtotime($model->effect_date))])->label("Effect Date"); ?>
	
	<?php } ?>
	</div>
	   <div class="col-md-2">
   <?php if($model->isNewRecord){$model->is_active = 1;} ?>
   		
   		 
   	
    	
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>



    </div>
	
	<div class="clearfix" ></div>
  <!--  <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>-->

       <div class="form-group col-md-12">
	   <hr>
	     <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right taxgroup' : 'btn btn-primary pull-right updatetaxgroup']) ?>
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
        
   <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
 <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
 
<script>




	$('#taxgrouping-form').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#taxgrp-grid"});
	     <?php if($model->isNewRecord){ ?>
	    setTimeout(function() {
        $('.addtaxgroup').trigger('click');
        }, 500);
        <?php } ?>
	   
						
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
	
	
	$("body").on('keypress', '.number', function (e) 
	{
      //if the letter is not digit then display error and don't type anything
      if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
      {
        return false;
      }
	});
</script>
 <script type="text/javascript">
            $(function () {
                $('#taxgrouping-effect_date').datetimepicker({
                	
                	 format: 'DD-MM-YYYY'
                	
                });
            });
        </script>