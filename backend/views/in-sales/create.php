<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InSales */

$this->title = 'Create In Sales';
$this->params['breadcrumbs'][] = ['label' => 'In Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-sales-create">

 

    <?= $this->render('_form', [
         'model' => $model,
      	 'patient_type' => $patient_type,
      	 'pmodel' => $pmodel,
         'patienttype'=>$patienttype,
         'patientmax'=>$patientmax,
         'companylist'=>$companylist,'brandlist'=>$brandlist,'physicianlist'=>$physicianlist,
    ]) ?>

</div>
