<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ModuleAction */

$this->title = 'Update Module Action: ' . $model->actionid;
$this->params['breadcrumbs'][] = ['label' => 'Module Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->actionid, 'url' => ['view', 'id' => $model->actionid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-action-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
