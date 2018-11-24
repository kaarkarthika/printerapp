<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InLabPaymentPrimeCancelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Lab Payment Prime Cancels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-lab-payment-prime-cancel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Lab Payment Prime Cancel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lab_id',
            'payment_prime_id',
            'payment_status',
            'lab_common_id',
            'mr_number',
            //'mr_id',
            //'sub_id',
            //'subvisit_number',
            //'name',
            //'ph_number',
            //'physican_name',
            //'insurance',
            //'dob',
            //'bill_number',
            //'overall_item',
            //'rate',
            //'can_overall_gst_per',
            //'can_overall_cgst_per',
            //'can_overall_sgst_per',
            //'can_overall_gst_amt',
            //'can_overall_cgst_amt',
            //'can_overall_sgst_amt',
            //'can_overall_dis_type',
            //'can_overall_dis_percent',
            //'can_overall_dis_amt',
            //'can_overall_sub_total',
            //'can_overall_net_amt',
            //'can_overall_paid_amt',
            //'can_overall_due_amt',
            //'sample_test',
            //'sample_date',
            //'remarks',
            //'authority',
            //'outsourcetest',
            //'remarks_outsource:ntext',
            //'sample_received_date',
            //'report_received_date',
            //'remarks_report:ntext',
            //'file_path',
            //'status',
            //'created_at',
            //'updated_at',
            //'user_id',
            //'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
