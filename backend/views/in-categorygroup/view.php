<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategorygroup */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Categorygroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model); die;
?>
<div class="in-categorygroup-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'autoid',
            //'category_id',
              ['attribute' => 'categoryname', 
            	'label' => 'Category Name',
            ],
          ['attribute' => 'roomtypename', 
            	'label' => 'Room Type',
            ],
            'total',
             ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
        ],
    ]) ?>

</div>
