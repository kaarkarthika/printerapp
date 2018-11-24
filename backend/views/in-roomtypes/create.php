<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InRoomtypes */

$this->title = 'Create In Roomtypes';
$this->params['breadcrumbs'][] = ['label' => 'In Roomtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-roomtypes-create">

    <p></p>

    <?= $this->render('_form', [
        'model' => $model,
         'tax_grouping'=>$tax_grouping,
    ]) ?>

</div>
