<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StockrequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stockrequest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'requestid') ?>

    <?= $form->field($model, 'requestcode') ?>

    <?= $form->field($model, 'vendorid') ?>

    <?= $form->field($model, 'productid') ?>

    <?= $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'brandcode') ?>

    <?php // echo $form->field($model, 'requestdate') ?>

    <?php // echo $form->field($model, 'receivequantity') ?>

    <?php // echo $form->field($model, 'receivedate') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
