<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */

$this->title = 'Update Group Master';
$this->params['breadcrumbs'][] = ['label' => 'Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';

//echo "<pre>"; print_r($testname_det_index'=>$testname_det_index); die;
?>
<div class="testgroup-update">

  <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping'=>$tax_grouping,
        'testname_det_index'=>$testname_det_index,
    ]) ?>
</div>
