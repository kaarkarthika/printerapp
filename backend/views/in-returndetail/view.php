<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InReturndetail */

$this->title = $model->return_detailid;
$this->params['breadcrumbs'][] = ['label' => 'In Returndetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-returndetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->return_detailid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->return_detailid], [
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
            'return_detailid',
            'return_id',
            'sale_detailid',
            'stockid',
            'stockresponseid',
            'returndate',
            'productid',
            'brandcode',
            'stock_code',
            'compositionid',
            'unitid',
            'batchnumber',
            'expiredate',
            'productqty',
            'price',
            'discount_type',
            'gstvalue',
            'cgstvalue',
            'sgstvalue',
            'discountvalue',
            'mrp',
            'priceperqty',
            'gst_percentage',
            'cgst_percentage',
            'sgst_percentage',
            'discount_percentage',
            'gstrate',
            'discountrate',
            'gstvalueperquantity',
            'discountvalueperquantity',
            'is_active',
            'updated_by',
            'created_at',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
