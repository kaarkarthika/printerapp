<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InMedicalRecordingCharge */

$this->title = 'Create In Medical Recording Charge';
$this->params['breadcrumbs'][] = ['label' => 'In Medical Recording Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-medical-recording-charge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
