<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BlockIpEntries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-ip-entries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'auto_id')->textInput() ?>

    <?= $form->field($model, 'ip_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mr_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor_name_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admit_date')->textInput() ?>

    <?= $form->field($model, 'discharge_date')->textInput() ?>

    <?= $form->field($model, 'relation_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'in_reg_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
