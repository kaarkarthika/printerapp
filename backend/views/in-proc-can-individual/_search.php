<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcCanIndividualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-proc-can-individual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'can_id') ?>

    <?= $form->field($model, 'can_treat_id') ?>

    <?= $form->field($model, 'can_proc_ind_id') ?>

    <?= $form->field($model, 'treat_id') ?>

    <?= $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'mrp') ?>

    <?php // echo $form->field($model, 'gst_percent') ?>

    <?php // echo $form->field($model, 'cgst_percent') ?>

    <?php // echo $form->field($model, 'sgst_percent') ?>

    <?php // echo $form->field($model, 'gst_value') ?>

    <?php // echo $form->field($model, 'cgst_value') ?>

    <?php // echo $form->field($model, 'sgst_value') ?>

    <?php // echo $form->field($model, 'dis_value') ?>

    <?php // echo $form->field($model, 'dis_percent') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'ipaddress') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
