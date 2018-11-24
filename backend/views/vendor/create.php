<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = 'Create Vendor';

?>
<div class="vendor-create">


    <?= $this->render('_form', [
        'model' => $model,
        'statelist'=>$statelist,
    ]) ?>

</div>
