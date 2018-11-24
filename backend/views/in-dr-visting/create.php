<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InDrVisting */

$this->title = 'Create In Dr Visting';
$this->params['breadcrumbs'][] = ['label' => 'In Dr Vistings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-dr-visting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
