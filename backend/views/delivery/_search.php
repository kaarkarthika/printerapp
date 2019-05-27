<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DeliverySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cust_id') ?>

    <?= $form->field($model, 'cust_name') ?>

    <?= $form->field($model, 'gstin_no') ?>

    <?= $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'state_code') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'bill_no') ?>

    <?php // echo $form->field($model, 'bill_date') ?>

    <?php // echo $form->field($model, 'tot_qty') ?>

    <?php // echo $form->field($model, 'tot_amt') ?>

    <?php // echo $form->field($model, 'transport') ?>

    <?php // echo $form->field($model, 'vehicle_num') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'c_date') ?>

    <?php // echo $form->field($model, 'u_date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'ipaddrss') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
