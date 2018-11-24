<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewpatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="newpatient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'patientid') ?>

    <?= $form->field($model, 'mr_no') ?>

    <?= $form->field($model, 'patientname') ?>

    <?= $form->field($model, 'pat_inital_name') ?>

    <?= $form->field($model, 'pat_age') ?>

    <?php // echo $form->field($model, 'pat_sex') ?>

    <?php // echo $form->field($model, 'pat_marital_status') ?>

    <?php // echo $form->field($model, 'pat_relation') ?>

    <?php // echo $form->field($model, 'par_relationname') ?>

    <?php // echo $form->field($model, 'pat_address') ?>

    <?php // echo $form->field($model, 'pat_city') ?>

    <?php // echo $form->field($model, 'pat_distict') ?>

    <?php // echo $form->field($model, 'pat_state') ?>

    <?php // echo $form->field($model, 'pat_pincode') ?>

    <?php // echo $form->field($model, 'pat_phone') ?>

    <?php // echo $form->field($model, 'pat_mobileno') ?>

    <?php // echo $form->field($model, 'pat_email') ?>

    <?php // echo $form->field($model, 'pat_source') ?>

    <?php // echo $form->field($model, 'pat_occupation') ?>

    <?php // echo $form->field($model, 'pat_education') ?>

    <?php // echo $form->field($model, 'pat_nationality') ?>

    <?php // echo $form->field($model, 'pat_religion') ?>

    <?php // echo $form->field($model, 'pat_type') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
