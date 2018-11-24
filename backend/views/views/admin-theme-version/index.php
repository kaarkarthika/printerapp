<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminThemeVersionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Theme Versions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-theme-version-index">

    <div class="box box-primary cgridoverlap">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-building-o"></i>  <?= Html::encode($this->title) ?></h3>
        </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin Theme Version', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'reconcileversionname',
            'reconcileversion',
           // 'reconcileversionkey',
            'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
