<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminThemeVersion */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Admin Theme Versions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-theme-version-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autoid',
            'reconcileversionname',
            'reconcileversion',
            'reconcileversionkey',
            'timestamp',
        ],
    ]) ?>

</div>
