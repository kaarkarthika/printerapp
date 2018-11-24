<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthProjectModuleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-project-module-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'p_autoid') ?>

    <?= $form->field($model, 'moduleName') ?>

    <?= $form->field($model, 'moduleCode') ?>

    <?= $form->field($model, 'moduleMultiple') ?>

    <?= $form->field($model, 'moduelRoot') ?>

    <?php // echo $form->field($model, 'userAction') ?>

    <?php // echo $form->field($model, 'FAIcon') ?>

    <?php // echo $form->field($model, 'sortOrder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
