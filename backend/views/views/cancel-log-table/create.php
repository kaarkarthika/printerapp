<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CancelLogTable */

$this->title = 'Create Cancel Log Table';
$this->params['breadcrumbs'][] = ['label' => 'Cancel Log Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancel-log-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
