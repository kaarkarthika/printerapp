<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesMoneyreceiptsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-moneyreceipts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'autoid') ?>

    <?= $form->field($model, 'mr_no') ?>

    <?= $form->field($model, 'total_paid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'bill_number') ?>

    <?php // echo $form->field($model, 'pancard_no') ?>

    <?php // echo $form->field($model, 'cardholder_name') ?>

    <?php // echo $form->field($model, 'service_tax') ?>

    <?php // echo $form->field($model, 'prev_cashpaid') ?>

    <?php // echo $form->field($model, 'bill_amount') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'mode_of_payment') ?>

    <?php // echo $form->field($model, 'card_cheque_no') ?>

    <?php // echo $form->field($model, 'card_name') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'payment_details') ?>

    <?php // echo $form->field($model, 'amount_in_words') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'default_amount') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'authority') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
