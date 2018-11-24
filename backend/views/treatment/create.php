<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Treatment */

$this->title = 'Create Treatment';
$this->params['breadcrumbs'][] = ['label' => 'Treatments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treatment-create">

  

    <?= $this->render('_form', [
        'model' => $model,
         'tax_grouping'  => $tax_grouping,
    ]) ?>

</div>
