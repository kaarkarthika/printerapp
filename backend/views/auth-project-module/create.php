<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AuthProjectModule */

$this->title = 'Create Auth Project Module';
$this->params['breadcrumbs'][] = ['label' => 'Add Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-project-module-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
