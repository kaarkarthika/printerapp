<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Unit */

$this->title = $model->unitid;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'unitid',
            ['attribute'=>'unitname','format'=>'raw','value'=>function($model)
            {
            	return $model->producttype->product_type;
            }],
             'unitvalue',
            'no_of_unit',
            ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',
        ],
    ]) ?>

</div>
