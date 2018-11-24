<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Salesreturn */

$this->title = $model->return_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesreturn-view">

  


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'return_invoicenumber',
          
            'mrnumber',
           
        ],
    ]) ?>

</div>
