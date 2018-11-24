<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Composition */

$this->title = 'Update Composition: ' . $model->composition_id;
$this->params['breadcrumbs'][] = ['label' => 'Compositions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->composition_id, 'url' => ['view', 'id' => $model->composition_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="composition-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
