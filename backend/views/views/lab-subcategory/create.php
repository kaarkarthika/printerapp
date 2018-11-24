<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabSubcategory */

$this->title = 'ADD SubCategory';
$this->params['breadcrumbs'][] = ['label' => 'Lab Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($catgorylist); die;
?>
<div class="lab-subcategory-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
      'catgorylist' => $catgorylist,
        'catmodel' => $catmodel,
    ]) ?>

</div>
