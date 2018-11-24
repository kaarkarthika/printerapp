<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentOverall */

$this->title = 'Create In Treatment Overall';
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-overall-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
