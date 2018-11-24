<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockmaster */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Stockmaster',
]) . $model->stockid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockmasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stockid, 'url' => ['view', 'id' => $model->stockid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="stockmaster-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'vendorlist'=>$vendorlist,
         'productlist'=>$productlist,
    ]) ?>

</div>
