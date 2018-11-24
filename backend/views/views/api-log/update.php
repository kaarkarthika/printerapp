<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiLog */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Api Log',
]) . $model->autoid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Api Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="api-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
