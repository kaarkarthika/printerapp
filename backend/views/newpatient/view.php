<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Physicianmaster;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */

$this->title = $model->patientid;
$this->params['breadcrumbs'][] = ['label' => 'Newpatients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newpatient-view">

   

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'patientid',
           
            ['attribute' => 'mr_no', 
            	'label' => 'Medical Number',
             	'value'=> function($model)
				{
					if($model->mr_no!=''){
					return $model->mr_no;
					}else{
						return '-';
					}
				}
             	],
			
			
            ['attribute' => 'patientname', 
            	'label' => 'Patient Name',
             	'value'=> function($model)
				{
					if($model->patientname!=''){
					return $model->patientname;
					}else{
						return '-';
					}
				}
             	],
			
           
			  ['attribute' => 'pat_mobileno', 
            	'label' => 'Mobile No',
             	'value'=> function($model)
				{
					if($model->pat_mobileno!=''){
					return $model->pat_mobileno;
					}else{
						return '-';
					}
				}
             	],
            
             ['attribute' => 'doctor_name', 
            	'label' => 'Doctor Name',
             	'value'=> function($model)
				{
					if($model->mr_no!='')
					{
						$consulted_id=$model->subvisit->consultant_doctor;
						$pysican_doctor=Physicianmaster::find()->where(['is_active'=>1])->andWhere(['id'=>$consulted_id])->asArray()->one();
						
						return $pysican_doctor['physician_name'];
						
					}else
					{
						return '-';
					}
				}
             	],
        ],
    ]) ?>

</div>
