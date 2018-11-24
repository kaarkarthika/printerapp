<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InRoomtypes */

$this->title = 'Update In Roomtypes: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Roomtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-roomtypes-update">

<p></p>
    <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping'=>$tax_grouping,
    ]) ?>

</div>
