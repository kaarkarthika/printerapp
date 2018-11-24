<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockmaster */

$this->title = $model->stockid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockmasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockmaster-view">

    

    <?= DetailView::widget([
   
        'model' => $model,
        'attributes' => [
          //  'stockid',
            'product_name',
            'vendor_name',
            'brandcode',
            'quantity',
            'price',
             ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
          
        ],
         
    ]) ?>

</div>
