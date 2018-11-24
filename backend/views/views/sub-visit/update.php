<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */

$this->title = 'Update Sub Visit: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sub Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_id, 'url' => ['view', 'id' => $model->sub_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-visit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
