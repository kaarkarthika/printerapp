<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentCancel */

$this->title = 'Update Lab Payment Cancel: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-payment-cancel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
