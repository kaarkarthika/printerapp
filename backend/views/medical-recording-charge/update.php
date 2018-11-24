<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalRecordingCharge */

$this->title = 'Update Medical Recording Charge ';
$this->params['breadcrumbs'][] = ['label' => 'Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-recording-charge-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping'=>$tax_grouping
    ]) ?>

</div>
