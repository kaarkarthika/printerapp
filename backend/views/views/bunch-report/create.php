<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceBunch */

$this->title = 'Create Invoice Bunch';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Bunches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-bunch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
