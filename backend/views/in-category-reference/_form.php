<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategoryReference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-category-reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dr_visit_price')->textInput() ?>

    <?= $form->field($model, 'dr_visit_hsn_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nurse_price')->textInput() ?>

    <?= $form->field($model, 'nurse_hsn_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
