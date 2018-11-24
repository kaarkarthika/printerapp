<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Composition */

$this->title = $model->composition_id;
$this->params['breadcrumbs'][] = ['label' => 'Compositions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'composition_id',
            'composition_name',
            'agestart',
            'age_end',
           ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
                          //'age',
          
           //'updated_by',
          //// //'updated_on',
          // 'updated_ipaddress',
        ],
    ]) ?>

</div>
