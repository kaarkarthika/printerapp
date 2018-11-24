<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentCancelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-payment-cancel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'autoid') ?>

    <?= $form->field($model, 'can_lab_prime_id') ?>

    <?= $form->field($model, 'mr_number') ?>

    <?= $form->field($model, 'paid_status') ?>

    <?= $form->field($model, 'lab_testgroup') ?>

    <?php // echo $form->field($model, 'lab_testing') ?>

    <?php // echo $form->field($model, 'lab_common_id') ?>

    <?php // echo $form->field($model, 'lab_test_name') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'gst_percentage') ?>

    <?php // echo $form->field($model, 'cgst_percentage') ?>

    <?php // echo $form->field($model, 'sgst_percentage') ?>

    <?php // echo $form->field($model, 'gst_amount') ?>

    <?php // echo $form->field($model, 'cgst_amount') ?>

    <?php // echo $form->field($model, 'sgst_amount') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'hsn_code') ?>

    <?php // echo $form->field($model, 'discount_percent') ?>

    <?php // echo $form->field($model, 'discount_amount') ?>

    <?php // echo $form->field($model, 'net_amount') ?>

    <?php // echo $form->field($model, 'refund_amount') ?>

    <?php // echo $form->field($model, 'pay_mode') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
