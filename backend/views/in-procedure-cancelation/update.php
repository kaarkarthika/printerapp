<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcedureCancelation */

$this->title = 'Update In Procedure Cancelation: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Procedure Cancelations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->can_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-procedure-cancelation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
