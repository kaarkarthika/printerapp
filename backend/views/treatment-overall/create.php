<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */

$this->title = 'Create Treatment Overall';
$this->params['breadcrumbs'][] = ['label' => 'Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treatment-overall-create">


    <?= $this->render('_form', [
                'model' => $model,
                'newpatient' => $newpatient,
                'new_patient_json' => $new_patient_json,
                'subvisit_json' => $subvisit_json,
                'subvisit_map' => $subvisit_map,
                'insurancelist' => $insurancelist,
                'today_visiting' => $today_visiting,
                'new_patient_index' => $new_patient_index,
                'physicianmaster' => $physicianmaster,
                'treatmentindividual' => $treatmentindividual,
                'treatment' => $treatment,
                 'tax_grouping_log_index_json' => $tax_grouping_log_index_json,
                 'authority_master' => $authority_master,
            ]) ?>

</div>
