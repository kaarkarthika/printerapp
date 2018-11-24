<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Finalbill */

$this->title = 'Create Finalbill';
$this->params['breadcrumbs'][] = ['label' => 'Finalbills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finalbill-create">

        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
