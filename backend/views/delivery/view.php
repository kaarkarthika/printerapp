<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Delivery */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'cust_id',
            'cust_name',
            'gstin_no',
            'state',
            'state_code',
            'address:ntext',
            'bill_no',
            'bill_date',
            'tot_qty',
            'tot_amt',
            'transport',
            'vehicle_num',
            'remarks:ntext',
            'c_date',
            'u_date',
            'user_id',
            'ipaddrss',
        ],
    ]) ?>

</div>
