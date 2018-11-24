<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Taxgrouping */

$this->title = 'Create Taxgrouping';
$this->params['breadcrumbs'][] = ['label' => 'Taxgroupings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxgrouping-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'productlist'=>$productlist,
                'taxgrouplist'=>$taxgrouplist,
    ]) ?>

</div>
