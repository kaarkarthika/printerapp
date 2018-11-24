<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesMoneyreceipts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales Moneyreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-moneyreceipts-view">

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
            'mr_no',
            'total_paid',
            'name',
            'mobile_no',
            'bill_number',
            'pancard_no',
            'cardholder_name',
            'service_tax',
            'prev_cashpaid',
            'bill_amount',
            'amount',
            'total_amount',
            'mode_of_payment',
            'card_cheque_no',
            'card_name',
            'bank_name',
            'payment_details',
            'amount_in_words',
            'remark:ntext',
            'default_amount',
            'status',
            'created_at',
            'updated_at',
            'user_id',
            'authority',
            'ip_address',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
