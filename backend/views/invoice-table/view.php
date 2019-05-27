<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceTable */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-table-view">

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
            'bill_number',
            'bill_date',
            'company_name',
            'gstin_no',
            'total_ampunt',
            'amt_in_words',
            'total_gst_percent',
            'total_cgst_percent',
            'total_sgst_percent',
            'created_date',
            'updated_date',
            'user_id',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
