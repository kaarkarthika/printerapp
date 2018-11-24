<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Bulkproducts */

$this->title = $model->bulkproductid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bulkproducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulkproducts-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'bulkproductname:ntext',
            'productidz:ntext',
            'productnamez:ntext',
            'created_at',
            'updated_on',
            'updated_by',
            'status',
        ],
    ]) ?>

</div>
