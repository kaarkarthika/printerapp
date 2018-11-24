<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CancelLogTable */

$this->title = 'Update Cancel Log Table: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cancel Log Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cancel_id, 'url' => ['view', 'id' => $model->cancel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cancel-log-table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
