<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CityMaster */

$this->title = 'Update City Master: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'City Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-master-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
