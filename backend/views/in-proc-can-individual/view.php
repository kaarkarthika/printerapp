<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcCanIndividual */

$this->title = $model->can_id;
$this->params['breadcrumbs'][] = ['label' => 'In Proc Can Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-proc-can-individual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->can_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->can_id], [
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
            'can_id',
            'can_treat_id',
            'can_proc_ind_id',
            'treat_id',
            'qty',
            'unit_price',
            'mrp',
            'gst_percent',
            'cgst_percent',
            'sgst_percent',
            'gst_value',
            'cgst_value',
            'sgst_value',
            'dis_value',
            'dis_percent',
            'total_price',
            'user_id',
            'ipaddress',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
