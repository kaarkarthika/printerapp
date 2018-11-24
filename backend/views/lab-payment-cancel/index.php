<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabPaymentCancelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Payment Cancels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-cancel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lab Payment Cancel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'can_lab_prime_id',
            'mr_number',
            'paid_status',
            'lab_testgroup',
            //'lab_testing',
            //'lab_common_id',
            //'lab_test_name',
            //'price',
            //'gst_percentage',
            //'cgst_percentage',
            //'sgst_percentage',
            //'gst_amount',
            //'cgst_amount',
            //'sgst_amount',
            //'total_amount',
            //'hsn_code',
            //'discount_percent',
            //'discount_amount',
            //'net_amount',
            //'refund_amount',
            //'pay_mode',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'ip_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
