<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Specialistdoctor */

$this->title = $model->s_id;
$this->params['breadcrumbs'][] = ['label' => 'Specialistdoctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialistdoctor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->s_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->s_id], [
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
            's_id',
            'specialist',
            'updated_by',
            'updated_at',
            'created_at',
            'ip_address',
        ],
    ]) ?>

</div>
