<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\models\TansiServiceCentreAdmin;

/* @var $this yii\web\View */
/* @var $model backend\models\Branchaddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branchaddress-form">

<div class="box box-primary cgridoverlap">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-file"></i>Create Branchaddress</h3>
        </div>

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-12">
		 <div class="col-md-6">
   
    
    
      <?php
   				 $d=TansiServiceCentreAdmin::find()->all();
    			$a= ArrayHelper::map($d ,'servicecenter_id','username'); ?>
     			 <?= $form->field($model, 'servicecenter_id')->dropDownList($a,['prompt'=>'Select Service Center...','id'=>'vehicle_model'])?>
  
  		  
    
	</div>
	 <div class="col-md-6">
    <?= $form->field($model, 'branchname')->textInput(['maxlength' => true]) ?>
	</div>
</div>
<div class="col-md-12">
		 <div class="col-md-6">
    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>
</div>
 <div class="col-md-6">
    <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>
</div>
</div>
<div class="col-md-12">
		 <div class="col-md-6">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
</div>
</div>
<div class="col-md-12">
		 <div class="col-md-6">
    <?= $form->field($model, 'pin')->textInput(['maxlength' => 6]) ?>
</div>

 <div class="col-md-6">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
</div>
</div>
<div class="col-md-12">
		 <div class="col-md-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</div>

 <div class="col-md-6">
    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
</div>
</div>
<div class="col-md-12">
    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-life-ring"></i>Save' : '<i class="fa fa-fw fa-wrench "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
