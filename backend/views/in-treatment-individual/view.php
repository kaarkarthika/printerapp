<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentIndividual */

$this->title = $model->ind_id;
$this->params['breadcrumbs'][] = ['label' => 'In Treatment Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-treatment-individual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ind_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ind_id], [
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
            'ind_id',
            'treat_ove_id',
            'return_status',
            'return_date',
            'treatment_id',
            'qty',
            'rate',
            'mrp',
            'gstpercent',
            'gstvalue',
            'cgst_percent',
            'cgst_value',
            'sgst_percent',
            'sgst_value',
            'discountvalue',
            'discount_percent',
            'total_price',
            'user_id',
            'user_role',
            'ipaddress',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
