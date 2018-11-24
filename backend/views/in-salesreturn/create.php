<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InSalesreturn */

$this->title = 'Create In Salesreturn';
$this->params['breadcrumbs'][] = ['label' => 'In Salesreturns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-salesreturn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
