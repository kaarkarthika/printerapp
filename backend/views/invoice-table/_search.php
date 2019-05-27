<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceTableSerach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-table-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bill_number') ?>

    <?= $form->field($model, 'bill_date') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'gstin_no') ?>

    <?php // echo $form->field($model, 'total_ampunt') ?>

    <?php // echo $form->field($model, 'amt_in_words') ?>

    <?php // echo $form->field($model, 'total_gst_percent') ?>

    <?php // echo $form->field($model, 'total_cgst_percent') ?>

    <?php // echo $form->field($model, 'total_sgst_percent') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
