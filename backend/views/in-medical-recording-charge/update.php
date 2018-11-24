<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InMedicalRecordingCharge */

$this->title = 'Update In Medical Recording Charge: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="in-medical-recording-charge-update">


    <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping' => $tax_grouping,
    ]) ?>

</div>
