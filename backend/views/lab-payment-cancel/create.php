<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentCancel */

$this->title = 'Create Lab Payment Cancel';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-cancel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
