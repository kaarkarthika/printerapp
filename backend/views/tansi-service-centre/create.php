<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TansiServiceCentre */

$this->title = 'Add Service Centre';
$this->params['breadcrumbs'][] = ['label' => 'Tansi Service Centres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tansi-service-centre-create">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
