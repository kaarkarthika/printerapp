<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MainTestgroup */

$this->title = 'Update Main Testgroup:';
$this->params['breadcrumbs'][] = ['label' => 'Main Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="main-testgroup-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping'=>$tax_grouping,
        'testname_det_index'=>$testname_det_index,
    ]) ?>

</div>
