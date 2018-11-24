<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabUnit */

$this->title = 'Create Lab Unit';
$this->params['breadcrumbs'][] = ['label' => 'Lab Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-unit-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
