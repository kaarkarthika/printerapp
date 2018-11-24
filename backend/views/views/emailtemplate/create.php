<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Emailtemplate */

$this->title = Yii::t('app', 'Create Emailtemplate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtemplates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtemplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
