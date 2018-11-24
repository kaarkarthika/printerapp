<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BunchReporthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-bunch-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bunch_autoid') ?>

    <?= $form->field($model, 'servicebranch') ?>

    <?= $form->field($model, 'bunch_pdflogid') ?>

    <?= $form->field($model, 'bunch_number') ?>

    <?= $form->field($model, 'bunch_status') ?>

    <?php // echo $form->field($model, 'TotalAmountPaid') ?>

    <?php // echo $form->field($model, 'AdvanceAmountID') ?>

    <?php // echo $form->field($model, 'AdvanceAmount') ?>

    <?php // echo $form->field($model, 'SMSStatus') ?>

    <?php // echo $form->field($model, 'onlyInsuranceOTC') ?>

    <?php // echo $form->field($model, 'jobcardnumber') ?>

    <?php // echo $form->field($model, 'bikevariant') ?>

    <?php // echo $form->field($model, 'DiscountAmount') ?>

    <?php // echo $form->field($model, 'DiscountStatus') ?>

    <?php // echo $form->field($model, 'RefundAmount') ?>

    <?php // echo $form->field($model, 'RefundStatus') ?>

    <?php // echo $form->field($model, 'ManualPurpose') ?>

    <?php // echo $form->field($model, 'ManualAmount') ?>

    <?php // echo $form->field($model, 'receipt_number') ?>

    <?php // echo $form->field($model, 'receipt_print_count') ?>

    <?php // echo $form->field($model, 'refund_voucher_number') ?>

    <?php // echo $form->field($model, 'discount_voucher_number') ?>

    <?php // echo $form->field($model, 'serviveAdviser') ?>

    <?php // echo $form->field($model, 'techncinName') ?>

    <?php // echo $form->field($model, 'finalInspector') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <?php // echo $form->field($model, 'updated_timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
