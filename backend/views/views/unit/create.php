<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Unit */

$this->title = 'Create Unit';
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'items'=>$items,
    ]) ?>

</div>
