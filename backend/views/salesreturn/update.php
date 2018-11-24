<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Salesreturn */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Salesreturn',
]) . $model->return_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->return_id, 'url' => ['view', 'id' => $model->return_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesreturn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
