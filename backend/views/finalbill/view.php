<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Finalbill */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Finalbills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finalbill-view">

    <h5><?= Html::encode($this->title) ?></h5>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'autoid',
            'ipno',
            'mrno',
            'name',
            'age',
            'gender',
            'doa',
            'dod',
            'total_amt',
            'discount',
            'net_amount',
            'paid_amount',
            'balance_amount',
            'reason',
            'refundable',
            'auth_by',
            'remark:ntext',
             
        ],
    ]) ?>

</div>
