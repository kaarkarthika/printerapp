<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabReferenceVal */

$this->title = 'Update Lab Reference Val: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lab Reference Vals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-reference-val-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
