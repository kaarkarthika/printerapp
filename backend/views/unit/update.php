<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Unit */

$this->title = 'Update Unit: ' . $model->unitid;

?>
<div class="unit-update">

   

    <?= $this->render('_form', [
        'model' => $model,
          'items'=>$items,
    ]) ?>

</div>
