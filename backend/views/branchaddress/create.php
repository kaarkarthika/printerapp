<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Branchaddress */

$this->title = 'Create Branchaddress';
$this->params['breadcrumbs'][] = ['label' => 'Branchaddresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branchaddress-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
