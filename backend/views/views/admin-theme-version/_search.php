<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminThemeVersionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-theme-version-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'autoid') ?>

    <?= $form->field($model, 'reconcileversionname') ?>

    <?= $form->field($model, 'reconcileversion') ?>

    <?= $form->field($model, 'reconcileversionkey') ?>

    <?= $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
