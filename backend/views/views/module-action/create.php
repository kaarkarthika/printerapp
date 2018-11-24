<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ModuleAction */

$this->title = 'Create Module Action';
$this->params['breadcrumbs'][] = ['label' => 'Module Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-action-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
