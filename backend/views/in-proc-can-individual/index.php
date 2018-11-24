<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InProcCanIndividualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Proc Can Individuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-proc-can-individual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Proc Can Individual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'can_id',
            'can_treat_id',
            'can_proc_ind_id',
            'treat_id',
            'qty',
            //'unit_price',
            //'mrp',
            //'gst_percent',
            //'cgst_percent',
            //'sgst_percent',
            //'gst_value',
            //'cgst_value',
            //'sgst_value',
            //'dis_value',
            //'dis_percent',
            //'total_price',
            //'user_id',
            //'ipaddress',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
