<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerMaster */

$this->title = 'Update Customer Master: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Customer Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
