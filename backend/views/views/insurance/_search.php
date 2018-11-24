<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InsuranceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insurance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'insurance_typeid') ?>

    <?= $form->field($model, 'insurance_type') ?>

    <?= $form->field($model, 'is_active') ?>

    <?= $form->field($model, 'updated_on') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
