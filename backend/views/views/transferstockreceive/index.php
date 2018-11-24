<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferstockreceiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transferstockreceives');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreceive-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Transferstockreceive'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'transferstockreceiveid',
            'transferstockid',
            'transferstock_requestcode',
            'batchnumber',
            'receivedquantity',
            // 'total_no_of_quantity',
            // 'receiveddate',
            // 'purchaseprice',
            // 'priceperquantity',
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
