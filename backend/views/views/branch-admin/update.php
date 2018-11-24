<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TansiBranchAdmin */

$this->title = 'Update Branch Admin';
$this->params['breadcrumbs'][] = ['label' => 'Tansi Branch Admins', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->ba_autoid, 'url' => ['view', 'id' => $model->ba_autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tansi-branch-admin-update">

    <?= $this->render('_form', [
        'model' => $model,
         'companylist'=>$companylist,
         'userrolelist'=>$userrolelist,
    ]) ?>

</div>
