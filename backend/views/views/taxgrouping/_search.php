<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaxgroupingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxgrouping-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'taxgroupid') ?>

    <?= $form->field($model, 'groupname') ?>

    <?= $form->field($model, 'is_active') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?= $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
