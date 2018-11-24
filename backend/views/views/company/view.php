<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->company_id;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">


    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'company_id',
            'company_code',
            'company_name',
            'company_type',
            'cin',
            'pan',
            'dln1',
            'dln2',
            'dln3',
          ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
            //'updated_by',
          // 'updated_on',
           // 'updated_ipaddress',
        ],
    ]) ?>


</div>
