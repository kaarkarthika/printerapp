<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InReturndetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Returndetails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-returndetail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Returndetail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'return_detailid',
            'return_id',
            'sale_detailid',
            'stockid',
            'stockresponseid',
            //'returndate',
            //'productid',
            //'brandcode',
            //'stock_code',
            //'compositionid',
            //'unitid',
            //'batchnumber',
            //'expiredate',
            //'productqty',
            //'price',
            //'discount_type',
            //'gstvalue',
            //'cgstvalue',
            //'sgstvalue',
            //'discountvalue',
            //'mrp',
            //'priceperqty',
            //'gst_percentage',
            //'cgst_percentage',
            //'sgst_percentage',
            //'discount_percentage',
            //'gstrate',
            //'discountrate',
            //'gstvalueperquantity',
            //'discountvalueperquantity',
            //'is_active',
            //'updated_by',
            //'created_at',
            //'updated_on',
            //'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
