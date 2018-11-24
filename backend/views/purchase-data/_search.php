<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bill_no') ?>

    <?= $form->field($model, 'vendor') ?>

    <?= $form->field($model, 'vendor_branch_id') ?>

    <?= $form->field($model, 'invoice_no') ?>

    <?php // echo $form->field($model, 'invoice_date') ?>

    <?php // echo $form->field($model, 'sub_total') ?>

    <?php // echo $form->field($model, 'discount_amount') ?>

    <?php // echo $form->field($model, 'gst_amount') ?>

    <?php // echo $form->field($model, 'cgst_amount') ?>

    <?php // echo $form->field($model, 'sgst_amount') ?>

    <?php // echo $form->field($model, 'total_expenses') ?>

    <?php // echo $form->field($model, 'net_amount') ?>

    <?php // echo $form->field($model, 'round_off') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
