<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */

$this->title = 'Update Treatment Overall: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="treatment-overall-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
