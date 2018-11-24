<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InReturndetail */

$this->title = 'Create In Returndetail';
$this->params['breadcrumbs'][] = ['label' => 'In Returndetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-returndetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
