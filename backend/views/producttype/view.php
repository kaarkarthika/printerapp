<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Producttype */

$this->title = $model->product_typeid;
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producttype-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'product_typeid',
            'product_type',
           ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
                        
          //  'updated_by',
         //  'updated_on',
       //   'updated_ipaddress',
        ],
    ]) ?>

</div>
