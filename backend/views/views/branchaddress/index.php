<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchaddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branchaddresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branchaddress-index">

    <div class="box box-primary cgridoverlap">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-file"></i>Branchaddresses</h3>
        </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Branchaddress', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'autoid',
            'servicenter_name',
            'branchname',
            'address1',
            'address2',
             'city',
             'state',
             'pin',
             'mobile',
             'email:email',
             'website',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
