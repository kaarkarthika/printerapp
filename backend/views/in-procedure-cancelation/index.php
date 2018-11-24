<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InProcedureCancelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Procedure Cancelations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-procedure-cancelation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Procedure Cancelation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'can_id',
            'treat_id',
            'name',
            'dob',
            'gender',
            //'physician_name',
            //'mr_number',
            //'pat_id',
            //'subvisit_id',
            //'subvisit_num',
            //'ins_type',
            //'treat_bill',
            //'can_bill',
            //'treat_invoice_date',
            //'cancel_invoice_date',
            //'cancel_unitprice',
            //'can_tot_items',
            //'can_qty',
            //'can_gst_percent',
            //'can_cgst_percent',
            //'can_sgst_percent',
            //'can_gst_amt',
            //'can_cgst_amt',
            //'can_sgst_amt',
            //'can_dis_percent',
            //'can_dis_value',
            //'can_due_amt',
            //'can_total',
            //'return_amt',
            //'balance_amt',
            //'reason_cancel',
            //'authority',
            //'user_id',
            //'user_role',
            //'created_at',
            //'updated_at',
            //'ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
