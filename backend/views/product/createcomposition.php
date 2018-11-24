<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Composition */

$this->title = 'Create Composition';
$this->params['breadcrumbs'][] = ['label' => 'Compositions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-create">

    

    <?= $this->render('_formcomposition', [
        'model' => $model,
    ]) ?>

</div>
