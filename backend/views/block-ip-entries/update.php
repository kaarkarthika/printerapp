<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlockIpEntries */

$this->title = 'Update Block Ip Entries: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Block Ip Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="block-ip-entries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
