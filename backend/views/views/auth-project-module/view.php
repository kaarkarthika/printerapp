<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthProjectModule */

$this->title = $model->p_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Auth Project Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-project-module-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'p_autoid',
            'moduleName',
            'moduleCode',
            'moduleMultiple',
            'moduelRoot',
            'userAction',
            'FAIcon',
            'sortOrder',
        ],
    ]) ?>

</div>
