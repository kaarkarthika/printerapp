<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyBranch */

$this->title = $model->branch_id;
$this->params['breadcrumbs'][] = ['label' => 'Company Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-branch-view">

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'company_name',
            'branch_code',
            'branch_name',
          ['attribute' => 'is_head_office', 'format'=>'raw', 'value' => function($model){
                               if($model->is_head_office==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
            'address1:ntext',
            'address2:ntext',
            'address3:ntext',
            'city',
            
            ['attribute' => 'state', 
             	'value'=> function($model)
				{
					if($model->contstate->state_name!=''){
					return $model->contstate->state_name;
					}else{
						return '-';
					}
				}
             	],
            'pincode',
            'gst_number',
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
