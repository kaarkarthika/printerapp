<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstimateMainTblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estimates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estimate-main-tbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estimate Main Tbl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'customer_name',
            'bill_number',
            'total_amount',
            //'created_at',
            //'updated_at',
            //'user_id',
            //'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
