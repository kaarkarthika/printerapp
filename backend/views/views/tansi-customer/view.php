<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TansiCustomer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tansi Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tansi-customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
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
            'autoid',
            'name',
            'email:email',
            'password',
            'mobile',
            'gender',
            'date_of_birth',
            'address:ntext',
            'city',
            'state',
            'pincode',
            'photo',
            'status',
            'created_at',
            'modified_at',
        ],
    ]) ?>

</div>
