<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InRegistration */

$this->title = 'IP Registration Std';
$this->params['breadcrumbs'][] = ['label' => 'In Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
}

	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	button.close {
    	/* padding: 2px 7px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px; */
	}
	
	button.close:hover {    	/* color: #fff;	 */}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
	<div class="col-sm-12">
		<div class=""><!-- class="panel panel-border panel-custom" -->
			<div class="panel-heading">
					</div>
	<div class=" "> <!-- class="panel-body" -->
<div class="in-registration-create">

    
    <?= $this->render('_form', [
        'model' => $model,
        'patienttype'=>$patienttype,
        'physicianmaster' => $physicianmaster,
        'bed_list' => $bed_list,
        'Newpatient_json' => $Newpatient_json,
        'ArrayHelper_patient'=>$ArrayHelper_patient,
        'specialistdoctor' => $specialistdoctor,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>