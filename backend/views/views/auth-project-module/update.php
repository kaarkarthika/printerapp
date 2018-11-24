<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthProjectModule */

$this->title = 'Update Auth Project Module: ' . $model->p_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Auth Project Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p_autoid, 'url' => ['view', 'id' => $model->p_autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-project-module-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
