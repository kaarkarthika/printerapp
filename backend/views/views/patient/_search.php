<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'patient_number') ?>

    <?= $form->field($model, 'patient_type') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'medicalrecord_number') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'emailid') ?>

    <?php // echo $form->field($model, 'patient_mobilenumber') ?>

    <?php // echo $form->field($model, 'guardian_name') ?>

    <?php // echo $form->field($model, 'guardian_mobilenumber') ?>

    <?php // echo $form->field($model, 'physicianname') ?>

    <?php // echo $form->field($model, 'billnumber') ?>

    <?php // echo $form->field($model, 'invoicedate') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
