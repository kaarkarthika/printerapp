<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferstockapproveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferstockapprove-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transferstockapproveid') ?>

    <?= $form->field($model, 'transferstockid') ?>

    <?= $form->field($model, 'transferstock_requestcode') ?>

    <?= $form->field($model, 'approveddate') ?>

    <?= $form->field($model, 'batchnumber') ?>

    <?php // echo $form->field($model, 'manufacturedate') ?>

    <?php // echo $form->field($model, 'expiredate') ?>

    <?php // echo $form->field($model, 'purchasedate') ?>

    <?php // echo $form->field($model, 'approvedquantity') ?>

    <?php // echo $form->field($model, 'priceperquantity') ?>

    <?php // echo $form->field($model, 'pricepertransferstock') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
