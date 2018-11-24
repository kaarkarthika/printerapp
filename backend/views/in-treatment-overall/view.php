<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentOverall */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-overall-view">

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
            'refund_status',
            'name',
            'dob',
            'age',
            'gender',
            'physicianname',
            'mrnumber',
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
            'overalldiscounttype',
            'overalldiscountpercent',
            'overalldiscountamount',
            'overall_due_amount',
            'overall_sub_total',
            'subtotval',
            'overall_net_amount',
            'overalltotal',
            'remarks:ntext',
            'discount_authority',
            'user_id',
            'user_role',
            'created_at',
            'updated_at',
            'ipaddress',
        ],
    ]) ?>

</div>
