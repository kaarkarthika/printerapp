<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ModuleAction */

$this->title = $model->actionid;
$this->params['breadcrumbs'][] = ['label' => 'Module Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-action-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'action_name',
            'action_key',
             ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
                         
          
       //    'updatedby',
          // 'updatedon',
         //  'updated_ipaddress',
            
            
        ],
    ]) ?>

</div>
