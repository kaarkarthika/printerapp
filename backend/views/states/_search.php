<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="states-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'stateid') ?>

    <?= $form->field($model, 'state_name') ?>

    <?= $form->field($model, 'isactive') ?>

    <?= $form->field($model, 'updatedby') ?>

    <?= $form->field($model, 'updatedon') ?>

    <?php // echo $form->field($model, 'updatedipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
