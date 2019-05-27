<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EstimateMainTbl */

$this->title = 'Create Estimate Main Tbl';
$this->params['breadcrumbs'][] = ['label' => 'Estimate Main Tbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estimate-main-tbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
