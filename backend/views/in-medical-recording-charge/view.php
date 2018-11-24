<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InMedicalRecordingCharge */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'In Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-medical-recording-charge-view">

  

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'autoid',
            'name',
            'amount',
          
            [
            'attribute'=>'hsncode', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'HSN Code',
          
            'value'=>function ($model) {
            	if(!empty($model->hsncode))
				{
					 return $model->hsn->hsncode;
				}
				
            	
			},
        ],
            //'created_date',
            //'updated_date',
            //'user_id',
            //'user_role',
            //'ipaddress',
        ],
    ]) ?>

</div>
