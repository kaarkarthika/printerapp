<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StickyNotesDetails */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sticky Notes Details',
]) . $model->autoid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sticky Notes Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sticky-notes-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
