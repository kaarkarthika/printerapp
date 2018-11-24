<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferstockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferstock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transferstockid') ?>

    <?= $form->field($model, 'stockid') ?>

    <?= $form->field($model, 'productid') ?>

    <?= $form->field($model, 'vendorid') ?>

    <?= $form->field($model, 'brandcode') ?>

    <?php // echo $form->field($model, 'frombranch') ?>

    <?php // echo $form->field($model, 'tobranch') ?>

    <?php // echo $form->field($model, 'transferstockquantity') ?>

    <?php // echo $form->field($model, 'transferstockdate') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
