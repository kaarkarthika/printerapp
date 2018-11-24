<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UcilValidateDate */

$this->title = 'Update Ucil Validate Date: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ucil Validate Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ucil-validate-date-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
