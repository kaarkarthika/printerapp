<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stockreturn */

$this->title = Yii::t('app', 'Create Stockreturn');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockreturn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
