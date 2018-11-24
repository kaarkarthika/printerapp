<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategoryReference */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Category References', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-category-reference-view">

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
            'dr_visit_price',
            'dr_visit_hsn_code',
            'nurse_price',
            'nurse_hsn_code',
            'created_date',
            'update_date',
            'user_id',
            'user_role',
            'ipaddress',
            'category_id',
        ],
    ]) ?>

</div>
