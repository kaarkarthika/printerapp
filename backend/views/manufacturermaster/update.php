<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturermaster */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Manufacturermaster',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufacturermasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="manufacturermaster-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
