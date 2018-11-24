<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InSales */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-sales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->opsaleid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->opsaleid], [
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
            'opsaleid',
            'branch_id',
            'sales_type',
            'return_status',
            'name',
            'dob',
            'gender',
            'physicianname',
            'mrnumber',
            'patienttype',
            'patient_id',
            'subvisit_id',
            'subvisit_num',
            'insurancetype',
            'address',
            'phonenumber',
            'billnumber',
            'invoicedate',
            'total',
            'tot_no_of_items',
            'tot_quantity',
            'total_gst_percent',
            'total_cgst_percent',
            'total_sgst_percent',
            'totalgstvalue',
            'totalcgstvalue',
            'totalsgstvalue',
            'totaldiscountvalue',
            'totaltaxableamount',
            'overalldiscounttype',
            'overalldiscountpercent',
            'overalldiscountamount',
            'overall_sub_total',
            'overalltotal',
            'saleincrement',
            'paid_status',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
            'created_at',
        ],
    ]) ?>

</div>
