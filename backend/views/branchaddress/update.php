<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Branchaddress */

$this->title = 'Update Branchaddress: ' . $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Branchaddresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branchaddress-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
