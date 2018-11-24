<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentOverallSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-treatment-overall-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'refund_status') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'physicianname') ?>

    <?php // echo $form->field($model, 'mrnumber') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'subvisit_id') ?>

    <?php // echo $form->field($model, 'subvisit_num') ?>

    <?php // echo $form->field($model, 'insurancetype') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phonenumber') ?>

    <?php // echo $form->field($model, 'billnumber') ?>

    <?php // echo $form->field($model, 'invoicedate') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'tot_no_of_items') ?>

    <?php // echo $form->field($model, 'tot_quantity') ?>

    <?php // echo $form->field($model, 'total_gst_percent') ?>

    <?php // echo $form->field($model, 'total_cgst_percent') ?>

    <?php // echo $form->field($model, 'total_sgst_percent') ?>

    <?php // echo $form->field($model, 'totalgstvalue') ?>

    <?php // echo $form->field($model, 'totalcgstvalue') ?>

    <?php // echo $form->field($model, 'totalsgstvalue') ?>

    <?php // echo $form->field($model, 'totaldiscountvalue') ?>

    <?php // echo $form->field($model, 'overalldiscounttype') ?>

    <?php // echo $form->field($model, 'overalldiscountpercent') ?>

    <?php // echo $form->field($model, 'overalldiscountamount') ?>

    <?php // echo $form->field($model, 'overall_due_amount') ?>

    <?php // echo $form->field($model, 'overall_sub_total') ?>

    <?php // echo $form->field($model, 'subtotval') ?>

    <?php // echo $form->field($model, 'overall_net_amount') ?>

    <?php // echo $form->field($model, 'overalltotal') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'discount_authority') ?>

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
