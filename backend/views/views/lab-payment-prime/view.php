<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-prime-view">

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
            'payment_status',
            'mr_number',
            'name',
            'ph_number',
            'physican_name',
            'insurance',
            'dob',
            'overall_item',
            'overall_gst_per',
            'overall_cgst_per',
            'overall_sgst_per',
            'overall_gst_amt',
            'overall_cgst_amt',
            'overall_sgst_amt',
            'overall_dis_type',
            'overall_dis_percent',
            'overall_dis_amt',
            'overall_sub_total',
            'overall_net_amt',
            'created_at',
            'updated_at',
            'user_id',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
