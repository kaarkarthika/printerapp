<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabTestgroup */

$this->title = 'Create Lab Testgroup';
$this->params['breadcrumbs'][] = ['label' => 'Lab Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-testgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
