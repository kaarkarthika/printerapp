<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InBedno */

$this->title = 'Update In Bedno: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Bednos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-bedno-update">

<p></p>
    <?= $this->render('_form', [
        'model' => $model,
        'roomt_no' => $roomt_no,
    ]) ?>

</div>
