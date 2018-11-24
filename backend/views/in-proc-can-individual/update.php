<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcCanIndividual */

$this->title = 'Update In Proc Can Individual: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Proc Can Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->can_id, 'url' => ['view', 'id' => $model->can_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-proc-can-individual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
