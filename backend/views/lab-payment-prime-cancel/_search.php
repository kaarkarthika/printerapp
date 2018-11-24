<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrimeCancelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-payment-prime-cancel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'lab_id') ?>

    <?= $form->field($model, 'payment_prime_id') ?>

    <?= $form->field($model, 'payment_status') ?>

    <?= $form->field($model, 'lab_common_id') ?>

    <?= $form->field($model, 'mr_number') ?>

    <?php // echo $form->field($model, 'mr_id') ?>

    <?php // echo $form->field($model, 'sub_id') ?>

    <?php // echo $form->field($model, 'subvisit_number') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'ph_number') ?>

    <?php // echo $form->field($model, 'physican_name') ?>

    <?php // echo $form->field($model, 'insurance') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'overall_item') ?>

    <?php // echo $form->field($model, 'can_overall_gst_per') ?>

    <?php // echo $form->field($model, 'can_overall_cgst_per') ?>

    <?php // echo $form->field($model, 'can_overall_sgst_per') ?>

    <?php // echo $form->field($model, 'can_overall_gst_amt') ?>

    <?php // echo $form->field($model, 'can_overall_cgst_amt') ?>

    <?php // echo $form->field($model, 'can_overall_sgst_amt') ?>

    <?php // echo $form->field($model, 'can_overall_dis_type') ?>

    <?php // echo $form->field($model, 'can_overall_dis_percent') ?>

    <?php // echo $form->field($model, 'can_overall_dis_amt') ?>

    <?php // echo $form->field($model, 'can_overall_sub_total') ?>

    <?php // echo $form->field($model, 'can_overall_net_amt') ?>

    <?php // echo $form->field($model, 'can_overall_paid_amt') ?>

    <?php // echo $form->field($model, 'can_overall_due_amt') ?>

    <?php // echo $form->field($model, 'sample_test') ?>

    <?php // echo $form->field($model, 'sample_date') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'authority') ?>

    <?php // echo $form->field($model, 'outsourcetest') ?>

    <?php // echo $form->field($model, 'remarks_outsource') ?>

    <?php // echo $form->field($model, 'sample_received_date') ?>

    <?php // echo $form->field($model, 'report_received_date') ?>

    <?php // echo $form->field($model, 'remarks_report') ?>

    <?php // echo $form->field($model, 'file_path') ?>

    <?php // echo $form->field($model, 'status') ?>

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
