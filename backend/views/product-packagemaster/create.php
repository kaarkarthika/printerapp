<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProductPackagemaster */

$this->title = 'Create Product Packagemaster';
$this->params['breadcrumbs'][] = ['label' => 'Product Packagemasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-packagemaster-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'package_log' => $package_log,
        'productlist_col_json' =>$productlist_col_json,
    ]) ?>

</div>
