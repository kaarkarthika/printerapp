<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->vendorid;
?>
<div class="vendor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'vendorname', 'vendorcode',
      ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
        ],
    ]) ?>
</div>