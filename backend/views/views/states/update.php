<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\States */

$this->title = 'Update States: ' . $model->stateid;
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stateid, 'url' => ['view', 'id' => $model->stateid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="states-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
