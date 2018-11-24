<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InProcCanIndividual */

$this->title = 'Create In Proc Can Individual';
$this->params['breadcrumbs'][] = ['label' => 'In Proc Can Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-proc-can-individual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
