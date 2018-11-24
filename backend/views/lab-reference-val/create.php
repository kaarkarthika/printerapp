<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabReferenceVal */

$this->title = 'Create Lab Reference Val';
$this->params['breadcrumbs'][] = ['label' => 'Lab Reference Vals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-reference-val-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
