<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockapprove */

$this->title = $model->transferstockapproveid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockapproves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockapprove-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->transferstockapproveid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->transferstockapproveid], [
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
            'transferstockapproveid',
            'transferstockid',
            'transferstock_requestcode',
            'approveddate',
            'batchnumber',
            'manufacturedate',
            'expiredate',
            'purchasedate',
            'approvedquantity',
            'priceperquantity',
            'pricepertransferstock',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
