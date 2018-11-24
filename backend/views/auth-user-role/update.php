<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthUserRole */

$this->title = 'Update Auth User Role: ' . $model->ur_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Auth User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ur_autoid, 'url' => ['view', 'id' => $model->ur_autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-user-role-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
