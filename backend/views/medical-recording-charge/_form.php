<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalRecordingCharge */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="row">
<div class="col-sm-12">
<div class="panel-body" >
<div class="medical-recording-charge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'hsncode')->dropdownlist($tax_grouping,['prompt'=>'Select HSN Code', 'options' => [$model->hsncode => ['Selected'=>'selected']],'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>

    <!-- <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?> -->

	
    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
	
	 <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true" ,'style'=>'margin-right: 2%;']) ?>
   
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
