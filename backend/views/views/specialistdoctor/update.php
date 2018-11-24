<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Specialistdoctor */

$this->title = 'Update Specialistdoctor: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Specialistdoctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->s_id, 'url' => ['view', 'id' => $model->s_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specialistdoctor-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
