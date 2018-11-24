<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bulkproducts */

$this->title = Yii::t('app', 'Create Bulkproducts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bulkproducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulkproducts-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,"productlist"=>$productlist,
    ]) ?>

</div>
