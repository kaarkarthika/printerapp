<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InRoomno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-roomno-form" style='min-height: 10px;'>

    <?php $form = ActiveForm::begin(['id'=>'roomno_master']); ?>
  <div class="row">
  <div class="col-md-3">
    <?= $form->field($model, 'room_no')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-3">
  
	<?php if($model->isNewRecord){
		
		echo  $form->field($model, 'floorid')->dropDownList($floormaster,['prompt'=>'--Select Floor--','data-live-search'=>'false','class'=>'form-control','data-style'=>'btn-default btn-custom' ])->label('Select Floor');
		}else{ 
			if(!empty($floormaster)){
				?>
			<?= $form->field($model, 'floorid')->dropdownlist($floormaster,['prompt'=>'Select Floor','data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Floor') ?>
			
	<?php	}	}	 ?> 
	</div>

  <div class="col-md-3">

    <?php if($model->isNewRecord){
		
		echo  $form->field($model, 'roomtypeid')->dropDownList($roomtypes,['prompt'=>'--Select Room--','data-live-search'=>'false','class'=>'form-control','data-style'=>'btn-default btn-custom' ])->label('Select Room');
		}else {
			if(!empty($roomtypes)){
			?>
			<?= $form->field($model, 'roomtypeid')->dropdownlist($roomtypes,['prompt'=>'Select Room ','data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Room') ?>
		 <?php } } ?> 
	</div>
<div class="col-md-3">
     	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>

  	</div>
  	<div class="clearfix"></div>
  	
   
    
     <div class="form-group col-md-12">
    	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success physician' : 'btn btn-primary updatephysician']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>
    



    <?php ActiveForm::end(); ?>

</div>
</div>

<script>
	$('#operationalmodal').removeAttr('tabindex');
 $("#inroomno-floorid").select2({ placeholder: "Select Floor"});
 $("#inroomno-roomtypeid").select2({ placeholder: "Select Floor"});
</script>