<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shortcut */

$this->title = 'Shortcut';
$this->params['breadcrumbs'][] = ['label' => 'Shortcuts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shortcut-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
