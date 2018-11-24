<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Specialistdoctor */

$this->title = 'Create Specialistdoctor';
$this->params['breadcrumbs'][] = ['label' => 'Specialistdoctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialistdoctor-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
