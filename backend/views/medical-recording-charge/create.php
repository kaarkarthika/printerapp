<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MedicalRecordingCharge */

$this->title = 'Create Medical Recording Charge';
$this->params['breadcrumbs'][] = ['label' => 'Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-recording-charge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
