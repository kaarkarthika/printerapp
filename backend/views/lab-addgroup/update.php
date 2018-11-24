<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabAddgroup */

$this->title = 'Update Lab Addgroup: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Addgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-addgroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
