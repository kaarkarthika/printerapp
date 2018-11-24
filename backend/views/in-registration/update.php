<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InRegistration */

$this->title = 'Update In Registration: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'In Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
<!-- <div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> 
	<ol class="breadcrumb" >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
									</div> -->
		<div class="col-sm-6 text-right ">
		<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=treatment-overall/index" class="btn text-right btn-default" Title="BACK To Grid">Back to Grid </a> 
		</div>
						</div>
	<div class="row">
		
	</div>
				
<div class="in-registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'model' => $model,
        'patienttype'=>$patienttype,
        'physicianmaster' => $physicianmaster,
        'bed_list' => $bed_list,
        'Newpatient_json' => $Newpatient_json,
        'ArrayHelper_patient'=>$ArrayHelper_patient,
    ]) ?>

</div>
