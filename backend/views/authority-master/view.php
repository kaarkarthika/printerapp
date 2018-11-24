<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthorityMaster */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Authority Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-master-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    //        'autoid',
             ['attribute' => 'authorityname', 
            	'label' => 'Authority Name',
             	
            ],
              ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->isactive==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
                        
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'user_role',
            // 'ipaddress',
        ],
    ]) ?>

</div>
