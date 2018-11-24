<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Producttype */

$this->title = 'Create Producttype';
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producttype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
