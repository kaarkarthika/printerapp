<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentOverall */

$this->title = 'Update In Treatment Overall: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-treatment-overall-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
