<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UcilValidateDate */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Ucil Validate Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucil-validate-date-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'autoid',
            'ucil_date_value',
           // 'created_date',
        ],
    ]) ?>

</div>
