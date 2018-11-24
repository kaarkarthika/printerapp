<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InTreatmentOverallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Treatment Overalls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-overall-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Treatment Overall', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'refund_status',
            'name',
            'dob',
            'age',
            //'gender',
            //'physicianname',
            //'mrnumber',
            //'patient_id',
            //'subvisit_id',
            //'subvisit_num',
            //'insurancetype',
            //'address',
            //'phonenumber',
            //'billnumber',
            //'invoicedate',
            //'total',
            //'tot_no_of_items',
            //'tot_quantity',
            //'total_gst_percent',
            //'total_cgst_percent',
            //'total_sgst_percent',
            //'totalgstvalue',
            //'totalcgstvalue',
            //'totalsgstvalue',
            //'totaldiscountvalue',
            //'overalldiscounttype',
            //'overalldiscountpercent',
            //'overalldiscountamount',
            //'overall_due_amount',
            //'overall_sub_total',
            //'subtotval',
            //'overall_net_amount',
            //'overalltotal',
            //'remarks:ntext',
            //'discount_authority',
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
