<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StickyNotesDetails */

$this->title = Yii::t('app', 'Create Sticky Notes Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sticky Notes Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sticky-notes-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
