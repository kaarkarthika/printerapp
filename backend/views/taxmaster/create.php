<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Taxmaster */

$this->title = 'Create Taxmaster';
$this->params['breadcrumbs'][] = ['label' => 'Taxmasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxmaster-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
