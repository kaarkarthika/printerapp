<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="taxmaster-form">

    <?php $form = ActiveForm::begin(['id'=>'taxmaster-form']); ?>
    <?= $form->field($model, 'taxid')->hiddenInput(['maxlength' => true,'id'=>'taxid'])->label(false); ?>
  
   <div class="clearfix"></div>
 <div class="col-md-6">
    <?= $form->field($model, 'taxgroup')->textInput(['placeholder' =>'Tax Group','class'=>"form-control "])->label("Tax Group Name"); ?>
</div>
 <div class="col-md-6">
    <?= $form->field($model, 'taxvalue')->textInput(['placeholder' =>'Tax Value','class'=>"form-control "]) ?>
</div>

     <div class="col-md-6">
   <?php $a= ['2016' => '2016-17', '2017' => '2017-18','2018'=>'2018-19'];
    echo $form->field($model, 'financialyear')->dropDownList($a,['prompt'=>'Select Financial Year']);?>
    	 
</div>
  
  
   <div class="col-md-4">
    <?= $form->field($model, 'additionaltax')->textInput(['placeholder' =>'Additional Tax','class'=>"form-control"]) ?>
</div>
<div class="col-md-2">
    	   <?php if($model->isNewRecord){$model->is_active = 1;} ?>
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>

   <!-- <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>-->

    <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success tax' : 'btn btn-primary updatetax']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
 
        
       

<script>
	$('#taxmaster-form').on('beforeSubmit', function(e) {
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
	    $.pjax.reload({container:"#taxmaster-grid"});
	    <?php 
	    if($model->isNewRecord){?>
	     setTimeout(function() {
        $('.addtax').trigger('click');
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
        $('.addtax').trigger('click');
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
