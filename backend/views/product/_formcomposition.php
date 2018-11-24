<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Composition */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>
<div class="row composition-form">

    <?php $form = ActiveForm::begin(['id'=>'composition-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,
    ]); ?>
    <?= $form->field($model, 'composition_id')->hiddenInput(['id'=>'compositionid'])->label(false) ?>
	<div class=" col-md-12">
    <?= $form->field($model, 'composition_name')->textInput(['maxlength' => true,'placeholder'=>'Composition Name','id'=>'compositionname']) ?>
    </div>
    <div class=" col-md-4">
    	
    	 <?= $form->field($model, 'agestart')->dropDownList(range(0,100),['prompt' =>'From','class'=>'form-control age'])->label("Age From"); ?>
    	 
  
	</div> <div class=" col-md-4">
    	
    	
    	  <?= $form->field($model, 'age_end')->dropDownList(range(0,100),['prompt' => 'To','class'=>'form-control age'])->label("Age To"); ?>
  
	</div>
	<div class=" col-md-4">
   <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
   <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
	<div class="clearfix"></div>
  <hr>

     <div class="form-group col-md-12">
    
     <?= Html::Button($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right composition' : 'btn btn-primary pull-right updatecomposition','style'=>'margin-left: 0%;']) ?>
	  <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
<div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>


  <script>


$('.composition').on('click', function(e) 
{
	$("#load").show();
   
    var form = $('#composition-form');
    var formData = form.serialize();
    
    $.ajax({
        url: '<?php echo Yii::$app->homeUrl . "?r=product/createproduct";?>',
        type: 'POST',
        data: formData,
        success: function (data) 
        {
	        $("#load").hide(4);
	        var data = $.parseJSON(data);
		    if(data[0]=="Y")
		    {
		    	$('#product-composition_id').children('option:not(:first)').remove();
		   		var datalength=data[1];
		   		var appendhtml='<option value="">--Select Composition--</option>';
		   		for (x in datalength) 
				{
					appendhtml=appendhtml+'<option value='+datalength[x]['composition_id']+'>'+datalength[x]['composition_name']+'</option>';
				}
		   		
		   		$("#product-composition_id").append(appendhtml);
				$("#loadtex").text("Successfully Saved.");
				$("#loadtex").css('color','green ');
			    $("#loadtex").show(4);
			    //$('#operationalmodal').modal('hide');
			}				
			else if(data[0]=="E")
			{
				$("#loadtex").text("Data Already Exists.");
				$("#loadtex").css('color','red ');
			    $("#loadtex").show();
		    }
			else if(data[0]=="W")
			{
				$("#loadtex").text("Age From Must be Less than Age To.");
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
        error: function () 
        {
                alert("Something went wrong");
        }
    });
});
</script>