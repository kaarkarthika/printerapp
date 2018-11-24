<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentIndividual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-treatment-individual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'treat_ove_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_status')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'return_date')->textInput() ?>

    <?= $form->field($model, 'treatment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'mrp')->textInput() ?>

    <?= $form->field($model, 'gstpercent')->textInput() ?>

    <?= $form->field($model, 'gstvalue')->textInput() ?>

    <?= $form->field($model, 'cgst_percent')->textInput() ?>

    <?= $form->field($model, 'cgst_value')->textInput() ?>

    <?= $form->field($model, 'sgst_percent')->textInput() ?>

    <?= $form->field($model, 'sgst_value')->textInput() ?>

    <?= $form->field($model, 'discountvalue')->textInput() ?>

    <?= $form->field($model, 'discount_percent')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
