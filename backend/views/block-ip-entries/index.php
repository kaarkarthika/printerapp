<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlockIpEntriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Block Ip Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-ip-entries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Block Ip Entries', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'auto_id',
            'ip_no',
            'mr_no',
            'patient_name',
            'address:ntext',
            //'age',
            //'sex',
            //'phone_no',
            //'mobile_no',
            //'doctor_name',
            //'doctor_name_2',
            //'admit_date',
            //'discharge_date',
            //'relation_name',
            //'city',
            //'state',
            //'pincode',
            //'updated_at',
            //'created_at',
            //'ip_address',
            //'user_id',
            //'in_reg_id',
            //'user_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
