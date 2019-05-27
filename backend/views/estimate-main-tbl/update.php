<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EstimateMainTbl */

$this->title = 'Update Estimate Main Tbl: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Estimate Main Tbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estimate-main-tbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
