<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InDrVisting */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Dr Vistings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-dr-visting-view">

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
            'dr_name',
            'amount',
            'hsn_code',
            'is_active',
            'created_date',
            'updated_date',
            'user_id',
            'user_role',
            'ipaddress',
        ],
    ]) ?>

</div>
