<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InRegistrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-registration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'autoid') ?>

    <?= $form->field($model, 'patient_type') ?>

    <?= $form->field($model, 'registered') ?>

    <?= $form->field($model, 'panel_type') ?>

    <?= $form->field($model, 'mr_no') ?>

    <?php // echo $form->field($model, 'ip_no') ?>

    <?php // echo $form->field($model, 'name_initial') ?>

    <?php // echo $form->field($model, 'patient_name') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'relation_suffix') ?>

    <?php // echo $form->field($model, 'relative_name') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'phone_no') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'paytype') ?>

    <?php // echo $form->field($model, 'bed_no') ?>

    <?php // echo $form->field($model, 'room_no') ?>

    <?php // echo $form->field($model, 'floor_no') ?>

    <?php // echo $form->field($model, 'room_type') ?>

    <?php // echo $form->field($model, 'consultant_dr') ?>

    <?php // echo $form->field($model, 'dr_unit') ?>

    <?php // echo $form->field($model, 'speciality') ?>

    <?php // echo $form->field($model, 'co_consultant') ?>

    <?php // echo $form->field($model, 'diagnosis') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'userrole') ?>

    <?php // echo $form->field($model, 'ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
