<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Finalbill */

$this->title = 'Update Finalbill: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Finalbills', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="finalbill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
