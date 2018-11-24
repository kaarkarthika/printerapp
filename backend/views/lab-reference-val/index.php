<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabReferenceValSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Reference Vals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-reference-val-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lab Reference Val', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'test_id',
            'reference_name',
            'reference_value',
            'created_at',
            //'created_date',
            //'updated_at',
            //'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
