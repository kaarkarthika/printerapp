<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabAddgroup */

$this->title = 'Create Lab Addgroup';
$this->params['breadcrumbs'][] = ['label' => 'Lab Addgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-addgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
