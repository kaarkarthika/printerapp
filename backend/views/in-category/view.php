<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategory */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-category-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'autoid',
             ['attribute' => 'category_name', 
            	'label' => 'Category Name',
             	
            ],
             ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
            // 'created_date',
            // 'updated_date',
            // 'user_id',
            // 'user_role',
            // 'ipaddress',
        ],
    ]) ?>

</div>
