<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InProcedureCancelation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Procedure Cancelations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-procedure-cancelation-view">

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
            'treat_id',
            'name',
            'dob',
            'gender',
            'physician_name',
            'mr_number',
            'pat_id',
            'subvisit_id',
            'subvisit_num',
            'ins_type',
            'treat_bill',
            'can_bill',
            'treat_invoice_date',
            'cancel_invoice_date',
            'cancel_unitprice',
            'can_tot_items',
            'can_qty',
            'can_gst_percent',
            'can_cgst_percent',
            'can_sgst_percent',
            'can_gst_amt',
            'can_cgst_amt',
            'can_sgst_amt',
            'can_dis_percent',
            'can_dis_value',
            'can_due_amt',
            'can_total',
            'return_amt',
            'balance_amt',
            'reason_cancel',
            'authority',
            'user_id',
            'user_role',
            'created_at',
            'updated_at',
            'ipaddress',
        ],
    ]) ?>

</div>
