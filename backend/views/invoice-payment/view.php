<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicePayment */

$this->title = $model->invoicepaymentid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->invoicepaymentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->invoicepaymentid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'invoicepaymentid',
            'branchid',
            'saleid',
            'paymentmethod',
            'invoicenumber',
            'paymentamount',
            'cardtype',
            'cardholdername',
            'referencenumber',
            'timestamp',
            'updated_timestamp',
        ],
    ]) ?>

</div>
