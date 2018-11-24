<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BlockIpEntries */

$this->title = $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Block Ip Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-ip-entries-view">

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
            'ip_no',
            'mr_no',
            'patient_name',
            'address:ntext',
            'age',
            'sex',
            'phone_no',
            'mobile_no',
            'doctor_name',
            'doctor_name_2',
            'admit_date',
            'discharge_date',
            'relation_name',
            'city',
            'state',
            'pincode',
            'updated_at',
            'created_at',
            'ip_address',
            'user_id',
            'in_reg_id',
            'user_name',
        ],
    ]) ?>

</div>
