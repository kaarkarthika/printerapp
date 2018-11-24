<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InLabPaymentPrimeCancel */

$this->title = 'Create In Lab Payment Prime Cancel';
$this->params['breadcrumbs'][] = ['label' => 'In Lab Payment Prime Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-lab-payment-prime-cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
