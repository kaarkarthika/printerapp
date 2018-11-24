<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\InBedno */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>

<div class="row in-bedno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bedno')->textInput() ?>

			<?= $form->field($model, 'room_id')->dropdownlist($roomt_no,['prompt'=>'Select Room NO ','data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true],['options' =>[$model->room_id => ['selected' => true]]])->label('Select Room No') ?>
			



    <!-- <?= $form->field($model, 'room_id')->textInput(['maxlength' => true]) ?> -->
    <?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
    <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
		])->checkbox([],false) ?>

    <!-- <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?> -->

  <hr>   
    	
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
		 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    <?php ActiveForm::end(); ?>


</div>
<script>
 $(document).ready(function () {
 	
  	$("#inbedno-room_id").change(function() {
 		var testname=$("input#inbedno-bedno").val();
 		var bedno=$("select#inbedno-room_id").val();
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=in-bedno/uniquecheck&testname=";?>"+testname+"&bedno="+bedno,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	
	          	$("#loadtexts").text(testname+" Already Exists.");
	          	$("#loadtexts").css('color','red');
	    		$("#loadtexts").show(4);
	          	$(".physician").css("pointer-events","none");
	          } else{
	          	$("#loadtexts").hide(4);
	          	$(".physician").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
  });	
  
$('#operationalmodal').removeAttr('tabindex');
 $("#inbedno-room_id").select2({ placeholder: "Select Floor"});
</script>
