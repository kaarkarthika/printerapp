<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MainTestgroup */

$this->title = 'Add Main Testgroup';
$this->params['breadcrumbs'][] = ['label' => 'Main Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// print_r($tax_grouping); die;
?>
<div class="main-testgroup-create">

    <?= $this->render('_form', [
        'model' => $model,
         'tax_grouping'=>$tax_grouping,
    ]) ?>
 

</div>
