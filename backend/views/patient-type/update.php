<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientType */

$this->title = 'Update Patient Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Patient Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_id, 'url' => ['view', 'id' => $model->type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patient-type-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
