<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
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
            'autoid',
            'mr_number',
            'paid_status',
            'lab_testgroup',
            'lab_testing',
            'total_amount',
            'discount_amount',
            'net_amount',
            'refund_amount',
            'towards',
            'pay_mode',
            'cancellation:ntext',
            'user_id',
            'created_at',
            'updated_at',
            'ip_address',
        ],
    ]) ?>

</div>
