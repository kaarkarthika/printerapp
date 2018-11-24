<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentCancel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-payment-cancel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'can_lab_prime_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_status')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'lab_testgroup')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_testing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_common_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_test_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'gst_percentage')->textInput() ?>

    <?= $form->field($model, 'cgst_percentage')->textInput() ?>

    <?= $form->field($model, 'sgst_percentage')->textInput() ?>

    <?= $form->field($model, 'gst_amount')->textInput() ?>

    <?= $form->field($model, 'cgst_amount')->textInput() ?>

    <?= $form->field($model, 'sgst_amount')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'hsn_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_percent')->textInput() ?>

    <?= $form->field($model, 'discount_amount')->textInput() ?>

    <?= $form->field($model, 'net_amount')->textInput() ?>

    <?= $form->field($model, 'refund_amount')->textInput() ?>

    <?= $form->field($model, 'pay_mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
