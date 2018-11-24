<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InFloormaster */

$this->title = 'Create In Floormaster';
$this->params['breadcrumbs'][] = ['label' => 'In Floormasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-floormaster-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
