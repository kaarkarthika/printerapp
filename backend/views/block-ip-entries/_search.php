<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BlockIpEntriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-ip-entries-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'auto_id') ?>

    <?= $form->field($model, 'ip_no') ?>

    <?= $form->field($model, 'mr_no') ?>

    <?= $form->field($model, 'patient_name') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'phone_no') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'doctor_name') ?>

    <?php // echo $form->field($model, 'doctor_name_2') ?>

    <?php // echo $form->field($model, 'admit_date') ?>

    <?php // echo $form->field($model, 'discharge_date') ?>

    <?php // echo $form->field($model, 'relation_name') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'in_reg_id') ?>

    <?php // echo $form->field($model, 'user_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
