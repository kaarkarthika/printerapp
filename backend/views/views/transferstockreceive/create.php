<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transferstockreceive */

$this->title = Yii::t('app', 'Create Transferstockreceive');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstockreceives'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstockreceive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
