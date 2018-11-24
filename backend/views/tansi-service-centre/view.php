<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BranchManagement */

$this->title = $model->center_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Tansi Service Centres', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="body">
<div class="branch-management-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

   <!--  <p>
        <?= Html::a('Update', ['update', 'id' => $model->center_autoid], ['class' => 'btn btn-primary waves-effect']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->center_autoid], [
            'class' => 'btn btn-danger waves-effect',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           //'center_autoid',
            'service_center_name',
            'service_center_code',
           // 'username',
            //'service_center_status',
            //'service_center_timestamp',
            'service_center_createdat',
        ],
    ]) ?>

</div>
</div>
</div>
