<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockapprove */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transferstockapprove',
]) . $model->transferstockapproveid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockapproves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transferstockapproveid, 'url' => ['view', 'id' => $model->transferstockapproveid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transferstockapprove-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
