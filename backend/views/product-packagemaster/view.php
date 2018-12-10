<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductPackagemaster */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Packagemasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-packagemaster-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pack_name',
            'is_active',
            'created_at',
            'updated_at',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
