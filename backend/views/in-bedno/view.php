<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InBedno */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Bednos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model); die;
?>
<div class="in-bedno-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
   // 'autoid',
   // 'bedno',
   // 'room_id',
    		['attribute' => 'bedno', 
            	'label' => 'Bed Number',
            ],
            ['attribute' => 'room_no1', 
            	'label' => 'Room Number',
            ],
        ],
    ]) ?>

</div>
