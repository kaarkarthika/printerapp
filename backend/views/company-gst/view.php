<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyGst */

$this->title = $model->gstid;
$this->params['breadcrumbs'][] = ['label' => 'Company Gsts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-gst-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          // 'gstid',
            'company_name',
            'state',
            'gst',
             ['attribute' => 'isactive', 'format'=>'raw', 'value' => function($model){
                               if($model->isactive==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
                         
          
         //  'updatedby',
          // 'updatedon',
          // 'updatedipaddress',
            
        ],
    ]) ?>

</div>
