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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->taxid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->taxid], [
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
            'taxid',
            'taxvalue',
            'taxgroup',
            'financialyear',
            'additionaltax',
            'is_active',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
