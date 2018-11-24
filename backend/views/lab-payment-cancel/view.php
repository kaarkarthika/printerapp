<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentCancel */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-cancel-view">

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
            'can_lab_prime_id',
            'mr_number',
            'paid_status',
            'lab_testgroup',
            'lab_testing',
            'lab_common_id',
            'lab_test_name',
            'price',
            'gst_percentage',
            'cgst_percentage',
            'sgst_percentage',
            'gst_amount',
            'cgst_amount',
            'sgst_amount',
            'total_amount',
            'hsn_code',
            'discount_percent',
            'discount_amount',
            'net_amount',
            'refund_amount',
            'pay_mode',
            'user_id',
            'created_at',
            'updated_at',
            'ip_address',
        ],
    ]) ?>

</div>
