<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesMoneyreceipts */

$this->title = 'Update Sales Moneyreceipts: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sales Moneyreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-moneyreceipts-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
