<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InCategoryReference */

$this->title = 'Create In Category Reference';
$this->params['breadcrumbs'][] = ['label' => 'In Category References', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-category-reference-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
