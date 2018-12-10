<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InSalesreturn */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="in-salesreturn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'saleid')->textInput() ?>

    <?= $form->field($model, 'return_invoicenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_type')->textInput() ?>

    <?= $form->field($model, 'returndate')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_visit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'returnincrement')->textInput() ?>

    <?= $form->field($model, 'return_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'totalgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalcgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalsgstvalue')->textInput() ?>

    <?= $form->field($model, 'totaldiscountvalue')->textInput() ?>

    <?= $form->field($model, 'totalcgstpercentage')->textInput() ?>

    <?= $form->field($model, 'totalsgstpercentage')->textInput() ?>

    <?= $form->field($model, 'totalgstpercentage')->textInput() ?>

    <?= $form->field($model, 'totaldiscountpercentage')->textInput() ?>

    <?= $form->field($model, 'paid_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
