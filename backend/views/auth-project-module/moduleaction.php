<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\ModuleAction;
/* @var $this yii\web\View */
/* @var $model backend\models\AuthProjectModule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-project-module-form">

    <?php $form = ActiveForm::begin(['id' => 'moduleactionform']); ?>
 <?= $form->field($model, 'p_autoid')->hiddenInput(['maxlength' => true,'id'=>'moduleid'])->label(false); ?>
<div class="col-md-12">
	
		<?php
		$in_module = json_decode($model->action);

$checkedservice = array();
if(isset($in_module)){

	
foreach($in_module as $ser) {
	$checkedservice[$ser] = $ser;
}
}
$model->action = $checkedservice;
		
		
    //echo $form->field($model, 'action')->checkboxList(ArrayHelper::map(ModuleAction::find()->all(), 'actionid', 'action_name'),['id'=>'modzaction',])->label(false); ?>
	
	 <?= $form->field($model, 'action')->checkboxList(ArrayHelper::map(ModuleAction::find()->all(), 'actionid', 'action_name'),['id'=>'modzaction',
    'item' => function($index, $label, $name, $checked, $value) {
    	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
        return "<div class='checkbox checkbox-danger '><div style='margin-top:10px;' class='col-md-3'><input type='checkbox'  name=$name value=$value $class_checked><label>$label</label></div></div>";
    }
])->label(false) ;?></div>
<div class="clearfix" style="padding-top:30px;"></div>
	
	<br>
	<hr>

    <div class="form-group col-md-12">

	
	
</div>
    		 
		<div class="col-sm-2 pull-right">	 
			 <?= Html::Button($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success action' : 'btn btn-primary updateaction  waves-effect']) ?>
			</div> 
			
			<div class="col-sm-2 pull-right">
	        <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
    </div>
			 
    	 <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    	
    	
       
    </div>

<div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
