<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BranchManagement */

$this->title = $model->ba_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Branch Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="branch-management-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           //'ba_autoid',
            'role',
           
            //'auth_key',
           // 'password_hash',
            'ba_name',
            //'ba_status',
            //'status',
            //'password_reset_token',
            //'ba_timestamp',
            //'ba_createdat',
        ],
    ]) ?>

</div>

