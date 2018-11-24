<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyGst */

$this->title = 'Create Company Gst';
$this->params['breadcrumbs'][] = ['label' => 'Company Gsts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-gst-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'companylist'=>$companylist,
        'statelist'=>$statelist, 
    ]) ?>

</div>
