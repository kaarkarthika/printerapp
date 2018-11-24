<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CancelLogTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cancel-log-table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cancel_ran_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cancel_trans_type')->dropDownList([ 'M' => 'M', 'S' => 'S', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cancel_type')->dropDownList([ 'T' => 'T', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'subvisitno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opd_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'towards')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refund_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_fees')->textInput() ?>

    <?= $form->field($model, 'doctor_fees')->textInput() ?>

    <?= $form->field($model, 'cancel_amt')->textInput() ?>

    <?= $form->field($model, 'amt_words')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'reason_cancelled')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
