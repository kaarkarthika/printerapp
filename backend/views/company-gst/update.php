<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyGst */

$this->title = 'Update Company Gst: ' . $model->gstid;
$this->params['breadcrumbs'][] = ['label' => 'Company Gsts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gstid, 'url' => ['view', 'id' => $model->gstid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-gst-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'companylist'=>$companylist,
         'statelist'=>$statelist,
    ]) ?>

</div>
