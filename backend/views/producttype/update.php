<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producttype */

$this->title = 'Update Producttype: ' . $model->product_typeid;
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_typeid, 'url' => ['view', 'id' => $model->product_typeid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="producttype-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
