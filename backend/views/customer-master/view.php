<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerMaster */

$this->title = $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->auto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->auto_id], [
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
            'auto_id',
            'company_name',
            'phone_no',
            'address:ntext',
            'gst',
            'state_code',
            'created_date',
            'updated_at',
            'updated_ipaddress',
            'user_id',
        ],
    ]) ?>

</div>
