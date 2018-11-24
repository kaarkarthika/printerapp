<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceuserLogin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Serviceuser Logins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="serviceuser-login-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        //    'id',
            'auth_role',
         //   'assign_service',
            'status',
        ],
    ]) ?>

</div>
