<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InSales */

$this->title = 'Update In Sales: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->opsaleid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
