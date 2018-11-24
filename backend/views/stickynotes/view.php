<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stickynotes */

$this->title = $model->noteid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stickynotes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stickynotes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->noteid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->noteid], [
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
            'noteid',
            'notetitle',
            'notedesc:ntext',
            'is_active',
            'colorscheme',
            'updated_by',
            'updated_on',
            'updated_ipaddress',
        ],
    ]) ?>

</div>
