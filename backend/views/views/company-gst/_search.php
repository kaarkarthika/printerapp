<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyGstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-gst-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gstid') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'stateid') ?>

    <?= $form->field($model, 'gst') ?>

    <?= $form->field($model, 'isactive') ?>

    <?php // echo $form->field($model, 'updatedby') ?>

    <?php // echo $form->field($model, 'updatedon') ?>

    <?php // echo $form->field($model, 'updatedipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
