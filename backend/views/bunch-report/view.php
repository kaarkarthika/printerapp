<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceBunch */

$this->title = $model->bunch_autoid;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Bunches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-bunch-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bunch_autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bunch_autoid], [
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
            'bunch_autoid',
            'servicebranch',
            'bunch_pdflogid:ntext',
            'bunch_number',
            'bunch_status',
            'TotalAmountPaid',
            'AdvanceAmountID',
            'AdvanceAmount',
            'SMSStatus',
            'onlyInsuranceOTC',
            'jobcardnumber',
            'bikevariant',
            'DiscountAmount',
            'DiscountStatus',
            'RefundAmount',
            'RefundStatus',
            'ManualPurpose:ntext',
            'ManualAmount',
            'receipt_number',
            'receipt_print_count',
            'refund_voucher_number',
            'discount_voucher_number',
            'serviveAdviser',
            'techncinName',
            'finalInspector',
            'timestamp',
            'updated_timestamp',
        ],
    ]) ?>

</div>
