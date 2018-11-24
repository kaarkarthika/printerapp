<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockreturn */

$this->title = $model->transferstockreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreturn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->transferstockreturnid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->transferstockreturnid], [
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
            'transferstockreturnid',
            'transferstockid',
            'transferstock_requestcode',
            'transferstockreceiveid',
            'batchnumber',
            'returnquantity',
            'unit',
            'pricepertransferstock',
            'returndate',
            'priceperquantity',
            'total_no_of_quantity',
            'manufacturedate',
            'expiredate',
            'purchasedate',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
