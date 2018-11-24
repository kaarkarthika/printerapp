<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InBedno */

$this->title = 'Create In Bedno';
$this->params['breadcrumbs'][] = ['label' => 'In Bednos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-bedno-create">

<p></p>

    <?= $this->render('_form', [
        'model' => $model,
        'roomt_no' => $roomt_no,
    ]) ?>

</div>
