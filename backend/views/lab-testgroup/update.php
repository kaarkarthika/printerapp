<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabTestgroup */

$this->title = 'Update Lab Testgroup: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-testgroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model_group' => $model_group,
    ]) ?>

</div>
