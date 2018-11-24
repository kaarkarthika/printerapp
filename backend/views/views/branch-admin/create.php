<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TansiBranchAdmin */

$this->title = 'Add Branch Admin';
$this->params['breadcrumbs'][] = ['label' => 'DMC Branch Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



    <?= $this->render('_form', [
        'model' => $model,
        'companylist'=>$companylist,
         'userrolelist'=>$userrolelist,
    ]) ?>


