<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockreceive */

$this->title = $model->transferstockreceiveid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockreceives'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreceive-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->transferstockreceiveid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->transferstockreceiveid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'transferstockreceiveid',
            'transferstockid',
            'transferstock_requestcode',
            'batchnumber',
            'receivedquantity',
            'total_no_of_quantity',
            'receiveddate',
            'purchaseprice',
            'priceperquantity',
            'manufacturedate',
            'expiredate',
            'purchasedate',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
