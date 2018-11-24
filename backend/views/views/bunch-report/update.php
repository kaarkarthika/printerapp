<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceBunch */

$this->title = 'Update Invoice Bunch: ' . $model->bunch_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Bunches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bunch_autoid, 'url' => ['view', 'id' => $model->bunch_autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-bunch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
