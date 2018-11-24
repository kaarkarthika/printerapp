<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ManufacturermasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturermaster-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'manufacturer_name') ?>

    <?= $form->field($model, 'manufacturer_description') ?>

    <?= $form->field($model, 'is_active') ?>

    <?= $form->field($model, 'updatedby') ?>

    <?php // echo $form->field($model, 'updatedon') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
