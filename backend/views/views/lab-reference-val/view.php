<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabReferenceVal */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Lab Reference Vals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-reference-val-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autoid',
            'test_id',
            'reference_name',
            'reference_value',
            'created_at',
            'created_date',
            'updated_at',
            'updated_date',
        ],
    ]) ?>

</div>
