<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentIndividualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-treatment-individual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ind_id') ?>

    <?= $form->field($model, 'treat_ove_id') ?>

    <?= $form->field($model, 'return_status') ?>

    <?= $form->field($model, 'return_date') ?>

    <?= $form->field($model, 'treatment_id') ?>

    <?php // echo $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'mrp') ?>

    <?php // echo $form->field($model, 'gstpercent') ?>

    <?php // echo $form->field($model, 'gstvalue') ?>

    <?php // echo $form->field($model, 'cgst_percent') ?>

    <?php // echo $form->field($model, 'cgst_value') ?>

    <?php // echo $form->field($model, 'sgst_percent') ?>

    <?php // echo $form->field($model, 'sgst_value') ?>

    <?php // echo $form->field($model, 'discountvalue') ?>

    <?php // echo $form->field($model, 'discount_percent') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'user_role') ?>

    <?php // echo $form->field($model, 'ipaddress') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
