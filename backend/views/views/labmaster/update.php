<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */

$this->title = 'Update Lab Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-category-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->renderajax('_form', [
        'model' => $model,
    ]) ?>

</div>
