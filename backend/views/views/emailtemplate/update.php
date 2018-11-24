<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Emailtemplate */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Emailtemplate',
]) . $model->emailid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtemplates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emailid, 'url' => ['view', 'id' => $model->emailid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="emailtemplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
