<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Returndetail */

$this->title = Yii::t('app', 'Create Returndetail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Returndetails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="returndetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
