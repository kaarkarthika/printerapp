<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockreturn */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transferstockreturn',
]) . $model->transferstockreturnid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transferstockreturnid, 'url' => ['view', 'id' => $model->transferstockreturnid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transferstockreturn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
