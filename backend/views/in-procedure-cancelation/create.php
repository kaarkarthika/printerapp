<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InProcedureCancelation */

$this->title = 'Create In Procedure Cancelation';
$this->params['breadcrumbs'][] = ['label' => 'In Procedure Cancelations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-procedure-cancelation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
