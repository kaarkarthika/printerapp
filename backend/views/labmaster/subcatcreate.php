<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */

$this->title = 'Create Lab Category';
$this->params['breadcrumbs'][] = ['label' => 'Lab Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-category-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_subcatform', [
        'model' => $model,
    ]) ?>

</div>
