<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrimeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-payment-prime-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'lab_id') ?>

    <?= $form->field($model, 'payment_status') ?>

    <?= $form->field($model, 'mr_number') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'ph_number') ?>

    <?php // echo $form->field($model, 'physican_name') ?>

    <?php // echo $form->field($model, 'insurance') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'overall_item') ?>

    <?php // echo $form->field($model, 'overall_gst_per') ?>

    <?php // echo $form->field($model, 'overall_cgst_per') ?>

    <?php // echo $form->field($model, 'overall_sgst_per') ?>

    <?php // echo $form->field($model, 'overall_gst_amt') ?>

    <?php // echo $form->field($model, 'overall_cgst_amt') ?>

    <?php // echo $form->field($model, 'overall_sgst_amt') ?>

    <?php // echo $form->field($model, 'overall_dis_type') ?>

    <?php // echo $form->field($model, 'overall_dis_percent') ?>

    <?php // echo $form->field($model, 'overall_dis_amt') ?>

    <?php // echo $form->field($model, 'overall_sub_total') ?>

    <?php // echo $form->field($model, 'overall_net_amt') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
