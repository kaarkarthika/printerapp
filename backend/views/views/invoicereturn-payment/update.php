<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicereturnPayment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Invoicereturn Payment',
]) . $model->invoicepaymentreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoicereturn Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoicepaymentreturnid, 'url' => ['view', 'id' => $model->invoicepaymentreturnid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="invoicereturn-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
