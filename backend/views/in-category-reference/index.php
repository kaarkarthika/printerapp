<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InCategoryReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Category References';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-category-reference-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create In Category Reference', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'dr_visit_price',
            'dr_visit_hsn_code',
            'nurse_price',
            'nurse_hsn_code',
            //'created_date',
            //'update_date',
            //'user_id',
            //'user_role',
            //'ipaddress',
            //'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
