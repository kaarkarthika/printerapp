<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Emailtemplate */

$this->title = $model->emailid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtemplates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtemplate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->emailid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->emailid], [
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
            'emailid:email',
            'message',
            'userfrom',
            'userto',
            'isread',
            'datesent',
            'attachment',
        ],
    ]) ?>

</div>
