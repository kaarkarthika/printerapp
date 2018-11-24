<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Patienttype */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Patienttype',
]) . $model->patient_typeid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patienttypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->patient_typeid, 'url' => ['view', 'id' => $model->patient_typeid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="patienttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
