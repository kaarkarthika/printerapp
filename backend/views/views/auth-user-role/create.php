<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AuthUserRole */

$this->title = 'Create Auth User Role';
$this->params['breadcrumbs'][] = ['label' => 'Auth User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-user-role-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
