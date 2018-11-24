<?php

use yii\helpers\Html;

$this->title = 'Add Sales';

?>


    <?= $this->render('_form', [ 
     'model' => $model,
      'patient_type' => $patient_type,
      'pmodel' => $pmodel,
        'patienttype'=>$patienttype,
        'patientmax'=>$patientmax,
          'companylist'=>$companylist,'brandlist'=>$brandlist,'physicianlist'=>$physicianlist,
     ]) ?>