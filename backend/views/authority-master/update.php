<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthorityMaster */

$this->title = 'Update Authority Master';
$this->params['breadcrumbs'][] = ['label' => 'Authority Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authority-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
