<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxmaster */

$this->title = 'Update Taxmaster: ' . $model->taxid;
$this->params['breadcrumbs'][] = ['label' => 'Taxmasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->taxid, 'url' => ['view', 'id' => $model->taxid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="taxmaster-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
