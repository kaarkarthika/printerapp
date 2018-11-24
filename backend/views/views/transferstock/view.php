<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferstock */

$this->title = $model->transferstockid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transferstocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferstock-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          
            'product_name',
   ['attribute'=>'frombranch','format'=>'raw','value'=>function($model) {return $model->companyfrombranch->branch_name; }],
   ['attribute'=>'tobranch','format'=>'raw','value'=>function($model) {return $model->companytobranch->branch_name; }],
    'transferstockdate', 'transferstock_requestcode',
            
        ],
    ]) ?>

</div>
