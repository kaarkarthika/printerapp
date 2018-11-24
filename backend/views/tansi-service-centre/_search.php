<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TansiServiceCentreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tansi-service-centre-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'center_autoid') ?>

    <?= $form->field($model, 'service_center_name') ?>

    <?= $form->field($model, 'service_center_code') ?>

    <?= $form->field($model, 'service_center_status') ?>

    <?= $form->field($model, 'service_center_timestamp') ?>

    <?php // echo $form->field($model, 'service_center_createdat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
