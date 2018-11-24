<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InSalesreturnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-salesreturn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'return_id') ?>

    <?= $form->field($model, 'saleid') ?>

    <?= $form->field($model, 'return_invoicenumber') ?>

    <?= $form->field($model, 'patient_type') ?>

    <?= $form->field($model, 'returndate') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'mrnumber') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'sub_visit_id') ?>

    <?php // echo $form->field($model, 'subvisit_num') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

    <?php // echo $form->field($model, 'returnincrement') ?>

    <?php // echo $form->field($model, 'return_qty') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'totalgstvalue') ?>

    <?php // echo $form->field($model, 'totalcgstvalue') ?>

    <?php // echo $form->field($model, 'totalsgstvalue') ?>

    <?php // echo $form->field($model, 'totaldiscountvalue') ?>

    <?php // echo $form->field($model, 'totalcgstpercentage') ?>

    <?php // echo $form->field($model, 'totalsgstpercentage') ?>

    <?php // echo $form->field($model, 'totalgstpercentage') ?>

    <?php // echo $form->field($model, 'totaldiscountpercentage') ?>

    <?php // echo $form->field($model, 'paid_status') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
