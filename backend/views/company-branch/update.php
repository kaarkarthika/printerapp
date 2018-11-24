<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyBranch */

$this->title = 'Create Company Branch';
$this->params['breadcrumbs'][] = ['label' => 'Company Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="company-branch-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'companylist'=>$companylist,
        'statelist'=>$statelist,
        
    ]) ?>

</div>
