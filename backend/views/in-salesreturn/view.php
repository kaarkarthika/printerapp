<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InSalesreturn */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Salesreturns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-salesreturn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->return_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->return_id], [
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
            'return_id',
            'saleid',
            'return_invoicenumber',
            'patient_type',
            'returndate',
            'name',
            'mrnumber',
            'patient_id',
            'sub_visit_id',
            'subvisit_num',
            'branch_id',
            'returnincrement',
            'return_qty',
            'unit_price',
            'total',
            'totalgstvalue',
            'totalcgstvalue',
            'totalsgstvalue',
            'totaldiscountvalue',
            'totalcgstpercentage',
            'totalsgstpercentage',
            'totalgstpercentage',
            'totaldiscountpercentage',
            'paid_status',
            'is_active',
            'updated_by',
            'created_at',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
