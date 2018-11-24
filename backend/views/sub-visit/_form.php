<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-visit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_visit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consultant_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consultant_doctor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
