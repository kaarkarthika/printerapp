<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminThemeVersion */

$this->title = 'Create Admin Theme Version';
$this->params['breadcrumbs'][] = ['label' => 'Admin Theme Versions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-theme-version-create">

   <div class="box box-primary cgridoverlap">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-building-o"></i>  <?= Html::encode($this->title) ?></h3>
        </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
