<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InLabPaymentPrimeCancel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Lab Payment Prime Cancels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-lab-payment-prime-cancel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->lab_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->lab_id], [
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
            'lab_id',
            'payment_prime_id',
            'payment_status',
            'lab_common_id',
            'mr_number',
            'mr_id',
            'sub_id',
            'subvisit_number',
            'name',
            'ph_number',
            'physican_name',
            'insurance',
            'dob',
            'bill_number',
            'overall_item',
            'rate',
            'can_overall_gst_per',
            'can_overall_cgst_per',
            'can_overall_sgst_per',
            'can_overall_gst_amt',
            'can_overall_cgst_amt',
            'can_overall_sgst_amt',
            'can_overall_dis_type',
            'can_overall_dis_percent',
            'can_overall_dis_amt',
            'can_overall_sub_total',
            'can_overall_net_amt',
            'can_overall_paid_amt',
            'can_overall_due_amt',
            'sample_test',
            'sample_date',
            'remarks',
            'authority',
            'outsourcetest',
            'remarks_outsource:ntext',
            'sample_received_date',
            'report_received_date',
            'remarks_report:ntext',
            'file_path',
            'status',
            'created_at',
            'updated_at',
            'user_id',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
