<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxgrouping */

$this->title = 'Update Taxgrouping: ' . $model->taxgroupid;
$this->params['breadcrumbs'][] = ['label' => 'Taxgroupings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->taxgroupid, 'url' => ['view', 'id' => $model->taxgroupid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="taxgrouping-update">


    <?= $this->render('_form', [
        'model' => $model,
        'productlist'=>$productlist,
         'taxgrouplist'=>$taxgrouplist,
    ]) ?>

</div>
