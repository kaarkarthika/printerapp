<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PatientType */

$this->title = 'Create Patient Type';
$this->params['breadcrumbs'][] = ['label' => 'Patient Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-type-create">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
