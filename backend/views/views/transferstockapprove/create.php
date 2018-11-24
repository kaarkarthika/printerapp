<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockapprove */

$this->title = Yii::t('app', 'Create Transferstockapprove');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockapproves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockapprove-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
