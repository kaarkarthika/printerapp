<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockreturn */

$this->title = $model->stockreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockreturn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->stockreturnid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->stockreturnid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'stockreturnid',
            'stockrequestid',
            'request_code',
            'stockid',
            'branch_id',
            'batchnumber',
            'receivedquantity',
            'total_no_of_quantity',
            'unitid',
            'receiveddate',
            'purchaseprice',
            'priceperquantity',
            'manufacturedate',
            'expiredate',
            'purchasedate',
            'stock_status',
            'returndate',
            'returnquantity',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
