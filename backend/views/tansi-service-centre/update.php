<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TansiServiceCentre */

$this->title = 'Update Service Centre';
$this->params['breadcrumbs'][] = ['label' => 'Tansi Service Centres', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->center_autoid, 'url' => ['view', 'id' => $model->center_autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tansi-service-centre-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
    ]) ?>

</div>
