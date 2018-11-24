<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AuthorityMaster */

$this->title = 'Create Authority Master';
$this->params['breadcrumbs'][] = ['label' => 'Authority Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-master-create">

        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
