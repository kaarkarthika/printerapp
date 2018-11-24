<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TansiCustomer */

$this->title = 'Create Tansi Customer';
$this->params['breadcrumbs'][] = ['label' => 'Tansi Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tansi-customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
