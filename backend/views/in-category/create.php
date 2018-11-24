<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InCategory */

$this->title = 'Create In Category';
$this->params['breadcrumbs'][] = ['label' => 'In Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-category-create">

<br/>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
