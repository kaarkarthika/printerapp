<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InReturndetail */

$this->title = 'Update In Returndetail: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Returndetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->return_detailid, 'url' => ['view', 'id' => $model->return_detailid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-returndetail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
