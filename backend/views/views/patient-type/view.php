<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientType */

$this->title = $model->type_id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->type_id], [
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
            'type_id',
            'patient_type',
            'is_active',
            'updated_by',
            'updated_at',
            'created_at',
            'ip_address',
        ],
    ]) ?>

</div>
