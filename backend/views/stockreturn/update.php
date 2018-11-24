<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockreturn */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Stockreturn',
]) . $model->stockreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stockreturnid, 'url' => ['view', 'id' => $model->stockreturnid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="stockreturn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
