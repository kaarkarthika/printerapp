<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UcilValidateDate */

$this->title = 'Create Ucil Validate Date';
$this->params['breadcrumbs'][] = ['label' => 'Ucil Validate Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucil-validate-date-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
