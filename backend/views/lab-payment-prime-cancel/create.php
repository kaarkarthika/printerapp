<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrimeCancel */

$this->title = 'Create Lab Payment Prime Cancel';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Prime Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-prime-cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
