<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicereturnPayment */

$this->title = $model->invoicepaymentreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoicereturn Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoicereturn-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->invoicepaymentreturnid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->invoicepaymentreturnid], [
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
            'invoicepaymentreturnid',
            'branchid',
            'returnid',
            'patientname',
            'patient_mobilenumber',
            'mrnumber',
            'return_reason',
            'referencenumber',
            'paymentmethod',
            'invoicenumber',
            'paymentamount',
            'timestamp',
            'updated_timestamp',
        ],
    ]) ?>

</div>
