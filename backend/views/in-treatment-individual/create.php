<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentIndividual */

$this->title = 'Create In Treatment Individual';
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-individual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
