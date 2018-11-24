<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthUserRole */

$this->title = $model->ur_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Auth User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-user-role-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'ur_autoid',
            'rolename',
            'rolecode',
          //  'sortorder',
          //  'timestamp',
        ],
    ]) ?>

</div>
