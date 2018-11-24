<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */

$this->title = $model->sub_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-visit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sub_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sub_id], [
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
            'sub_id',
            'pat_id',
            'cons_status',
            'mr_number',
            'sub_visit',
            'consultant_time',
            'consultant_doctor',
            'department',
            'con_turn',
            'patient_type',
            'insurance_type',
            'ucil_letter_status',
            'ucil_emp_id',
            'patient_date',
            'ucil_date',
            'status_given',
            'claim_status',
            'total_amount',
            'less_disc_percent',
            'less_disc_flat',
            'net_amt',
            'paid_amt',
            'due_amt',
            'pay_mode',
            'disc_by',
            'remarks',
            'created_at',
            'updated_at',
            'user_id',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
