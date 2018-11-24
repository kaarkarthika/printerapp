<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CityMaster */

$this->title = 'Create City Master';
$this->params['breadcrumbs'][] = ['label' => 'City Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-master-create">
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
