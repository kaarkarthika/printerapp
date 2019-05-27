<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Estimate */

$this->title = 'Update Estimate: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estimate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
