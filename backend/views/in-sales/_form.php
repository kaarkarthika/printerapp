<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InSales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opsaleid')->textInput() ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'sales_type')->dropDownList([ 'O' => 'O', 'I' => 'I', 'T' => 'T', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'return_status')->dropDownList([ 'N' => 'N', 'Y' => 'Y', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'physicianname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patienttype')->textInput() ?>

    <?= $form->field($model, 'patient_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurancetype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phonenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoicedate')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tot_no_of_items')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tot_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_gst_percent')->textInput() ?>

    <?= $form->field($model, 'total_cgst_percent')->textInput() ?>

    <?= $form->field($model, 'total_sgst_percent')->textInput() ?>

    <?= $form->field($model, 'totalgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalcgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalsgstvalue')->textInput() ?>

    <?= $form->field($model, 'totaldiscountvalue')->textInput() ?>

    <?= $form->field($model, 'totaltaxableamount')->textInput() ?>

    <?= $form->field($model, 'overalldiscounttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overalldiscountpercent')->textInput() ?>

    <?= $form->field($model, 'overalldiscountamount')->textInput() ?>

    <?= $form->field($model, 'overall_sub_total')->textInput() ?>

    <?= $form->field($model, 'overalltotal')->textInput() ?>

    <?= $form->field($model, 'saleincrement')->textInput() ?>

    <?= $form->field($model, 'paid_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
