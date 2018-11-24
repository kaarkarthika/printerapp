<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxmaster */

$this->title = $model->taxid;
$this->params['breadcrumbs'][] = ['label' => 'Taxmasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxmaster-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'taxid',
            'taxvalue',
            'is_active',
            'financialyear',
            'additionaltax',
         //   'updated_by',
        //    'updated_on',
          //  'updated_ipaddress',
        ],
    ]) ?>

</div>
