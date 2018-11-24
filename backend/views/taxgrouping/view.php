<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Taxgrouping */

$this->title = $model->taxgroupid;
$this->params['breadcrumbs'][] = ['label' => 'Taxgroupings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxgrouping-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        //    'taxgroupid',
            'productid','tax',
          
       //     'updated_by',
        //    'updated_on',
        //    'updated_ipaddress',
        ],
    ]) ?>

</div>
