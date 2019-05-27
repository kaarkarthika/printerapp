<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Estimate */

$this->title = $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estimate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->auto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->auto_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'auto_id',
            'customer_id',
            'customer_name',
            'bill_number',
            'particular_field:ntext',
            'amount',
            'created_at',
            'updated_at',
            'user_id',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
