<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InRoomno */

$this->title = 'Update In Roomno: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Roomnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-roomno-update">

    

    <?= $this->render('_form', [
        'model' => $model,
        'floormaster'=> $floormaster,
            'roomtypes' => $roomtypes,
    ]) ?>

</div>
