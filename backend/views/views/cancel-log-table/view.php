<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CancelLogTable */

$this->title = $model->cancel_id;
$this->params['breadcrumbs'][] = ['label' => 'Cancel Log Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancel-log-table-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cancel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cancel_id], [
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
            'cancel_id',
            'cancel_ran_id',
            'cancel_trans_type',
            'cancel_type',
            'subvisitno',
            'mrnumber',
            'opd_type',
            'towards',
            'refund_type',
            'payment_mode',
            'hospital_fees',
            'doctor_fees',
            'cancel_amt',
            'amt_words',
            'paid',
            'reason_cancelled:ntext',
            'created_at',
            'updated_at',
            'ip_address',
            'user_id',
        ],
    ]) ?>

</div>
