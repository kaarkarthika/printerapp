<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */

$this->title = 'Update New patient';
$this->params['breadcrumbs'][] = ['label' => 'Newpatients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->patientid, 'url' => ['view', 'id' => $model->patientid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="newpatient-update">

  
    <?= $this->render('_form', [
            'model' => $model,
            'patientmax' => $patientmax,
            'insurancelist' => $insurancelist,
            'physicianmaster' => $physicianmaster,
            'specialistdoctor' => $specialistdoctor,
            'paymenttype' =>$paymenttype,
            'patienttype' => $patienttype,
            'subvisit' => $subvisit,
        ]);	 ?>

</div>
