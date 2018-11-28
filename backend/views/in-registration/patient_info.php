<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InRegistration */

$this->title = 'Patient Info';
$this->params['breadcrumbs'][] = ['label' => 'In Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
    float:right;	position: relative;
    top: -13px;
}

	.modal .modal-dialog .modal-content .modal-body {
    	padding: 0px;
	}
	button.close {
    	padding: 2px 7px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px;
	}
	
	button.close:hover {    	color: #fff;	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<!-- <div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
	<ol class="breadcrumb" >
									 <li><a href="<?php // echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php // echo $this->title;?></a></li>
								</ol>
		 	</div>
		<div class="col-sm-6 text-right ">
		<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn text-right btn-default" Title="BACK To Grid">Back to Grid </a> 
		</div>
						</div>  -->
			
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body" style="height:495px;"> 
<div class="in-registration-create">

    
    <?= $this->render('patientinfo', [
        'model' => $model,
        'patienttype'=>$patienttype,
        'physicianmaster' => $physicianmaster,
        'bed_list' => $bed_list,
        'Newpatient_json' => $Newpatient_json,
        'ArrayHelper_patient'=>$ArrayHelper_patient,
        'insurance' => $insurance,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>