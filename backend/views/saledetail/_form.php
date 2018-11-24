<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="saledetail-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'saledate')->textInput(['readonly'=>'true']) ?>

    <?= $form->field($model, 'productid')->textInput() ?>

    <?= $form->field($model, 'stock_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compositionid')->textInput() ?>

    <?= $form->field($model, 'unitid')->textInput() ?>

    <?= $form->field($model, 'productqty')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'priceperqty')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
