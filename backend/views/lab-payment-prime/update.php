<?php
die;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = 'Update Lab Payment Prime: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->lab_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-payment-prime-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
