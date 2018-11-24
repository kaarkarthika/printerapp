<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CityMaster */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'City Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-master-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           //'id',
            'city',
            'district',
            'state',
           // 'is_active',
            'created_at',
           // 'updated_at',
          //  'ip_address',
        ],
    ]) ?>

</div>
