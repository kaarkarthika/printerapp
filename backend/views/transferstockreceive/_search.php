<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferstockreceiveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferstockreceive-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transferstockreceiveid') ?>

    <?= $form->field($model, 'transferstockid') ?>

    <?= $form->field($model, 'transferstock_requestcode') ?>

    <?= $form->field($model, 'batchnumber') ?>

    <?= $form->field($model, 'receivedquantity') ?>

    <?php // echo $form->field($model, 'total_no_of_quantity') ?>

    <?php // echo $form->field($model, 'receiveddate') ?>

    <?php // echo $form->field($model, 'purchaseprice') ?>

    <?php // echo $form->field($model, 'priceperquantity') ?>

    <?php // echo $form->field($model, 'manufacturedate') ?>

    <?php // echo $form->field($model, 'expiredate') ?>

    <?php // echo $form->field($model, 'purchasedate') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
