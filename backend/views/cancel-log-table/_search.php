<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CancelLogTableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cancel-log-table-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'cancel_id') ?>

    <?= $form->field($model, 'cancel_ran_id') ?>

    <?= $form->field($model, 'cancel_trans_type') ?>

    <?= $form->field($model, 'cancel_type') ?>

    <?= $form->field($model, 'subvisitno') ?>

    <?php // echo $form->field($model, 'mrnumber') ?>

    <?php // echo $form->field($model, 'opd_type') ?>

    <?php // echo $form->field($model, 'towards') ?>

    <?php // echo $form->field($model, 'refund_type') ?>

    <?php // echo $form->field($model, 'payment_mode') ?>

    <?php // echo $form->field($model, 'hospital_fees') ?>

    <?php // echo $form->field($model, 'doctor_fees') ?>

    <?php // echo $form->field($model, 'cancel_amt') ?>

    <?php // echo $form->field($model, 'amt_words') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'reason_cancelled') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
