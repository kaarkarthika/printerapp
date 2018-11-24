<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategory */

$this->title = 'Update In Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-category-update">

<br/>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
