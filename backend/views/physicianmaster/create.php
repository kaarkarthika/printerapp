<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Physicianmaster */

$this->title = Yii::t('app', 'Create Physicianmaster');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Physicianmasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physicianmaster-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>