<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InRoomtypes */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Roomtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model); die;
?>
<div class="in-roomtypes-view">

     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'autoid',
             ['attribute' => 'room_types', 
            	'label' => 'Room Type',
             	
            ],
            ['attribute' => 'hsn_code', 
            	'label' => 'HSN Code',
             	 'value'=>function ($model) 
             	 {
             	 	if(!empty($model->hsn_code))
					{
						 return $model->hsncodemaster->hsncode;
					}
             	 	
				 },
            ],
         ['attribute' => 'price', 
            	'label' => 'Price',
             	
            ],
             ['attribute' => 'is_active', 
            	'label' => 'Active',
             	'value'=> function($model)
				{ 
					if($model->is_active=='1'){
						return "Active";
					}else{
						return "InActive";
					}
				}
             	],
            /*'created_date',
            'updated_date',
            'user_id',
            'userrole',
            'ipaddress',*/
        ],
    ]) ?>

</div>
