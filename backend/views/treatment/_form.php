<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Treatment */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>
<div class="row">
<div class="treatment-form">



		

<div class=" ">
<div class=" ">

<div class=" " style=" ">
    <?php $form = ActiveForm::begin(['id'=>'treatment']); ?>

	<div class=" ">
	<div class="col-md-5">
    <?= $form->field($model, 'treatment_name')->textInput(['maxlength' => true]) ?>
	</div>
  
   
    
   <div class="col-md-5">
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	</div>
     <div class="clearfix"></div>
     </div>
     <div class=" ">
   <div class="col-md-5">
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
	</div>
	
   <div class="col-md-5">
    
    <?= $form->field($model, 'hsn_code')->dropdownlist($tax_grouping,['prompt'=>'Select HSN Code', 'options' => [$model->hsn_code => ['Selected'=>'selected']],'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>
	</div>
   
   	
   	
	 <div class="col-md-2">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     	
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
    <div class="clearfix"></div>
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
	</div>							
	</div>
	</div>	
		</div>

</div>
 <script>
	$('#treatment').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#treatment-grid"});
	     setTimeout(function() {
        $('.addtreatment').trigger('click');
        }, 500);
		}
		 else if(data=="U")
	    {
		$("#loadtexts").text("Successfully Updated.");
		$("#loadtexts").css('color','green ');
	    $("#loadtexts").show(4);
	    $.pjax.reload({container:"#treatment-grid"});
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
	
	
$('#operationalmodal').removeAttr('tabindex');
$("#treatment-hsn_code").select2({ placeholder: "Select HSN"});
</script>