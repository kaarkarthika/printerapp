<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Stickynotes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Stickynotes',
]) . $model->noteid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stickynotes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->noteid, 'url' => ['view', 'id' => $model->noteid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="stickynotes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
