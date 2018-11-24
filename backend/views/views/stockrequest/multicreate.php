<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stockrequest */

$this->title = Yii::t('app', 'Add Stockrequest');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockrequests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockrequest-create">

   

    <?= $this->render('_multiform', [
        'model' => $model,
        'list'=>$list,
        'unitlist'=>$unitlist,
    ]) ?>

</div>
