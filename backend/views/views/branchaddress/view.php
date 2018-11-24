<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Branchaddress */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Branchaddresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branchaddress-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autoid',
            'servicecenter_id',
            'branchname',
            'address1',
            'address2',
            'city',
            'state',
            'pin',
            'mobile',
            'email:email',
            'website',
        ],
    ]) ?>

</div>
