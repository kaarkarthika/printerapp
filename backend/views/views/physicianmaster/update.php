<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Physicianmaster */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Physicianmaster',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Physicianmasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="physicianmaster-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
