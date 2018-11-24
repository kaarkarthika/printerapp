<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InDrVisting */

$this->title = 'Update In Dr Visting: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Dr Vistings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-dr-visting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
