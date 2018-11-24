<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentIndividual */

$this->title = 'Update In Treatment Individual: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ind_id, 'url' => ['view', 'id' => $model->ind_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-treatment-individual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
