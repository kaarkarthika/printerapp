<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InRoomno */

$this->title = 'Create In Roomno';
$this->params['breadcrumbs'][] = ['label' => 'In Roomnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-roomno-create">

<p></p>
    <?= $this->render('_form', [
        'model' => $model,
         'floormaster'=> $floormaster,
         'roomtypes' => $roomtypes,
    ]) ?>

</div>
