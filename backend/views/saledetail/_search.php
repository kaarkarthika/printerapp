<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SaledetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saledetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'opsale_detailid') ?>

    <?= $form->field($model, 'opsaleid') ?>

    <?= $form->field($model, 'saledate') ?>

    <?= $form->field($model, 'productid') ?>

    <?= $form->field($model, 'stock_code') ?>

    <?php // echo $form->field($model, 'compositionid') ?>

    <?php // echo $form->field($model, 'unitid') ?>

    <?php // echo $form->field($model, 'productqty') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'priceperqty') ?>

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
