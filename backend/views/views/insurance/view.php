<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Insurance */

$this->title = $model->insurance_typeid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Insurances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insurance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->insurance_typeid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->insurance_typeid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'insurance_typeid',
            'insurance_type',
            'is_active',
            'updated_on',
            'updated_by',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
