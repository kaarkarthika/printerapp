<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InFloormaster */

$this->title = 'Update In Floormaster: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Floormasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-floormaster-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
