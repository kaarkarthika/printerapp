<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabSubcategory */

$this->title = 'Update SubCategory';
$this->params['breadcrumbs'][] = ['label' => 'Lab Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-subcategory-update">

     <!-- <h1><?= Html::encode($this->title) ?></h1>  -->
  
    <?= $this->renderAjax('_form', [
        'model' => $model,
        'catgorylist' => $catgorylist,
               'catmodel' => $catmodel,
    ]) ?>

</div>
