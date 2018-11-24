<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferstockreturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transferstockreturns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreturn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Transferstockreturn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'transferstockreturnid',
            'transferstockid',
            'transferstock_requestcode',
            'transferstockreceiveid',
            'batchnumber',
             'returnquantity',
            // 'unit',
            // 'pricepertransferstock',
            // 'returndate',
            // 'priceperquantity',
             'total_no_of_quantity',
            // 'manufacturedate',
            // 'expiredate',
            // 'purchasedate',
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
