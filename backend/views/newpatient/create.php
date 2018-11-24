<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */

$this->title = 'Create Newpatient';
$this->params['breadcrumbs'][] = ['label' => 'Newpatients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newpatient-create">

   <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
         'patientmax' => $patientmax,
         'insurancelist' => $insurancelist,
    ]) ?>

</div>
