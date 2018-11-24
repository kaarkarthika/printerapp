<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stockresponse */

$this->title = Yii::t('app', 'Create Stockresponse');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockresponses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockresponse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
