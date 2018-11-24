<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OpMoneyreceipt */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Op Moneyreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="op-moneyreceipt-view">
 
  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'autoid',
            //'mr_type',
          [
              'attribute' => 'mr_type',
              'value'=>function($model){
                if($model->mr_type=="R"){
                return "Requistions";   
              }elseif ($model->mr_type=="P") {
                 return "Procedures";  
              } 
              },
            ],
            'mr_number',
            'patient_name',
            'amount',
           // 'tds',
            [
              'attribute' => 'org_disc_amt',
              'label' =>'Due Amount',

            ],
            'service_tax_amount',
            'request_date',
            'post_discount',
           // 'dis_allowed_amt',
            'recovery_amt',
           // 'paid_by',
            
            'total_amt',
           // 'org_disc_amt',
            'amount_words',
          //  'payment_by',
          //  'towards',
           // 'auth_by',
           // 'bank_name',
            'remarks',
          //  'status',
          //  'created_at',
          //  'updated_at',
         //   'user_id',
         //   'updated_ipaddress',
        ],
    ]) ?>

</div>
