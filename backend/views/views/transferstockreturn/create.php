<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockreturn */

$this->title = Yii::t('app', 'Create Transferstockreturn');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreturn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
