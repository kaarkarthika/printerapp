<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OpMoneyreceiptSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="op-moneyreceipt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'autoid') ?>

    <?= $form->field($model, 'mr_type') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'tds') ?>

    <?= $form->field($model, 'service_tax_amount') ?>

    <?php // echo $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'post_discount') ?>

    <?php // echo $form->field($model, 'dis_allowed_amt') ?>

    <?php // echo $form->field($model, 'recovery_amt') ?>

    <?php // echo $form->field($model, 'paid_by') ?>

    <?php // echo $form->field($model, 'patient_name') ?>

    <?php // echo $form->field($model, 'total_amt') ?>

    <?php // echo $form->field($model, 'org_disc_amt') ?>

    <?php // echo $form->field($model, 'amount_words') ?>

    <?php // echo $form->field($model, 'payment_by') ?>

    <?php // echo $form->field($model, 'towards') ?>

    <?php // echo $form->field($model, 'auth_by') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
