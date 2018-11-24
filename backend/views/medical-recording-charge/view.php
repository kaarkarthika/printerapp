<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalRecordingCharge */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//echo"<pre>"; print_r($model); die;
?>
<div class="medical-recording-charge-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'autoid',
          	'name',
            'amount',
            ['attribute' => 'hsncode1', 
            	'label' => 'HSN Code',
             	
            ],
            
        ],
    ]) ?>

</div>
