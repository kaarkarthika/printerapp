<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BlockIpEntries */

$this->title = 'Create Block Ip Entries';
$this->params['breadcrumbs'][] = ['label' => 'Block Ip Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-ip-entries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
