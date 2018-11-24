<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */

$this->title = $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Lab Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-category-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->auto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->auto_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'auto_id',
            'category_name',
            //'isactive',
            ['attribute' => 'isactive', 
            	'label' => 'Status ',
             	'value'=> function($model)
				{
					if($model->isactive=="1"){
						return Active;	
					}else{
						return InActive;
					}
				}
             	],
           // 'created_at',
           // 'created_date',
           // 'update_at',
           // 'update_date',
        ],
    ]) ?>

</div>
