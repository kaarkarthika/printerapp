<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InRoomno */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Roomnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model); die;
?>
<div class="in-roomno-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
  //          'autoid',
            'room_no',
             ['attribute' => 'floorname', 
            	'label' => 'Floor ID',
             	
            ],
            ['attribute' => 'roomtype1', 
            	'label' => 'Room ID',
             	
            ],

    /*        'created_date',
            'updated_date',
            'user_id',
            'user_role',
            'ipaddress',*/
        ],
    ]) ?>

</div>
