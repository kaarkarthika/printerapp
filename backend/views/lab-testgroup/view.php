<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabTestgroup */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Lab Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-testgroup-view">

    


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autoid',
            'testgroupid',
            'test_nameid',
            'created_at',
            'created_date',
            'updated_at',
            'update_date',
        ],
    ]) ?>

</div>
