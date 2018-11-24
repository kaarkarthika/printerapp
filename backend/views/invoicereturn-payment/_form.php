<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicereturnPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoicereturn-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branchid')->textInput() ?>

    <?= $form->field($model, 'returnid')->textInput() ?>

    <?= $form->field($model, 'patientname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_mobilenumber')->textInput() ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentmethod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoicenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentamount')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'updated_timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
