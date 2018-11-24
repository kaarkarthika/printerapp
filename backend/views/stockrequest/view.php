<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockrequest */

$this->title = $model->requestid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockrequests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockrequest-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'requestid',
            'requestcode',
            'vendor_name',
            'product_name',
            'quantity',
            'brandcode',
            'requestdate',
           
          // ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               // if($model->is_active==1)
							   // {
							   	// return "Yes";
							   // }
							   // else{
							   	// return "No";
							   // }
                        // }],
         //   'updated_by',
         //   'updated_on',
          //  'updated_ipaddress',
        ],
    ]) ?>

</div>
