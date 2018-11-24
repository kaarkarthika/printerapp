<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InLabPaymentPrimeCancel */

$this->title = 'Update In Lab Payment Prime Cancel: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Lab Payment Prime Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->lab_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-lab-payment-prime-cancel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
