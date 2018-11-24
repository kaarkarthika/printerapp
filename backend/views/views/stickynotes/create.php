<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stickynotes */

$this->title = Yii::t('app', 'Create Stickynotes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stickynotes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stickynotes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
