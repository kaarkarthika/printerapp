<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModuleActionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-action-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'actionid') ?>

    <?= $form->field($model, 'action_name') ?>

    <?= $form->field($model, 'action_key') ?>

    <?= $form->field($model, 'action_value') ?>

    <?= $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updatedby') ?>

    <?php // echo $form->field($model, 'updatedon') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
