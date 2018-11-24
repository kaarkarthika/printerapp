<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicesList */

$this->title = 'Update Services List: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Services Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="services-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
