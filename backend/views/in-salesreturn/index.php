<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InSalesreturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Salesreturns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-salesreturn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Salesreturn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'return_id',
            'saleid',
            'return_invoicenumber',
            'patient_type',
            'returndate',
            //'name',
            //'mrnumber',
            //'patient_id',
            //'sub_visit_id',
            //'subvisit_num',
            //'branch_id',
            //'returnincrement',
            //'return_qty',
            //'unit_price',
            //'total',
            //'totalgstvalue',
            //'totalcgstvalue',
            //'totalsgstvalue',
            //'totaldiscountvalue',
            //'totalcgstpercentage',
            //'totalsgstpercentage',
            //'totalgstpercentage',
            //'totaldiscountpercentage',
            //'paid_status',
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
