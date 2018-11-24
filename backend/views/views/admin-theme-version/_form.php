<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminThemeVersion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-theme-version-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-md-12">
	<div class="col-md-4">
    <?= $form->field($model, 'reconcileversionname')->textInput(['maxlength' => true])->label('Version Name') ?>
</div>
<div class="col-md-4">
    <?= $form->field($model, 'reconcileversion')->textInput(['maxlength' => true]) ->label('Version') ?>
</div>
  <!-- 
    <?= $form->field($model, 'reconcileversionkey')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'timestamp')->textInput() ?>-->
<div class="col-md-4">
    <div class="form-group"><br>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>