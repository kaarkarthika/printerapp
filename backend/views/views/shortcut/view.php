<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Shortcut */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shortcuts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shortcut-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'short_id',
            'name',
            'link',
            'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
