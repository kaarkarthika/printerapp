<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bill_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_branch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_date')->textInput() ?>

    <?= $form->field($model, 'sub_total')->textInput() ?>

    <?= $form->field($model, 'discount_amount')->textInput() ?>

    <?= $form->field($model, 'gst_amount')->textInput() ?>

    <?= $form->field($model, 'cgst_amount')->textInput() ?>

    <?= $form->field($model, 'sgst_amount')->textInput() ?>

    <?= $form->field($model, 'total_expenses')->textInput() ?>

    <?= $form->field($model, 'net_amount')->textInput() ?>

    <?= $form->field($model, 'round_off')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
