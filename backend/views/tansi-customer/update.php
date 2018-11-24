<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TansiCustomer */

$this->title = 'Update Tansi Customer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tansi Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tansi-customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
