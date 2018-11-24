<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StickyNotesDetails */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sticky Notes Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sticky-notes-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->autoid], [
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
            'autoid',
            'branch_id',
            'group_id',
            'notes_description:ntext',
            'notes_check',
            'status',
            'created_at',
            'modified_at',
        ],
    ]) ?>

</div>
