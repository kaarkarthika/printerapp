<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturermaster */

$this->title = Yii::t('app', 'Create Manufacturermaster');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufacturermasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturermaster-create">
    <?= $this->render('_formmanufacturer', [
        'model' => $model,
    ]) ?>
</div>
