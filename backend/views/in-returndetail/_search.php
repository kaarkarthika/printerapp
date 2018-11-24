<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InReturndetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-returndetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'return_detailid') ?>

    <?= $form->field($model, 'return_id') ?>

    <?= $form->field($model, 'sale_detailid') ?>

    <?= $form->field($model, 'stockid') ?>

    <?= $form->field($model, 'stockresponseid') ?>

    <?php // echo $form->field($model, 'returndate') ?>

    <?php // echo $form->field($model, 'productid') ?>

    <?php // echo $form->field($model, 'brandcode') ?>

    <?php // echo $form->field($model, 'stock_code') ?>

    <?php // echo $form->field($model, 'compositionid') ?>

    <?php // echo $form->field($model, 'unitid') ?>

    <?php // echo $form->field($model, 'batchnumber') ?>

    <?php // echo $form->field($model, 'expiredate') ?>

    <?php // echo $form->field($model, 'productqty') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'discount_type') ?>

    <?php // echo $form->field($model, 'gstvalue') ?>

    <?php // echo $form->field($model, 'cgstvalue') ?>

    <?php // echo $form->field($model, 'sgstvalue') ?>

    <?php // echo $form->field($model, 'discountvalue') ?>

    <?php // echo $form->field($model, 'mrp') ?>

    <?php // echo $form->field($model, 'priceperqty') ?>

    <?php // echo $form->field($model, 'gst_percentage') ?>

    <?php // echo $form->field($model, 'cgst_percentage') ?>

    <?php // echo $form->field($model, 'sgst_percentage') ?>

    <?php // echo $form->field($model, 'discount_percentage') ?>

    <?php // echo $form->field($model, 'gstrate') ?>

    <?php // echo $form->field($model, 'discountrate') ?>

    <?php // echo $form->field($model, 'gstvalueperquantity') ?>

    <?php // echo $form->field($model, 'discountvalueperquantity') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
