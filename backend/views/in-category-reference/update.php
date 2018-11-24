<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategoryReference */

$this->title = 'Update In Category Reference: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Category References', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-category-reference-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
