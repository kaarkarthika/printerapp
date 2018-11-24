<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InReturndetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-returndetail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'return_id')->textInput() ?>

    <?= $form->field($model, 'returndate')->textInput() ?>

    <?= $form->field($model, 'productid')->textInput() ?>

    <?= $form->field($model, 'stock_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compositionid')->textInput() ?>

    <?= $form->field($model, 'unitid')->textInput() ?>

    <?= $form->field($model, 'productqty')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'priceperqty')->textInput() ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
