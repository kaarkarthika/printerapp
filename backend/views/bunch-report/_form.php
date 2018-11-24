<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceBunch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-bunch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bunch_pdflogid')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bunch_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bunch_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TotalAmountPaid')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
