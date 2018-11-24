<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcedureCancelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-procedure-cancelation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'treat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'physician_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ins_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'treat_bill')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_bill')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'treat_invoice_date')->textInput() ?>

    <?= $form->field($model, 'cancel_invoice_date')->textInput() ?>

    <?= $form->field($model, 'cancel_unitprice')->textInput() ?>

    <?= $form->field($model, 'can_tot_items')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_gst_percent')->textInput() ?>

    <?= $form->field($model, 'can_cgst_percent')->textInput() ?>

    <?= $form->field($model, 'can_sgst_percent')->textInput() ?>

    <?= $form->field($model, 'can_gst_amt')->textInput() ?>

    <?= $form->field($model, 'can_cgst_amt')->textInput() ?>

    <?= $form->field($model, 'can_sgst_amt')->textInput() ?>

    <?= $form->field($model, 'can_dis_percent')->textInput() ?>

    <?= $form->field($model, 'can_dis_value')->textInput() ?>

    <?= $form->field($model, 'can_due_amt')->textInput() ?>

    <?= $form->field($model, 'can_total')->textInput() ?>

    <?= $form->field($model, 'return_amt')->textInput() ?>

    <?= $form->field($model, 'balance_amt')->textInput() ?>

    <?= $form->field($model, 'reason_cancel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authority')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
