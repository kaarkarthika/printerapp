<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */

$this->title = 'Add Testgroup';
$this->params['breadcrumbs'][] = ['label' => 'Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testgroup-create">
 <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping'=>$tax_grouping,
        
    ]) ?>

</div>
