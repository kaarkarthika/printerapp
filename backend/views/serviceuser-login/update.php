<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceuserLogin */

$this->title = 'Assign Rights';

?>
<div class="serviceuser-login-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'roles'=>$roles,
    ]) ?>

</div>
