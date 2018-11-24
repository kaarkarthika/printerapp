<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\IpMoneyreceipts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ip Moneyreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ip-moneyreceipts-view">
 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'autoid',
            'transaction_type',
            'ip_no',
            'mr_no',
            'bed_no',
            'total_paid',
            'name',
            'mobile_no',
            'bill_number',
            //'pancard_no',
            //'cardholder_name',
            //'service_tax',
            //'admission_status',
            'prev_cashpaid',
            'bill_amount',
            'amount',
            'total_amount',
            'mode_of_payment',
            //'card_cheque_no',
           // 'bank_name',
            //'payment_details',
           // 'amount_in_words',
           // 'remark:ntext',
           // 'default_amount',
           // 'status',
           // 'created_at',
           // 'updated_at',
          //  'user_id',
          //  'ip_address',
          //  'updated_ipaddress',
        ],
    ]) ?>

</div>
