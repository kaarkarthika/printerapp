<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InvoicePayment */

$this->title = Yii::t('app', 'Create Invoice Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
