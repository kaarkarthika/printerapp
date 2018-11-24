<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Treatment */

$this->title = 'Update Treatment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Treatments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="treatment-update">

    

    <?= $this->render('_form', [
        'model' => $model,
         'tax_grouping'  => $tax_grouping,
    ]) ?>

</div>
