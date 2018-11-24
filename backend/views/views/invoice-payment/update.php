<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicePayment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Invoice Payment',
]) . $model->invoicepaymentid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoicepaymentid, 'url' => ['view', 'id' => $model->invoicepaymentid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="invoice-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
