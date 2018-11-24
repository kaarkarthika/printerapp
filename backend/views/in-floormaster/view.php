<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InFloormaster */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Floormasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-floormaster-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'autoid',
            'floor_no',
           
            
			['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
					  ['attribute' => 'created_date', 'value' => function($model){
                             return date('d-m-Y H:i:s',strtotime($model->created_date));
                        }],
                        ['attribute' => 'updated_date', 'label'=>'Last Updated At','value' => function($model){
                             return date('d-m-Y H:i:s',strtotime($model->updated_date));
                        }],
         
           // 'user_id',
            //'user_role',
            
            		  
            'ipaddress',
        ],
    ]) ?>

</div>
