<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Productgrouping */

$this->title = 'Update Productgrouping: ' . $model->productgroupid;
$this->params['breadcrumbs'][] = ['label' => 'Productgroupings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productgroupid, 'url' => ['view', 'id' => $model->productgroupid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productgrouping-update">

    

    <?= $this->render('_form', [
        'model' => $model,
        'productlist' => $productlist,
        'vendorlist' => $vendorlist,
    ]) ?>

</div>
