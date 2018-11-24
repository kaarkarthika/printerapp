<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Purchase Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bill_no',
            'vendor',
            'vendor_branch_id',
            'invoice_no',
            // 'invoice_date',
            // 'sub_total',
            // 'discount_amount',
            // 'gst_amount',
            // 'cgst_amount',
            // 'sgst_amount',
            // 'total_expenses',
            // 'net_amount',
            // 'round_off',
            // 'total_amount',
            // 'created_at',
            // 'updated_by',
            // 'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
