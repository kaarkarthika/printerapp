<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */

$this->title = 'Update Lab Payment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
