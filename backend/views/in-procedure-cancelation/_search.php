<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcedureCancelationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-procedure-cancelation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'can_id') ?>

    <?= $form->field($model, 'treat_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'physician_name') ?>

    <?php // echo $form->field($model, 'mr_number') ?>

    <?php // echo $form->field($model, 'pat_id') ?>

    <?php // echo $form->field($model, 'subvisit_id') ?>

    <?php // echo $form->field($model, 'subvisit_num') ?>

    <?php // echo $form->field($model, 'ins_type') ?>

    <?php // echo $form->field($model, 'treat_bill') ?>

    <?php // echo $form->field($model, 'can_bill') ?>

    <?php // echo $form->field($model, 'treat_invoice_date') ?>

    <?php // echo $form->field($model, 'cancel_invoice_date') ?>

    <?php // echo $form->field($model, 'cancel_unitprice') ?>

    <?php // echo $form->field($model, 'can_tot_items') ?>

    <?php // echo $form->field($model, 'can_qty') ?>

    <?php // echo $form->field($model, 'can_gst_percent') ?>

    <?php // echo $form->field($model, 'can_cgst_percent') ?>

    <?php // echo $form->field($model, 'can_sgst_percent') ?>

    <?php // echo $form->field($model, 'can_gst_amt') ?>

    <?php // echo $form->field($model, 'can_cgst_amt') ?>

    <?php // echo $form->field($model, 'can_sgst_amt') ?>

    <?php // echo $form->field($model, 'can_dis_percent') ?>

    <?php // echo $form->field($model, 'can_dis_value') ?>

    <?php // echo $form->field($model, 'can_due_amt') ?>

    <?php // echo $form->field($model, 'can_total') ?>

    <?php // echo $form->field($model, 'return_amt') ?>

    <?php // echo $form->field($model, 'balance_amt') ?>

    <?php // echo $form->field($model, 'reason_cancel') ?>

    <?php // echo $form->field($model, 'authority') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'user_role') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
