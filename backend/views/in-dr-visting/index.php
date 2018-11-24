<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InDrVistingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Dr Vistings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-dr-visting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Dr Visting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'dr_name',
            'amount',
            'hsn_code',
            'is_active',
            //'created_date',
            //'updated_date',
            //'user_id',
            //'user_role',
            //'ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
