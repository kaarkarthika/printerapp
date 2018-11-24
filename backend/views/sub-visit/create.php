<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */

$this->title = 'Create Sub Visit';
$this->params['breadcrumbs'][] = ['label' => 'Sub Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-visit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
