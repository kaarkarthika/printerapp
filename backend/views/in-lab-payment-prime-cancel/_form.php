<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InLabPaymentPrimeCancel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-lab-payment-prime-cancel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payment_prime_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_status')->dropDownList([ 'P' => 'P', 'U' => 'U', 'R' => 'R', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'lab_common_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mr_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ph_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'physican_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'bill_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overall_item')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'can_overall_gst_per')->textInput() ?>

    <?= $form->field($model, 'can_overall_cgst_per')->textInput() ?>

    <?= $form->field($model, 'can_overall_sgst_per')->textInput() ?>

    <?= $form->field($model, 'can_overall_gst_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_cgst_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_sgst_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_dis_type')->dropDownList([ 'F' => 'F', 'P' => 'P', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'can_overall_dis_percent')->textInput() ?>

    <?= $form->field($model, 'can_overall_dis_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_sub_total')->textInput() ?>

    <?= $form->field($model, 'can_overall_net_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_paid_amt')->textInput() ?>

    <?= $form->field($model, 'can_overall_due_amt')->textInput() ?>

    <?= $form->field($model, 'sample_test')->textInput() ?>

    <?= $form->field($model, 'sample_date')->textInput() ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authority')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outsourcetest')->textInput() ?>

    <?= $form->field($model, 'remarks_outsource')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sample_received_date')->textInput() ?>

    <?= $form->field($model, 'report_received_date')->textInput() ?>

    <?= $form->field($model, 'remarks_report')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'samplecollect' => 'Samplecollect', 'report' => 'Report', 'report_received' => 'Report received', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
