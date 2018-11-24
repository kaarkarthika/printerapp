<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Bulkproducts */

$this->title = Yii::t('app', 'Update {modelClass}', [
    'modelClass' => 'Bulkproducts',
]) ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bulkproducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bulkproductid, 'url' => ['view', 'id' => $model->bulkproductid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bulkproducts-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,"productlist"=>$productlist,
    ]) ?>

</div>
