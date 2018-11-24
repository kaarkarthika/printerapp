<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InTreatmentIndividualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Treatment Individuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-individual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Treatment Individual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ind_id',
            'treat_ove_id',
            'return_status',
            'return_date',
            'treatment_id',
            //'qty',
            //'rate',
            //'mrp',
            //'gstpercent',
            //'gstvalue',
            //'cgst_percent',
            //'cgst_value',
            //'sgst_percent',
            //'sgst_value',
            //'discountvalue',
            //'discount_percent',
            //'total_price',
            //'user_id',
            //'user_role',
            //'ipaddress',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
