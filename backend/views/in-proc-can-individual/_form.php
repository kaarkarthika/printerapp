<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcCanIndividual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-proc-can-individual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'can_treat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_proc_ind_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'treat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput() ?>

    <?= $form->field($model, 'mrp')->textInput() ?>

    <?= $form->field($model, 'gst_percent')->textInput() ?>

    <?= $form->field($model, 'cgst_percent')->textInput() ?>

    <?= $form->field($model, 'sgst_percent')->textInput() ?>

    <?= $form->field($model, 'gst_value')->textInput() ?>

    <?= $form->field($model, 'cgst_value')->textInput() ?>

    <?= $form->field($model, 'sgst_value')->textInput() ?>

    <?= $form->field($model, 'dis_value')->textInput() ?>

    <?= $form->field($model, 'dis_percent')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
