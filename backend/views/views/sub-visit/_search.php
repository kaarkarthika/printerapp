<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubVisitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-visit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'sub_id') ?>

    <?= $form->field($model, 'pat_id') ?>

    <?= $form->field($model, 'cons_status') ?>

    <?= $form->field($model, 'mr_number') ?>

    <?= $form->field($model, 'sub_visit') ?>

    <?php // echo $form->field($model, 'consultant_time') ?>

    <?php // echo $form->field($model, 'consultant_doctor') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'con_turn') ?>

    <?php // echo $form->field($model, 'patient_type') ?>

    <?php // echo $form->field($model, 'insurance_type') ?>

    <?php // echo $form->field($model, 'ucil_letter_status') ?>

    <?php // echo $form->field($model, 'ucil_emp_id') ?>

    <?php // echo $form->field($model, 'patient_date') ?>

    <?php // echo $form->field($model, 'ucil_date') ?>

    <?php // echo $form->field($model, 'status_given') ?>

    <?php // echo $form->field($model, 'claim_status') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'less_disc_percent') ?>

    <?php // echo $form->field($model, 'less_disc_flat') ?>

    <?php // echo $form->field($model, 'net_amt') ?>

    <?php // echo $form->field($model, 'paid_amt') ?>

    <?php // echo $form->field($model, 'due_amt') ?>

    <?php // echo $form->field($model, 'pay_mode') ?>

    <?php // echo $form->field($model, 'disc_by') ?>

    <?php // echo $form->field($model, 'remarks') ?>

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
