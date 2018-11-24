<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ServiceuserLogin */

$this->title = 'Create Rights for User';

?>
<div class="serviceuser-login-create">
    <?= $this->render('_form', [
        'model' => $model,
        'roles'=>$roles,
    ]) ?>

</div>
