<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-data-view">

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
            'bill_no',
            'vendor',
            'vendor_branch_id',
            'invoice_no',
            'invoice_date',
            'sub_total',
            'discount_amount',
            'gst_amount',
            'cgst_amount',
            'sgst_amount',
            'total_expenses',
            'net_amount',
            'round_off',
            'total_amount',
            'created_at',
            'updated_by',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
